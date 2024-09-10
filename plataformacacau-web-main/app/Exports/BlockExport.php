<?php

namespace App\Exports;

use App\Models\Block;
use App\Http\Resources\BlockResource;
use App\Http\Resources\SoilClassResource;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlockExport implements FromView, ShouldQueue
{
  use Exportable;

  protected $propertyId;

  public function __construct($propertyId)
  {
    $this->propertyId = $propertyId;
  }

  public function view(): View
  {
    $filtered_blocks = Block::where('property_id', '=', $this->propertyId)
      ->orderBy('id', 'asc')
      ->get();

    $blocks = BlockResource::collection($filtered_blocks);

    return view('templates.block-resume', [
      'blocks' => BlockResource::collection($blocks),
    ]);
  }
}
