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

	//Modificado
	public function export_pdf2(Request $request)
	{
		try {
			$propertyId = $request->get('property_id');

			// Verifique se o ID da propriedade foi enviado
			if (!$propertyId) {
				return response()->json(['error' => 'Property ID not provided'], 400);
			}

			// Encontre a propriedade pelo ID
			$property = Property::find($propertyId);

			// Verifique se a propriedade existe
			if (!$property) {
				return response()->json(['error' => 'Property not found'], 404);
			}

			// Gere o PDF para a propriedade
			$pdf = PDF::loadView('templates.properties2', ['property' => $property]);

			// Retorne o PDF para download com o nome apropriado
			return $pdf->download('property_' . $property->id . '.pdf');

		} catch (\Exception $e) {
			// Registre o erro no log do Laravel e retorne uma resposta de erro
			\Log::error('Erro ao gerar PDF: ' . $e->getMessage());
			return response()->json(['error' => 'Erro ao gerar o PDF'], 500);
		}
	}


	//Modificado

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
