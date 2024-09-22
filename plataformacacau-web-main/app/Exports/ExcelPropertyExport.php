<?php

namespace App\Exports;

use App\Http\Resources\SamplingPointResource;
use App\Models\SamplingPoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExcelPropertyExport implements WithMultipleSheets, ShouldQueue
{
    use Exportable;

    private $propertyId;
    private $startDate;
    private $endDate;

    public function __construct($propertyId, $startDate, $endDate)
    {
        $this->propertyId = $propertyId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        $sheets = [];
        
        // Filtrar Sampling Points com base no propertyId
        $sampling_points = SamplingPoint::whereHas('stratum', function($query) {
            $query->where('property_id', $this->propertyId);
        })->get();

        // Gerar uma planilha por ponto amostral
        foreach ($sampling_points as $sampling_point) {
            $sheets[] = new ExcelPropertySheet($sampling_point, $this->startDate, $this->endDate);
        }

        return $sheets;
    }
}
