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

class ImportSpreadSheet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	public $tries = 100;
	// public $filename = '';
	// public $ext = '';

	/**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct($fileName, $ext)
    public function __construct()
    {
		// $this->filename = $fileName;
		// $this->ext = $ext;
	}

    /**
     * Determine the time at which the job should timeout.
     *
     * @return \DateTime
     */
    public function retryUntil()
    {
        return now()->addMinutes(10);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::import(new DataImport, storage_path("data_test_v1.csv"));
        // Excel::import(new DataImport, storage_path($this->filename));
		return response()->json(['message' => 'Imported data.']);
    }
}
