<?php

namespace App\Exports;

use App\Models\SamplingPoint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\Log;

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
        // Aqui retornamos apenas uma instância de ExcelPropertySheet
        Log::info('Exporting data for property', [
            'property_id' => $this->propertyId,
        ]);

        // Passa o ID da propriedade, data de início e fim para a planilha
        return [new ExcelPropertySheet($this->propertyId, $this->startDate, $this->endDate)];
    }
}
