<?php

namespace App\Listeners;

use App\Events\VideoUploaded;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogVideos
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VideoUploaded $event): void
    {
        $log = new Log([
            'title' => $event->video->title,
            'data' => 'video uploaded',
        ]);
        $log->save();
    }
}
