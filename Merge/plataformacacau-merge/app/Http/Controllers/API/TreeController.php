<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SamplingPointResource;
use App\Models\Tree;
use Illuminate\Http\Request;
use App\Http\Resources\TreeResource;
use App\Models\SamplingPoint;
use Illuminate\Support\Facades\Validator;

/**
 * @group Gerenciamento de Árvores
 * 
 * @authenticated
 * 
 * Endpoints e funções para gerenciamento de árvores
 * 
 * @apiResourceCollection App\Http\Resources\TreeResource
 * @apiResourceModel App\Models\Tree
 */
class TreeController extends BaseController
{
	protected $messages = [
		'label.required' => 'Rótulo inválido',
		'status.required' => 'Status inválido',
	];

	/**
	 * Exibe todas as árvores referentes ao ponto amostral
	 * 
	 * @queryParam spid required Identificador único do ponto amostral. Example: 1
	 * 
	 * @responseFile responses/trees/index.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param int  $spid
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$spid = $request->get('spid');
		$trees = Tree::where('sampling_point_id', '=', $spid)
			->orderBy('id', 'asc')
			->get();

		return $this->send_response(TreeResource::collection($trees));
	}

	/**
	 * Armazena uma nova árvore e vincula à um ponto amostral
	 *
	 * @queryParam spid required Identificador único do ponto amostral. Example: 1
	 * 
	 * @bodyParam label string required Rótulo para a árvore. Example: Árvore 100
	 * @bodyParam status bool required Status atual da árvore (ativo ou inativo). Example: true
	 * 
	 * @responseFile responses/trees/store.json
	 * @responseFile 404 responses/404.json
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validate = array(
			'spid' => 'required',
		);

		$validator = Validator::make($request->all(), $validate);

		if ($validator->fails()) {
			return $this->send_error('Erro ao tentar criar uma árvore');
		}

		$spid = $request->get('spid');
		$number_trees = Tree::where('status', true)
			->where('sampling_point_id', $spid)
			->count();

		if ($number_trees === 7) {
			return $this->send_error('Impossível adicionar mais árvores');
		}
		for ($i = 0; $i < 7; $i++) {
			$rule = Tree::where('label', ($i + 1))
				->where('status', true)
				->where('sampling_point_id', $spid)
				->first();

			if (!$rule) {
				$tree = new Tree();
				$tree->label = ($i + 1);
				$tree->status = true;
				$tree->sampling_point_id = $spid;
				$tree->save();

				break;
			}
		}

		return $this->send_response(
			new SamplingPointResource(SamplingPoint::find($spid)),
			'Árvore(s) registrada(s)'
		);
	}

	/**
	 * Exibe uma árvore específica
	 * 
	 * @queryParam spid required Identificador único do ponto amostral. Example: 1
	 * @queryParam tree required Identificador único da árvore. Example: 1
	 * 
	 * @responseFile responses/trees/show.json
	 * @responseFile 404 responses/404.json
	 *
	 * @param int $spid
	 * @param  \App\Models\Tree  $tree
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, Tree $tree)
	{
		return $this->send_response(new TreeResource($tree));
	}

	/**
	 * Atualiza uma árvore específica
	 * 
	 * @queryParam spid required Identificador único do ponto amostral. Example: 1
	 * @queryParam tree required Identificador único da árvore. Example: 1
	 *
	 * @bodyParam label string required Rótulo para a árvore. Example: Árvore Morta
	 * @bodyParam status bool required Status atual da árvore (ativo ou inativo). Example: false
	 * 
	 * @responseFile responses/trees/update.json
	 * @responseFile 404 responses/404.json
	 * 
	 * @param int  $spid
	 * @param  \App\Models\Tree  $tree
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Tree $tree)
	{
		if (!$tree) {
			$this->send_error('Árvore não encontrada');
		}

		$trees = Tree::where('rfid', '=', $request->get('rfid'))
			->orderBy('id', 'asc')
			->get();

		if ($trees) {
			return $this->send_error('RFID já registrado. Informe outro valor!');
		}

		$data = $request->all();
		$tree->update($data);

		return $this->send_response(
			new TreeResource($tree),
			'Árvore atualizada'
		);
	}

	/**
	 * Desativa uma árvore específica
	 *
	 * @queryParam spid required Identificador único do ponto amostral. Example: 1
	 * @queryParam tree required Identificador único da árvore. Example: 1
	 * 
	 * @responseFile responses/trees/deactivate.json
	 * @responseFile 404 responses/404.json
	 * 
	 * @param int $spid
	 * @param  \App\Models\Tree  $tree
	 * @return \Illuminate\Http\Response
	 */
	public function deactivate(Request $request, Tree $tree)
	{
		if (!$tree) {
			$this->send_error('Árvore não encontrada');
		}

		if (!$tree->status) {
			$this->send_error('Árvore já se encontra inativa');
		}

		$spid = $request->spid;
		$number_trees = Tree::where('status', true)
			->where('sampling_point_id', $spid)
			->count();

		if ($number_trees === 7 && $tree->status) {
			return $this->send_error('Impossível ativar mais árvores');
		}

		$tree->status = false;
		$tree->update();

		return $this->send_response(
			new TreeResource($tree),
			'Árvore desativada',
			200
		);
	}
}
