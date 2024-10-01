<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PropertyResource;
use Illuminate\Http\Request;
use App\Models\HomogeneousArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\HomogeneousAreaResource;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class HomogeneousAreaController extends BaseController
{
	protected $messages = [
		'label.required' => 'Rótulo é requirido',
		'property_id.required' => 'Propriedade não existe',
	];

	/**
	 * Create a new HomogeneousAreaController instance.
	 *
	 * @return void
	 */
	public function __construct() {}

	public function index(Request $request)
	{
		$user_id = Auth::id();
		$is_admin = $this->is_admin();
		$is_farmer = $this->is_farmer();
		$propertyId = $request->query('propid');

		if ($propertyId) {
			$homogeneous_area = HomogeneousArea::where('property_id', '=', $propertyId)->orderBy('id', 'asc')->get();

			return $this->send_response(HomogeneousAreaResource::collection($homogeneous_area));
		}

		if ($is_admin || $is_farmer) {
			$properties = Property::where('owner_id', '=', $user_id)->get();
			$homogeneous_areas = [];

			foreach ($properties as $key => $property) {
				$homogeneous_areas[] =
					HomogeneousArea::where('property_id', '=', $property->id)->orderBy('id', 'asc')->get();
			}

			return $this->send_response(HomogeneousAreaResource::collection($homogeneous_areas[0]));
		}
	}

	public function store(Request $request)
	{
		$validate = array(
			'label' => 'required',
			'property_id' => 'required'
		);

		$validator = Validator::make($request->all(), $validate, $this->messages);
		if ($validator->fails()) {
			return $this->send_error(
				'Erro ao tentar cadastrar área homogênea',
				$validator->errors()
			);
		}

		$check_label = $this->check_label(
			$request->get('label')
		);
		if (!$check_label) {
			return $this->send_error(
				'Área homogênea já existe',
				'Verifique o rótulo'
			);
		}

		$homogeneous_area = new HomogeneousArea();
		$homogeneous_area->fill($request->all());
		$homogeneous_area->save();

		return $this->send_response(
			new HomogeneousAreaResource($homogeneous_area),
			'Área homogênea registrada',
			201
		);
	}

	public function show(HomogeneousArea $homogeneous_area)
	{
		if (!$homogeneous_area) {
			return $this->send_error('Área homogênea não encontrada');
		}

		return $this->send_response(new HomogeneousAreaResource($homogeneous_area));
	}

	public function update(Request $request, $homogeneous_area)
	{
		if (!$haEntity = HomogeneousArea::find(intval($homogeneous_area))) {
			return $this->send_error('Área homogênea não encontrada');
		}

		$check_label = $this->check_label($request->get('label'));
		if (!$check_label && $homogeneous_area->label != $request->get('label')) {
			return $this->send_error(
				'Área homogênea',
				'Verifique o rótulo'
			);
		}

		$homogeneous_area_data = $request->only(
			'label',
			'property_id'
		);
		$haEntity->update($homogeneous_area_data);

		return $this->send_response(
			new HomogeneousAreaResource($haEntity),
			'Área homogênea atualizada'
		);
	}

	public function status(Request $request, $homogeneous_area)
	{
		if (!$haEntity = HomogeneousArea::find(intval($homogeneous_area))) {
			return $this->send_error('Área homogênea não encontrada');
		}

		if ($request->status) {
			$haEntity->status = true;
			$haEntity->update();

			return $this->send_response(
				new HomogeneousAreaResource($haEntity),
				'Área homogênea ativada',
				200
			);
		}

		$haEntity->status = false;
		$haEntity->update();

		return $this->send_response(
			new HomogeneousAreaResource($haEntity),
			'Área homogênea desativada',
			200
		);
	}

	public function check_label($label)
	{
		$label_lower = strtolower($label);
		$checker = HomogeneousArea::where(DB::raw('LOWER(label)'), 'LIKE', $label_lower)
			->get()
			->toArray();

		if ($checker) {
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
