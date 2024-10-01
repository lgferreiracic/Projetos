<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\HomogeneousAreaResource;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use App\Models\SamplingPoint;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SamplingPointResource;
use App\Models\HomogeneousArea;
use App\Models\Property;
use App\Models\Stratum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

/**
 * @group Gerenciamento de Pontos Amostrais
 *
 * @authenticated
 *
 * Endpoints e funções para gerenciamento de pontos amostrais
 *
 * @apiResourceCollection App\Http\Resources\SamplingPointResource
 * @apiResourceModel App\Models\SamplingPoint
 */
class SamplingPointController extends BaseController
{
	protected $messages = [
		'label.required' 					=> 'Rótulo inválido',
		'status.required' 					=> 'Status inválido',
		'stratum_id.required' 				=> 'Área homogênea não existe',
		'geolocation.latitude.required'		=> 'Latitude fora de alcance',
		'geolocation.longitude.required'	=> 'Longitude fora de alcance',
		'geolocation.ratio.required'		=> 'Raio inválido',
	];

	/**
	 * Create a new SamplingPointController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth:api');
	}

	/**
	 * Exibe todos os pontos amostrais
	 *
	 * @responseFile responses/sampling_points/index.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$user_id = Auth::id();
		$is_admin = $this->is_admin();
		$is_farmer = $this->is_farmer();
		$strId = $request->query('strid');

		if ($strId) {
			$s_points = SamplingPoint::where('stratum_id', '=', $strId)->orderBy('id', 'asc')->get();

			return $this->send_response(SamplingPointResource::collection($s_points));
		}

		if ($is_admin || $is_farmer) {
			$properties = Property::where('owner_id', '=', $user_id)->get();
			$homogeneous_areas = [];
			$strata = [];
			$sampling_points = [];

			foreach ($properties as $key => $property) {
				$homogeneous_areas[] =
					HomogeneousArea::where('property_id', '=', $property->id)
						->orderBy('id', 'asc')
						->get();
			}

			foreach ($homogeneous_areas[0] as $key => $homogeneous_area) {
				$strata[] =
					Stratum::where('homogeneous_area_id', '=', $homogeneous_area->id)
						->orderBy('id', 'asc')
						->get();
			}
			
			foreach ($strata[0] as $key => $stratum) {
				$sampling_points[] = SamplingPoint::where('stratum_id', '=', $stratum->id)
						->orderBy('id', 'asc')
						->get();
			}

			return $this->send_response(SamplingPointResource::collection($sampling_points[0]));
		}
	}

	/**
	 * Cria um novo ponto amostral
	 *
	 * @bodyParam ini_period int required Périodo atual do ponto amostral. Example: 4
	 * @bodyParam status bool required Status atual do ponto amostral (ativo: 1 ou inativo: 0). Example: 1
	 * @bodyParam latitude float required Latitude que se encontra o ponto amostral. Example: -18.45752
	 * @bodyParam longitude float required Longitude que se encontra o ponto amostral. Example: 25.47852
	 * @bodyParam ratio float required Raio de abrangência do ponto amostral, para visualização no mapa. Example: 2.0
	 * @bodyParam stratum_id required Identificador único do estrato. Example 1
	 * @bodyParam property_id required Identificador único da propriedade. Example: 1
	 *
	 * @responseFile responses/sampling_points/store.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		// $check_label = $this->check_label(
		// 	$request->get('label'),
		// 	$request->get('stratum_id')
		// );

		// if (!$check_label) {
		// 	return $this->send_error(
		// 		'Ponto amostral já existente',
		// 		'Verifique o rótulo',
		// 		400
		// 	);
		// }

		$validator = Validator::make(
			$request->all(),
			SamplingPoint::VALIDATION_RULES + [
				'geolocation.ratio' => 'required'
			],
			$this->messages
		);

		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar ponto amostral',
				$validator->errors()
			);
		}

		$strid = $request->get('stratum_id');
		$total_sampling_points = SamplingPoint::where('status', true)
			->where('stratum_id', $strid)
			->count();

		if ($total_sampling_points === 5) {
			return $this->send_error('Impossível adicionar mais pontos amostrais');
		}

		$sp_geolocation = new Geolocation();
		$sp_geolocation->fill($request->get('geolocation'));
		$sp_geolocation->save();

		$s_point = new SamplingPoint();

		for ($i = 0; $i < 5; $i++) {
			$rule = SamplingPoint::where('label', ($i + 1))
				->where('status', true)
				->where('stratum_id', $strid)
				->first();

			if (!$rule) {
				$s_point->label = ($i + 1);
				$s_point->year = $request->get('year');
				$s_point->harvest = $request->get('harvest');
				$s_point->status = true;
				$s_point->stratum_id = $strid;

				$s_point->geolocation()->associate($sp_geolocation);
				$s_point->save();

				break;
			}
		}

		return $this->send_response(
			new SamplingPointResource($s_point),
			'Ponto amostral registrado',
			201
		);
	}

	/**
	 * Exibe um usuário específico
	 *
	 * @queryParam s_point required Identificador único do ponto amostral. Example: 3
	 *
	 * @responseFile responses/sampling_points/show.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\Models\SamplingPoint  $s_point
	 * @return \Illuminate\Http\Response
	 */
	public function show(SamplingPoint $s_point)
	{
		if (!$s_point) {
			return $this->send_error('Ponto amostral não encontrado');
		}

		return $this->send_response(new SamplingPointResource($s_point));
	}

