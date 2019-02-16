<?php

namespace Tests\Unit;

use App\Model\Lesson;
use App\Model\Series;
use App\User;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_complete_lesson()
    {
        $this->flushRedis();

        $user = factory(User::class)->create();

        $series = factory(Series::class)->create();
        $lesson1 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);

        factory(Lesson::class)->create(['series_id' => 1]);
        factory(Lesson::class)->create(['series_id' => 1]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $this->assertEquals(\Redis::smembers('user:1:series:1'), [1, 2]);

        $this->assertEquals($user->getNumCompleteLessonInSeries($lesson1->series), 2);

        $this->assertEquals($user->getPerCompleteSeries($lesson1->series), 50);

    }

    public function test_if_user_has_completed_a_lesson(){

        $this->flushRedis();

        $user = factory(User::class)->create();

        $series = factory(Series::class)->create();
        $series2 = factory(Series::class)->create();

        $lesson1 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson3 = factory(Lesson::class)->create(['series_id' => 1]);

        $lesson4 = factory(Lesson::class)->create(['series_id' => 2]);
        $lesson5 = factory(Lesson::class)->create(['series_id' => 2]);

        factory(Lesson::class)->create(['series_id' => 1]);
        factory(Lesson::class)->create(['series_id' => 1]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $user->completeLesson($lesson4);

        $this->assertTrue($user->hasCompletedLesson($lesson1));
        $this->assertTrue($user->hasCompletedLesson($lesson2));
        $this->assertTrue($user->hasCompletedLesson($lesson4));

        $this->assertFalse($user->hasCompletedLesson($lesson3));
        $this->assertFalse($user->hasCompletedLesson($lesson5));

    }

    public function test_user_have_started_a_series_or_not(){

        $this->flushRedis();

        $user = factory(User::class)->create();

        $series = factory(Series::class)->create();
        $series2 = factory(Series::class)->create();

        $lesson1 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson2 = factory(Lesson::class)->create(['series_id' => 2]);

        factory(Lesson::class)->create(['series_id' => 1]);
        factory(Lesson::class)->create(['series_id' => 1]);

        $user->completeLesson($lesson1);

        $this->assertTrue($user->hasStartedSeries($lesson1->series));
        $this->assertFalse($user->hasStartedSeries($lesson2->series));

    }

    public function test_number_of_completed_lesson(){

        $this->flushRedis();

        $user = factory(User::class)->create();

        $series = factory(Series::class)->create();

        $lesson1 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson2 = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson3 = factory(Lesson::class)->create(['series_id' => 1]);

        factory(Lesson::class)->create(['series_id' => 1]);
        factory(Lesson::class)->create(['series_id' => 1]);

        $user->completeLesson($lesson1);
        $user->completeLesson($lesson2);

        $getCompletedLesson = $user->getCompletedLessonsInSeries($lesson1->series);

        $this->assertInstanceOf(Collection::class, $getCompletedLesson);
        $this->assertInstanceOf(Lesson::class, $getCompletedLesson->random());

        $getCompletedLessonIds = $user->getIdsOfCompletedLessonsInSeries($lesson1->series);

        $this->assertTrue(in_array($lesson1->id, $getCompletedLessonIds));
        $this->assertTrue(in_array($lesson2->id,$getCompletedLessonIds));
        $this->assertFalse(in_array($lesson3->id, $getCompletedLessonIds));


    }
    public function test_can_get_all_series_being_watched_by_user() {

        $this->flushRedis();

        $user = factory(User::class)->create();

        $series1 = factory(Series::class)->create();
        $series2 = factory(Series::class)->create();
        $series3 = factory(Series::class)->create();

        $lesson = factory(Lesson::class)->create(['series_id' => 1]);
        $lesson2 = factory(Lesson::class)->create([ 'series_id' => 1 ]);
        $lesson3 = factory(Lesson::class)->create(['series_id' => 2]);
        $lesson4 = factory(Lesson::class)->create([ 'series_id' => 2 ]);

        $lesson5 = factory(Lesson::class)->create(['series_id' => 3]);
        $lesson6 = factory(Lesson::class)->create([ 'series_id' => 3 ]);

        $user->completeLesson($lesson);
        $user->completeLesson($lesson3);

        $startedSeries = $user->getSeriesBeingWatched();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $startedSeries);
        $this->assertInstanceOf(\App\Model\Series::class, $startedSeries->random());
        $idsOfStartedSeries = $startedSeries->pluck('id')->all();

        $this->assertTrue(
            in_array($series1->id, $idsOfStartedSeries)
        );
        $this->assertTrue(
            in_array($series2->id, $idsOfStartedSeries)
        );
        $this->assertFalse(
            in_array($series3->id, $idsOfStartedSeries)
        );
    }

    public function test_can_get_number_of_completed_lessons_for_a_user() {
        //user
        $this->flushRedis();
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();
        $series2 = factory(Series::class)->create();

        $lesson = factory(Lesson::class)->create([ 'series_id' => 1 ]);
        $lesson2 = factory(Lesson::class)->create([ 'series_id' => 1 ]);
        $lesson3 = factory(Lesson::class)->create([ 'series_id' => 2 ]);
        $lesson4 = factory(Lesson::class)->create([ 'series_id' => 2 ]);
        $lesson5 = factory(Lesson::class)->create([ 'series_id' => 2 ]);

        $user->completeLesson($lesson);
        $user->completeLesson($lesson3);
        $user->completeLesson($lesson5);

        $this->assertEquals(3, $user->getTotalNumberOfCompletedLessons());
    }

    public function test_can_get_next_lesson_to_be_watched_by_user() {

        $this->flushRedis();
        $user = factory(User::class)->create();
        $series = factory(Series::class)->create();

        $lesson = factory(Lesson::class)->create(['series_id' => 1, 'episode_number' => 100 ]);
        $lesson2 = factory(Lesson::class)->create([ 'series_id' => 1, 'episode_number' => 500 ]);
        $lesson3 = factory(Lesson::class)->create([ 'series_id' => 1, 'episode_number' => 700 ]);
        $lesson4 = factory(Lesson::class)->create([ 'series_id' => 1, 'episode_number' => 200 ]);

        $nextLesson1 = $user->getNextLessonToWatch($series);
        $this->assertEquals($lesson->id, $nextLesson1->id);

        $user->completeLesson($lesson4);
        $user->completeLesson($lesson);

        $nextLesson = $user->getNextLessonToWatch($series);

        $this->assertEquals($lesson2->id, $nextLesson->id);

        $user->completeLesson($lesson2);

        $this->assertEquals($lesson3->id, $user->getNextLessonToWatch($series)->id);
    }





}
