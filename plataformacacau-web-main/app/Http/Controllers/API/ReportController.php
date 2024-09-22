<?php

namespace App\Http\Controllers\API;

use PDF;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Exports\ExcelExport;
use App\Exports\ExcelPropertyExport; //Modificado
use App\Imports\ExcelImport;
use App\Exports\BlockExport;
use App\Jobs\ImportSpreadSheet;

use App\User;
use App\Models\Stratum;
use App\Models\Property;
use App\Models\TreeVisit;
use App\Models\SamplingPoint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
set_time_limit(0);
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
	//Modificado
	public function exportProperty_xls(Request $request)
	{
		try {
			// Validação dos parâmetros
			Log::info('Iniciando exportação XLS.', ['request_data' => $request->all()]);
	
			$request->validate([
				'propertyId' => 'required|integer|exists:properties,id',
				'startDate' => 'required|string', // Outubro/Ano
				'endDate' => 'required|string',   // Setembro/Ano
			]);
	
			$propertyId = $request->input('propertyId');
			$startDateInput = $request->input('startDate'); // Exemplo: "Outubro/2023"
			$endDateInput = $request->input('endDate');     // Exemplo: "Setembro/2024"
	
			Log::info('Datas recebidas:', ['startDate' => $startDateInput, 'endDate' => $endDateInput]);
	
			// Mapeamento de meses de português para inglês
			$months = [
				'Janeiro' => 'January', 'Fevereiro' => 'February', 'Março' => 'March',
				'Abril' => 'April', 'Maio' => 'May', 'Junho' => 'June',
				'Julho' => 'July', 'Agosto' => 'August', 'Setembro' => 'September',
				'Outubro' => 'October', 'Novembro' => 'November', 'Dezembro' => 'December'
			];
	
			// Converter o mês de startDate
			list($startMonth, $startYear) = explode('/', $startDateInput);
			$startMonthEnglish = $months[$startMonth] ?? null;
			if (!$startMonthEnglish) {
				throw new \Exception("Mês de início inválido: $startMonth");
			}
			$startDate = Carbon::createFromFormat('F/Y', $startMonthEnglish.'/'.$startYear)->startOfMonth();
	
			// Converter o mês de endDate
			list($endMonth, $endYear) = explode('/', $endDateInput);
			$endMonthEnglish = $months[$endMonth] ?? null;
			if (!$endMonthEnglish) {
				throw new \Exception("Mês de fim inválido: $endMonth");
			}
			$endDate = Carbon::createFromFormat('F/Y', $endMonthEnglish.'/'.$endYear)->endOfMonth();
	
			Log::info('Datas convertidas:', ['startDate' => $startDate->format('Y-m-d'), 'endDate' => $endDate->format('Y-m-d')]);
	
			// Retornar o arquivo Excel filtrado pela propriedade e intervalo de tempo
			return Excel::download(new ExcelPropertyExport($propertyId, $startDate, $endDate), 'plataforma-cacau.xlsx');
		} catch (\Exception $e) {
			Log::error('Erro ao exportar XLS.', ['error_message' => $e->getMessage()]);
			return response()->json(['error' => 'Erro ao gerar o relatório'], 500);
		}
	}
	//Modificado

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
	/*
	public function import_xsl(Request $request)
	{
		$import = new ExcelImport();
		return $import->import($request);
		try {
		if ($request->hasFile('file')) {
		 		$file = $request->file('file');
		 		$original_name = $file->getClientOriginalName();
			$ext = $file->getClientOriginalExtension();

		 		$file_name = $original_name;

		 		Storage::disk('local')->put($file_name, file_get_contents($file));

		 		$import = new ExcelImport();
				$import->import($original_name, $ext);

		 		return response()->json([
					'message' => 'File uploaded successfully'
		 		], 200);
		 	}
		 } catch(\Exception $e) {
		 	return response()->json([
		 		'message' => $e->getMessage(),
		 	]);
		 }
	}*/
	public function import_xsl(Request $request)
	{
		try {
			if ($request->hasFile('file')) {
				$file = $request->file('file');
				$original_name = $file->getClientOriginalName();
				$file_name = time() . '_' . $original_name; // Nome único
				$file_path = Storage::disk('local')->put($file_name, file_get_contents($file));

				$import = new ExcelImport();
				$import->import($file_name);

				return response()->json([
					'message' => 'File uploaded and imported successfully'
				], 200);
			} else {
				return response()->json(['message' => 'No file uploaded'], 400);
			}
		} catch (\Exception $e) {
			return response()->json([
				'message' => $e->getMessage(),
			], 500);
		}
	}



	/*
	public function import_csv(Request $request)
	{
		// TODO
	}*/
}
