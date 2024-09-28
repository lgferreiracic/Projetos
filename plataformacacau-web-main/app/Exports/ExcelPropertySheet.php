<?php

namespace App\Exports;

use App\Http\Resources\TreeVisitResource;
use App\Models\SamplingPoint;
use App\Models\TreeVisit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\Log;

class ExcelPropertySheet implements FromView, WithTitle
{
    private $propertyId;
    private $startDate;
    private $endDate;

    public function __construct($propertyId, $startDate, $endDate)
    {
        $this->propertyId = $propertyId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        // Filtrar Sampling Points com base no propertyId
        $sampling_points = SamplingPoint::whereHas('stratum', function ($query) {
            $query->where('property_id', $this->propertyId);
        })->get();

        // Inicializa uma coleção para armazenar todas as visitas de árvores
        $all_tree_visits = collect();

        // Loop para processar todos os pontos amostrais
        foreach ($sampling_points as $sampling_point) {
            $tree_visits = TreeVisit::join('trees', 'trees.id', '=', 'tree_visits.tree_id')
                ->join('sampling_points', 'sampling_points.id', '=', 'trees.sampling_point_id')
                ->join('strata', 'strata.id', '=', 'sampling_points.stratum_id')
                ->join('homogeneous_areas', 'homogeneous_areas.id', '=', 'strata.homogeneous_area_id')
                ->where('trees.sampling_point_id', '=', $sampling_point->id)
                ->whereBetween('tree_visits.date', [$this->startDate, $this->endDate])
                ->select(
                    'tree_visits.*',
                    'trees.id as tree_id',
                    'sampling_points.id as sampling_point_id',
                    'strata.id as stratum_id',
                    'homogeneous_areas.id as homogeneous_area_id'
                )
                ->get();

            $all_tree_visits = $all_tree_visits->merge($tree_visits);

            // Log para verificar os dados do ponto amostral e suas visitas
            foreach ($tree_visits as $visit) {
                Log::info('Tree Visit Data', [
                    'tree_id' => $visit->tree_id,
                    'sampling_point_id' => $visit->sampling_point_id,
                    'stratum_id' => $visit->stratum_id,
                    'homogeneous_area_id' => $visit->homogeneous_area_id,
                ]);
            }
        }

        Log::info('Total tree visits processed:', [
            'total_visits' => $all_tree_visits->count(),
        ]);

        // Converter os dados das visitas para TreeVisitResource e passar para a view
        $data = TreeVisitResource::collection($all_tree_visits);

        return view('templates.xls-v2', [
            'data' => $data,
            'property_id' => $this->propertyId,
        ]);
    }

    public function title(): string
    {
        return 'Dados da Propriedade ' . $this->propertyId;
    }
}
