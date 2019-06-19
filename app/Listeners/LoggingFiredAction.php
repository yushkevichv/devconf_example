<?php

namespace App\Listeners;

use App\Events\EventForLoggingFired;
use App\UsefulLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class LoggingFiredAction
{

    /**
     * Handle the event.
     *
     * @param  EventForLoggingFired  $event
     * @return void
     */
    public function handle(EventForLoggingFired $event)
    {
        $data = [
            'modellable_type' => get_class($event->model),
            'modellable_id' => $event->model->getKey(),
            'extra_data' => $event->extraData,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        Storage::append(UsefulLog::LOG_FILE_NAME, implode(';', $data));
    }
}
