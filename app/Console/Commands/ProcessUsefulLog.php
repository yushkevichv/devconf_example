<?php

namespace App\Console\Commands;

use App\UsefulLog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProcessUsefulLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'useful-log:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process batch store log';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!Storage::exists(UsefulLog::LOG_FILE_NAME) || (Storage::size(UsefulLog::LOG_FILE_NAME) === 0)) {
            return;
        }

        // @todo add work with failed processing

        $fileName = date('y-m-d_H-i-s').'_'.UsefulLog::LOG_FILE_NAME;

        // copy file to processing
        Storage::move(UsefulLog::LOG_FILE_NAME, $fileName);

        $filePath = storage_path('app/'.$fileName);

        $query = "LOAD DATA LOCAL INFILE '$filePath'
            INTO TABLE useful_logs 
            FIELDS TERMINATED BY ';' 
            OPTIONALLY ENCLOSED BY '\"' 
            ESCAPED BY '\"' 
            LINES TERMINATED BY '\\n'
            IGNORE 0 LINES (`modellable_type`, `modellable_id`, `extra_data`, `created_at`, `updated_at`);
        ";

        DB::connection()->getPdo()->exec($query);

        Storage::delete($fileName);
    }
}