	/**
	 * Atualiza um ponto amostral específico
	 *
	 * @queryParam s_point required Identificador único do ponto amostral. Example: 3
	 *
	 * @bodyParam ini_period int required Período atual do ponto amostral. Example: 5
	 * @bodyParam status bool required Status atual do ponto amostral (ativo: 1 ou inativo: 0). Example: 1
	 * @bodyParam latitude float required Latitude que se encontra o ponto amostral. Example: -18.45752
	 * @bodyParam longitude float required Longitude que se encontra o ponto amostral. Example: 25.47852
	 * @bodyParam ratio float required Raio de abrangência do ponto amostral, para visualização no mapa. Example: 7.0
	 * @bodyParam stratum_id required Identificador único do estrato. Example 1
	 * @bodyParam property_id required Identificador único da propriedade. Example: 1
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\SamplingPoint  $s_point
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, SamplingPoint $s_point)
	{
		if (!$s_point) {
			return $this->send_error('Ponto amostral não encontrado');
		}

		$label = $request->get('label');

		if ($label !== $s_point->label) {
			$check_label = $this->check_label(
				$request->get('label'),
				$request->get('stratum_id')
			);
			if (!$check_label) {
				return $this->send_error(
					'Ponto amostral já existente',
					'Verifique o rótulo',
					400
				);
			}
		}

		$validator = Validator::make(
			$request->all(),
			SamplingPoint::VALIDATION_RULES,
			$this->messages
		);

		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar ponto amostral',
				$validator->errors()
			);
		}

		// if (!$s_point) {
		// 	return $this->send_error('Ponto amostral não encontrado');
		// }

		$s_point_data = $request->only(
			'label',
			'stratum_id',
		);
		$s_point_geo_data = $request->only('geolocation');

		$filtered['latitude'] = $s_point_geo_data['geolocation']['latitude'];
		$filtered['longitude'] = $s_point_geo_data['geolocation']['longitude'];
		$filtered['ratio'] = $s_point_geo_data['geolocation']['ratio'];

		$s_point->update($s_point_data);
		$s_point->geolocation()->update($filtered);

		return $this->send_response(new SamplingPointResource($s_point), 'Ponto amostral atualizado');
	}

	/**
	 * Desativa um ponto amostral específico
	 *
	 * @queryParam s_point required Identificador único do ponto amostral. Example: 2
	 *
	 * @responseFile responses/sampling_points/deactivate.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\Models\SamplingPoint  $s_point
	 * @return \Illuminate\Http\Response
	 */
	public function status(Request $request, SamplingPoint $s_point)
	{
		$strid = $request->stratum_id;
		$total_sampling_points = SamplingPoint::where('status', true)
			->where('stratum_id', $strid)
			->count();

		if ($total_sampling_points === 5 && $request->status) {
			return $this->send_error('Impossível ativar mais pontos amostrais');
		}

		if ($request->status) {
			$s_point->status = true;
			$s_point->update();

			return $this->send_response(
				new SamplingPointResource($s_point),
				'Ponto amostral ativado',
				200
			);
		}

		$s_point->status = false;
		$s_point->update();

		return $this->send_response(
			new SamplingPointResource($s_point),
			'Ponto amostral desativado',
			200
		);
	}

	protected function check_label($label)
	{
		$label_lower = strtolower($label);
		$rule = SamplingPoint::where(DB::raw('LOWER(label)'), 'LIKE', $label_lower)
			->get()
			->toArray();

		if ($rule) {
			return false;
		}

		return true;
	}

	protected function is_admin()
	{
		$roles = auth('api')->user()
			->roles()
			->where('label', 'admin')
			->get()
			->toArray();

		$is_admin = count($roles) ? true : false;

		return $is_admin;
	}

	public function is_farmer()
	{
		$roles = auth('api')->user()
			->roles()
			->where('label', 'pre-registered')
			->get()
			->toArray();

		$is_farmer = count($roles) ? true : false;

		return $is_farmer;
	}
}
