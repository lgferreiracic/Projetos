<?php

namespace App\Exports;

use App\Http\Resources\SamplingPointResource;
use App\Models\SamplingPoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelExport implements WithMultipleSheets, ShouldQueue
{
	use Exportable;

	public function sheets(): array
	{
		$sheets = [];
		$sampling_points =
			SamplingPointResource::collection(SamplingPoint::all());

		foreach ($sampling_points as $sampling_point) {
			$sheets[] = new ExcelSheet($sampling_point);
		}

		return $sheets;
	}
}
