<?php

namespace App\Http\Controllers\API;

use App\Models\TreeVisit;
use Illuminate\Http\Request;
use App\Http\Resources\TreeVisitResource;

/**
 * @group Gerenciamento de Visitas
 * 
 * @authenticated
 * 
 * Endpoints e funções para gerenciamento de visitas
 * 
 * @apiResourceCollection App\Http\Resources\TreeVisitResource
 * @apiResourceModel App\Models\TreeVisit
 */
class TreeVisitController extends BaseController
{
	/**
	 * Exibe todas as visitas referentes à árvore específica
	 *
	 * @queryParam trid required Identificador único da árvore. Example 1
	 * 
	 * @responseFile responses/tree_visits/index.json
	 * @responseFile 404 responses/404.json
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$trid = $request->get('trid');
		$tree_visits = TreeVisit::where('tree_id', '=', $trid)
			->orderBy('created_at', 'asc')
			->get();

		return $this->send_response(TreeVisitResource::collection($tree_visits));
	}

	/**
	 * Exibe as informações de uma visita específica
	 * 
	 * @queryParam trid required Identificador único da árvore. Example: 1
	 * @queryParam tree_visit required Identificador único da visita. Example: 1
	 * 
	 * @responseFile responses/tree_visits/show.json
	 * @responseFile 404 responses/404.json
	 * 
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\TreeVisit  $tree_visit
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, TreeVisit $tree_visit)
	{
		return $this->send_response(new TreeVisitResource($tree_visit));
	}
}
