<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Models\Property;
use App\Models\Geolocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PropertyResource;
use Illuminate\Support\Facades\Validator;

/**
 * @group Gerenciamento de Propriedades
 * 
 * @authenticated
 * 
 * Endpoints e funções para gerenciamento de propriedades
 * 
 * @apiResourceCollection App\Http\Resources\PropertyResource
 * @apiResourceModel App\Models\Property
 */
class PropertyController extends BaseController
{
	protected $messages = [
		'name.required' => 'Nome da propriedade inválido',
		'name.unique' => 'Nome da propriedade já está registrado',
		'owner_name.required' => 'Nome do proprietário é obrigatório',
		'area_name.required' => 'Nome da área é obrigatório',
		'description.required' => 'Descrição inválida'
	];
	/**
	 * Create a new PropertyController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// $this->middleware('auth:api');
	}

	/**
	 * Exibe todas as propriedades
	 * 
	 * @responseFile responses/properties/index.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user_id = Auth::id();
		
		$properties = Property::where('owner_id', '=', $user_id)
			->orderBy('id', 'asc')
			->get();
		
		//Modificado(Verificar a questão do id)
		//$properties = Property::orderBy('id', 'asc')->get();
		//Modificado
		return $this->send_response(PropertyResource::collection($properties));
	}

	public function shared()
	{
		$properties = Property::where('status', '=', 2)->orderBy('id', 'asc')->get();

		return $this->send_response(PropertyResource::collection($properties));
	}

	/**
	 * Cria uma nova propriedade
	 * 
	 * @bodyParam name string required Nome da propriedade. Example: Fazenda Primavera
	 * @bodyParam owner_name string required Nome do proprietário. Example: Lindolfo
	 * @bodyParam description string required Descrição qualquer sobre a propriedade (podendo ser localização, proximidade, etc). Example: Próximo a Fazendo Verão
	 *
	 * @responseFile responses/properties/store.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$check_label = $this->check_label(
			$request->get('name'),
		);

		if (!$check_label) {
			return $this->send_error(
				'Propriedade já existente',
				'Você já tem uma propriedade cadastrada com esse nome. Escolha um nome único!',
				400
			);
		}

		$validate = array(
			'name' => 'bail|required',
			'owner_name' => 'required',
			//'area_name' => 'required',
			'uf' => 'required',
			'city' => 'required',
			'area' => 'required',
			'uf' => 'required',
		);

		$validator = Validator::make($request->all(), $validate, $this->messages);

		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar propriedade',
				$validator->errors()
			);
		}

		$rule = Property::whereHas(
			'geolocation',
			function ($geolocation) use ($request) {
				$geolocation->where('latitude', '=', $request->geolocation['latitude'])
				->where('longitude', '=', $request->geolocation['longitude']);
			}
		)->first();

		if ($rule) {
			return $this->send_error(
				'Já existe uma propriedade localizada nessas coordenadas',
			);
		}

		$property_geolocation = new Geolocation();
		$property_geolocation->fill($request->get('geolocation'));
		$property_geolocation->save();

		$property = new Property();
		$property->name = $request->get('name');
		$property->area = $request->get('area');
		$property->owner_name = $request->get('owner_name');
		$property->area_name = $request->get('area_name');
		$property->description = $request->get('description');
		$property->status = $request->get('status');
		$property->city = $request->get('city');
		$property->uf = $request->get('uf');
		$property->owners()->associate($request->get('owner_id'));
		$property->geolocation()->associate($property_geolocation);
		$property->save();

		return $this->send_response(
			new PropertyResource($property),
			'Propriedade registrada',
			201
		);
	}

	/**
	 * Exibe uma propriedade específica
	 * 
	 * @queryParam property required Identificador único da propriedade. Example: 1
	 * 
	 * @responseFile responses/properties/show.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \App\Models\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function show(Property $property)
	{
		if (!$property) {
			return $this->send_error('Propriedade não encontrada');
		}

		return $this->send_response(new PropertyResource($property));
	}


	/**
	 * Atualiza uma propriedade específica
	 * 
	 * @queryParam property required Identificador único da propriedade. Example: 4
	 * 
	 * @bodyParam name string required Nome da propriedade. Example: Fazenda Verão
	 * @bodyParam owner_name string required Nome do proprietário. Example: Lindolfo
	 * @bodyParam description string required Descrição qualquer sobre a propriedade (podendo ser localização, proximidade, etc). Example: Próximo a Fazendo Outono
	 * 
	 * @responseFile responses/properties/update.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Property $property)
	{
		if (!$property) {
			return $this->send_error('Propriedade não encontrada');
		}

		$property_geolocation = $request->only('geolocation');

		$filtered['latitude'] = $property_geolocation['geolocation']['latitude'];
		$filtered['longitude'] = $property_geolocation['geolocation']['longitude'];
		$filtered['ratio'] = $property_geolocation['geolocation']['ratio'];

		$property->geolocation()->update($filtered);

		$property->name = $request->get('name');
		$property->area = $request->get('area');
		$property->owner_name = $request->get('owner_name');
		$property->description = $request->get('description');
		$property->update();

		return $this->send_response(
			new PropertyResource($property),
			'Propriedade atualizada com sucesso'
		);
	}

	/**
	 * Desativa ou ativa uma propriedade específica
	 * 
	 * @queryParam property required Identificador único da propriedade. Example: 4
	 * 
	 * @responseFile responses/properties/deactivate.json
	 * @responseFile 404 responses/404.json
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function status(Request $request, Property $property)
	{
		$message = '';
		$status = $request->get('status');

		switch ($status) {
			case 0:
				$message = 'Propriedade desativada';
				break;
			case 1:
				$message = 'Propriedade ativada';
				break;
			case 2:
				$message = 'Propriedade ativada e compartilhada';
				break;
			default:
				break;
		}

		$property->status = $status;
		$property->update();

		return $this->send_response(
			new PropertyResource($property),
			$message,
			200
		);
	}

	protected function check_label($name)
	{
		$user_id = Auth::id();
		$name_lower = strtolower($name);

		$property = Property::where('owner_id', '=', $user_id)
			->where(DB::raw('LOWER(name)'), 'LIKE', $name_lower)
			->get()
			->toArray();

		// $rule = Property::where(DB::raw('LOWER(name)'), 'LIKE', $name_lower)
		// 	->get()
		// 	->toArray();

		if ($property) {
			return false;
		}

		return true;
	}
}
