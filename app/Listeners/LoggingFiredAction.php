<?php

namespace App\Listeners;

use App\Events\EventForLoggingFired;
use App\UsefulLog;

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
        UsefulLog::create([
            'modellable_type' => get_class($event->model),
            'modellable_id' => $event->model->getKey(),
            'extra_data' => $event->extraData
        ]);
    }
}
