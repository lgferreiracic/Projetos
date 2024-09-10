<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\VisitInformation;
use App\Http\Resources\VisitInformationResource;

class VisitInformationController extends BaseController
{
    public function index(Request $request)
	{
		$haid = $request->get('haid');
		$visits_information = VisitInformation::where('homogeneous_area_id', '=', $haid)
			->orderBy('created_at', 'asc')
			->get();

		return $this->send_response(VisitInformationResource::collection($visits_information));
	}

	public function show(Request $request, VisitInformation $tree_visit)
	{
		return $this->send_response(new VisitInformationResource($tree_visit));
	}
}
