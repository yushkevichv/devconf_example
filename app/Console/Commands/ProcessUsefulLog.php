<?php

namespace App\Console\Commands;

use App\UsefulLog;
use Illuminate\Console\Command;
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

        $file = fopen($filePath, "r");
        $array = [];

        while (($data = fgetcsv($file, 200, ";")) !== false) {
            array_push($array, [
                'modellable_type' => $data[0],
                'modellable_id' => $data[1],
                'extra_data' => $data[2],
                'created_at' => $data[3],
                'updated_at' => $data[4],
            ]);
        }
        fclose($file);

        UsefulLog::insert($array);

        Storage::delete($fileName);
    }
}
