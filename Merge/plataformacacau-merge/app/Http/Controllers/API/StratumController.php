<?php

namespace App\Http\Controllers\API;

use App\Models\Stratum;
use Illuminate\Http\Request;
use App\Http\Resources\StratumResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Gerenciamento de Estratos
 *
 * @authenticated
 *
 * Endpoints e funções para gerenciamento de estratos
 *
 * @apiResourceCollection App\Http\Resources\StratumResource
 * @apiResourceModel App\Models\Stratum
 */
class StratumController extends BaseController
{
	protected $messages = [
		'label.required' => 'Rótulo é requirido',
		'status.required' => 'Status é requirido',
	];

	/**
	 * Create a new StratumController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth:api');
	}

	/**
	 * Exibe todos os estratos
	 *
	 * @responseFile responses/strata/index.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$haId = $request->query('haid');

		$strata = Stratum::where('homogeneous_area_id', '=', $haId)->orderBy('id', 'asc')->get();

		return $this->send_response(StratumResource::collection($strata));
	}


	/**
	 * Cria um novo estrato
	 *
	 * @bodyParam label string required Rótulo para o estrato. Example: Estrato Sudeste
	 * @bodyParam status bool required Status atual do estrato (ativo: 1 ou inativo: 0). Example: 1
	 *
	 * @responseFile responses/strata/store.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validate = array(
			'label' => 'required',
		);

		$validator = Validator::make($request->all(), $validate, $this->messages);
		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar unidade operacional',
				$validator->errors()
			);
		}

		$check_label = $this->check_label($request->get('label'));
		if (!$check_label) {
			return $this->send_error(
				'Unidade operacional já existe',
				'Verifique o rótulo'
			);
		}

		$stratum = new Stratum();
		$stratum->fill($request->all());
		$stratum->save();

		return $this->send_response(
			new StratumResource($stratum),
			'Unidade operacional registrada',
			201
		);
	}

	/**
	 * Exibe um estrato específico
	 *
	 * @queryParam stratum required Identificador único do estrato. Example: 1
	 *
	 * @responseFile responses/strata/show.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\Models\Stratum  $stratum
	 * @return \Illuminate\Http\Response
	 */
	public function show(Stratum $stratum)
	{
		if (!$stratum) {
			return $this->send_error('Unidade operacional não encontrada');
		}

		return $this->send_response(new StratumResource($stratum));
	}

	/**
	 * Atualiza um estrato específico
	 *
	 * @queryParam stratum required Identificador único do estrato. Example: 1
	 *
	 * @bodyParam label string required Rótulo para o estrato. Example: Estrato Nordeste
	 * @bodyParam status bool required Status atual do estrato (ativo: 1 ou inativo: 0). Example: 1
	 *
	 * @responseFile responses/strata/update.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Stratum  $stratum
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Stratum $stratum)
	{
		if (!Stratum::find($stratum->id)) {
			return $this->send_error('Área homogênea não encontrada');
		}

		$check_label = $this->check_label($request->get('label'));
		if (!$check_label && $stratum->label != $request->get('label')) {
			return $this->send_error(
				'Unidade operacional',
				'Verifique o rótulo'
			);
		}

		$stratum->label = $request->get('label');
		$stratum->homogeneous_area_id = $request->get('homogeneous_area_id');
		$stratum->save();

		return $this->send_response(
			new StratumResource($stratum),
			'Unidade operacional atualizada'
		);
	}

	/**
	 * Desativa ou ativa uma Área homogênea específica
	 *
	 * @queryParam stratum required Identificador único do estrato. Example: 2
	 *
	 * @responseFile responses/strata/deactivate.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\Models\Stratum  $stratum
	 * @return \Illuminate\Http\Response
	 */
	public function status(Request $request, Stratum $stratum)
	{
		if ($request->status) {
			$stratum->status = true;
			$stratum->update();

			return $this->send_response(
				new StratumResource($stratum),
				'Unidade operacional ativada',
				200
			);
		}

		$stratum->status = false;
		$stratum->update();

		return $this->send_response(
			new StratumResource($stratum),
			'Unidade operacional desativada',
			200
		);
	}

	public function check_label($label)
	{
		$label_lower = strtolower($label);
		$checker = Stratum::where(DB::raw('LOWER(label)'), 'LIKE', $label_lower)
			->get()
			->toArray();

		if ($checker) {
			return false;
		}

		return true;
	}
}
