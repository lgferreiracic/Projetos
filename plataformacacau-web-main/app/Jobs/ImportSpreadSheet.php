<?php

namespace App\Jobs;

use App\Imports;
use App\Imports\DataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
/*
class ImportSpreadSheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $tries = 100;
	
    //Modificado
    public function retryUntil()
    {
        return now()->addMinutes(10);
    }
   
    public function handle()
    {
        Excel::import(new DataImport, storage_path("data_test_v1.csv"));
		return response()->json(['message' => 'Imported data.']);
    }
}
*/
class ImportSpreadSheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_name;

    public function __construct($file_name)
    {
        $this->file_name = $file_name;
    }

    public function handle()
    {
        $filePath = storage_path('app/' . $this->file_name); // Caminho completo do arquivo no storage

        if (file_exists($filePath)) {
            Excel::import(new DataImport, $filePath);
        } else {
            throw new \Exception("File not found: " . $filePath);
        }
    }
}

