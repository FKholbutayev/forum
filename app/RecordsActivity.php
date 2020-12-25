<?php


namespace App;


trait RecordsActivity
{
    public static function bootRecordsActivity() {
        static::created(function($thread) {
            $thread->recordActivity('created');
        });
    }

    public function getActivityType($event)
    {
        return $event . '_' . strtolower((new \ReflectionClass($this))->getShortName());
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    public function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->user()->id,
            'type' => $this->getActivityType($event),
        ]);
    }
}
