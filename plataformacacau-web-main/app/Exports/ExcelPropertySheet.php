<?php

namespace App\Exports;

use App\Http\Resources\TreeVisitResource;
use App\Models\TreeVisit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\Log;
class ExcelPropertySheet implements FromView, WithTitle
{
    private $sampling_point;
    private $startDate;
    private $endDate;

    public function __construct($sampling_point, $startDate, $endDate)
    {
        $this->sampling_point = $sampling_point;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    /*
    public function view(): View
    {
        // Filtrar visitas pelo ponto amostral e intervalo de datas
        $tree_visits = TreeVisit::join('trees', 'trees.id', '=', 'tree_visits.tree_id')
            ->join('sampling_points', 'sampling_points.id', '=', 'trees.sampling_point_id')
            ->where('trees.sampling_point_id', '=', $this->sampling_point->id)
            ->whereBetween('tree_visits.date', [$this->startDate, $this->endDate])
            ->select('tree_visits.*')
            ->get();

        $data = TreeVisitResource::collection($tree_visits);

        return view('templates.xls-v2', [
            'data' => $data,
            'sampling_point' => $this->sampling_point,
        ]);
    }*/
    public function view(): View
    {
        Log::info('Datas recebidas em ExcelPropertySheet:', ['startDate' => $this->startDate, 'endDate' => $this->endDate]);
        // Filtrar visitas pelo ponto amostral e intervalo de datas
        $tree_visits = TreeVisit::join('trees', 'trees.id', '=', 'tree_visits.tree_id')
            ->join('sampling_points', 'sampling_points.id', '=', 'trees.sampling_point_id')
            ->where('trees.sampling_point_id', '=', $this->sampling_point->id)
            ->whereBetween('tree_visits.date', [$this->startDate, $this->endDate])  // Certifique-se de que 'date' é a coluna correta
            ->select('tree_visits.*')
            ->get();

        $data = TreeVisitResource::collection($tree_visits);

        return view('templates.xls-v2', [
            'data' => $data,
            'sampling_point' => $this->sampling_point,
        ]);
    }

    public function title(): string
    {
        $title = 'P.A. ' . $this->sampling_point->id .
            ' - U.O. ' . $this->sampling_point->stratum()->first()->label;

        return $title;
    }
}
