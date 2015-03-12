<?php


namespace Ubt\EventListeners;


use Illuminate\Support\Facades\Log;

class bookWasReaded {
    public function fire($data){
        Log::info($data[0]->name." started reading : ".$data[1]->title);
    }
} 