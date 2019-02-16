<?php

namespace Tests\Unit;

use App\Model\Lesson;
use App\Model\Series;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;


    public function test_a_user_can_get_ordered_lessons_of_completed_lesson()
    {
        $this->flushRedis();


        $user = factory(User::class)->create();

        $series = factory(Series::class)->create();

        $lesson1 = factory(Lesson::class)->create(['series_id' => 1,'episode_number' => 100]);

        $lesson2 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 450]);

        $lesson3 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 350]);

        $lesson4 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 200]);

        $lesson5 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 250]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);
        $user->completeLesson($lesson3);
        $user->completeLesson($lesson4);
        $user->completeLesson($lesson5);

        $getOrderedLessons = $user->getOrderedCompletedLessons($lesson1->series);

        $getOrderedLessonsId = $getOrderedLessons->pluck('id')->all();

        $real = [$lesson1->id, $lesson4->id, $lesson5->id, $lesson3->id,$lesson2->id];

        $this->assertEquals($real, $getOrderedLessonsId);


    }

    public  function test_can_get_ordered_lessons_for_a_series(){

        $this->flushRedis();

        $series = factory(Series::class)->create();

        $lesson1 = factory(Lesson::class)->create(['series_id' => 1,'episode_number' => 100]);

        $lesson2 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 450]);

        $lesson3 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 350]);

        $lesson4 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 200]);

        $lesson5 = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 250]);

        $lessons = $lesson2->series->getOrderedLessons();

        $this->assertEquals($lessons->first()->id, $lesson1->id);
        $this->assertEquals($lessons->last()->id, $lesson2->id);

    }
}
