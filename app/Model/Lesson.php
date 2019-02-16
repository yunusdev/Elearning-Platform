<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    public $guarded = [];

    public  function series(){

        return $this->belongsTo(Series::class);
    }

    public function getNextLesson() {
        $nextLesson = $this->series->lessons()->where('episode_number', '>', $this->episode_number)
            ->orderBy('episode_number', 'asc')
            ->first();

        if($nextLesson) {
            return $nextLesson;
        }

        return $this;
    }

    public function getPrevLesson() {

        $prevLesson = $this->series->lessons()->where('episode_number', '<', $this->episode_number)
            ->orderBy('episode_number', 'desc')
            ->first();

        if($prevLesson) {
            return $prevLesson;
        }

        return $this;
    }

    public function getOrderedLessons() {

        $series = $this->series;

        return $this->where('series_id', $series->id)->orderBy('episode_number', 'asc')->get();

    }
}
