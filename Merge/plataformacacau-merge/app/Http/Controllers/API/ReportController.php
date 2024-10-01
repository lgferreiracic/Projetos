<?php

namespace App\Http\Controllers\API;

use PDF;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Exports\ExcelExport;
use App\Imports\ExcelImport;
use App\Exports\BlockExport;
use App\Jobs\ImportSpreadSheet;

use App\User;
use App\Models\Stratum;
use App\Models\Property;
use App\Models\TreeVisit;
use App\Models\SamplingPoint;

class ReportController extends BaseController
{
	public function export_pdf(Request $request)
	{
		$target = $request->get('target');

		switch ($target) {
			case 'users':
				$data = User::all();
				break;
			case 'strata':
				$data = Stratum::all();
				break;
			case 'sampling_points':
				$data = SamplingPoint::get()->groupBy('stratum_id');
				break;
			case 'properties':
				$data = Property::all();
				break;
			case 'visits':
				$data = TreeVisit::get()->groupBy('visit_information_id');
				break;
			default:
				break;
		}

		$pdf = PDF::loadView('templates.' . $target, compact('data'));

		return $pdf->stream();
	}

	public function export_xls(Request $request)
	{
		// TODO
		return Excel::download(new ExcelExport, 'plataforma-cacau.xlsx');
	}

	public function export_csv(Request $request)
	{
		// TODO
		// return Excel::download(new ExcelExport, 'plataforma-cacau.csv');
		return (new ExcelExport)->download('plataforma-cacau.csv', \Maatwebsite\Excel\Excel::CSV, [
			'Content-Type' => 'text/csv',
		]);
	}

	public function export_block_without_sharing(Request $request)
	{
		$propertyId = $request->query('propid');

		try {
			return (new BlockExport($propertyId))->download('plataforma-cacau.xlsx');
		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
			]);
		}
	}

	public function import_xsl(Request $request)
	{
		$import = new ExcelImport();
		return $import->import($request);
		// try {
		// 	if ($request->hasFile('file')) {
		// 		$file = $request->file('file');
		// 		$original_name = $file->getClientOriginalName();
		// 		$ext = $file->getClientOriginalExtension();

		// 		$file_name = $original_name;

		// 		Storage::disk('local')->put($file_name, file_get_contents($file));

		// 		$import = new ExcelImport();
		// 		$import->import($original_name, $ext);

		// 		return response()->json([
		// 			'message' => 'File uploaded successfully'
		// 		], 200);
		// 	}
		// } catch(\Exception $e) {
		// 	return response()->json([
		// 		'message' => $e->getMessage(),
		// 	]);
		// }
	}

	public function import_csv(Request $request)
	{
		// TODO
	}
}
