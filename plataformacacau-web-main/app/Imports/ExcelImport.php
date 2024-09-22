<?php

namespace App\Imports;

use App\Jobs\ImportSpreadSheet;

use App\Imports\DataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
/*
class ExcelImport
{
	// public function import(string $original_name, string $ext)
	public function import(Request $request)
	{
		// $importJob = new ImportSpreadSheet($original_name, $ext);
		$importJob = new ImportSpreadSheet();
		dispatch($importJob);
	}
}*/
class ExcelImport
{
    public function import(string $file_name)
    {
        $importJob = new ImportSpreadSheet($file_name);
        dispatch($importJob);
    }
}

