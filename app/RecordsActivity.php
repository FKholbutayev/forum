<?php


namespace App;


trait RecordsActivity
{
    public static function bootRecordsActivity() {

        if (auth()->guest()) return;

        static::created(function($model) {
            $model->recordActivity('created');
        });

        static::deleting(function($model) {
            $model->activity()->delete();
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
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
        ]);
    }
}
