<?php

namespace App\Exports;

use App\Http\Resources\TreeVisitResource;
use App\Http\Resources\PropertyResource;
use App\Models\TreeVisit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExcelSheet implements FromView, WithTitle
{
	private $sampling_point;

	public function __construct($sampling_point)
	{
		$this->sampling_point = $sampling_point;
	}

	public function view(): View
	{
		$tree_visits = TreeVisit::join('trees', 'trees.id', '=', 'tree_visits.tree_id')
			->join(
				'sampling_points',
				'sampling_points.id',
				'=',
				'trees.sampling_point_id'
			)
			->where('trees.sampling_point_id', '=', $this->sampling_point->id)
			->select('tree_visits.*')
			->get();

		$data = TreeVisitResource::collection($tree_visits);

		return view('templates.xls-v2', [
			'data' => $data,
			'sampling_point' => $this->sampling_point,
			// 'property' => new PropertyResource($this->sampling_point->stratum()->first()->property),
		]);
	}

	public function title(): string
	{
		$title = 'P.A. ' . $this->sampling_point->id .
			' - U.O. ' . $this->sampling_point->stratum()->first()->label;

		return $title;
	}
}
