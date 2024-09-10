<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\HomogeneousArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\HomogeneousAreaResource;
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
	public function __construct()
	{
	}

	public function index(Request $request)
	{
		// FIXME: Só retornar as áreas homogêneas que o usuário é dono ou é funcionário
		$user_id = Auth::id();

		if ($user_id === 1) {
			$homogeneous_areas = HomogeneousArea::orderBy('id', 'asc')->get();

			// dd($homogeneous_areas);

			return $this->send_response(HomogeneousAreaResource::collection($homogeneous_areas));
		}

		$propertyId = $request->query('propid');

		$homogeneous_area = HomogeneousArea::where('property_id', '=', $propertyId)->orderBy('id', 'asc')->get();

		return $this->send_response(HomogeneousAreaResource::collection($homogeneous_area));
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
}
