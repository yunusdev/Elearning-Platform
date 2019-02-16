<?php
/**
 * Created by PhpStorm.
 * User: QUDUS
 * Date: 2/13/2019
 * Time: 12:03 PM
 */

namespace App\Entities;
use App\Model\Lesson;
use App\Model\Series;
use function foo\func;
use Redis;

trait Learning{

    public function completeLesson($lesson){

        return Redis::sadd("user:{$this->id}:series:{$lesson->series->id}", $lesson->id);

    }

    public function hasCompletedLesson($lesson){

        return in_array($lesson->id, $this->getIdsOfCompletedLessonsInSeries($lesson->series));

    }

    public function getNumCompleteLessonInSeries($series){

        return count($this->getIdsOfCompletedLessonsInSeries($series));

    }


    // returns a list of the ids of lessons of completed series e.g. [1, 2, 3]
    public function getIdsOfCompletedLessonsInSeries($series){

        return Redis::smembers("user:{$this->id}:series:{$series->id}");

    }

    public function getPerCompleteSeries($series){

        $totalNumOfLesson = $series->lessons->count();

        $lessonComp = $this->getNumCompleteLessonInSeries($series);

        return ($lessonComp / $totalNumOfLesson) * 100;

    }

    public function hasStartedSeries($series){

        return $this->getNumCompleteLessonInSeries($series) > 0;

    }

    #returns the collection of lessons completed in the series
    public function getCompletedLessonsInSeries($series){

        $compLessonIds = $this->getIdsOfCompletedLessonsInSeries($series);

        return collect($compLessonIds)->map(function ($id){

            return Lesson::find($id);

        });

    }

    public function getOrderedCompletedLessonsInSeries($series){

      return $this->getCompletedLessonsInSeries($series)->sortBy('episode_number');

    }


    public function getSeriesBeingWatched() {

        $keys = Redis::keys("user:{$this->id}:series:*");
        $seriesIds = [];
        foreach($keys as $key):
            $seriedId = explode(':', $key)[3];
            array_push($seriesIds, $seriedId);
        endforeach;

        return collect($seriesIds)->map(function($id){
            return Series::find($id);
        });

    }

    public function getTotalNumberOfCompletedLessons() {

        $keys = Redis::keys("user:{$this->id}:series:*");

        $result = 0;
        foreach($keys as $key):
            $result = $result + count(Redis::smembers($key));
        endforeach;

        return $result;
    }

    public function getNextLessonToWatch($series){

        $latestLesson =  $this->getOrderedCompletedLessonsInSeries($series)->last();

        if ($latestLesson){

            return $latestLesson->getNextLesson();

        }

        return $series->getOrderedLessons()->first();

    }


}