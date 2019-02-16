<?php

use Illuminate\Database\Seeder;

class SeriesLessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        Redis::flushall();
        \DB::table('users')->delete();
        \DB::table('series')->delete();
        \DB::table('lessons')->delete();


        factory(\App\User::class, 3)->create();

        factory(\App\User::class)->create([
            'name' => 'Adebayo Adeniji',
            'email' => 'ade@gmail.com'
        ]);



        factory(\App\Model\Series::class, 5)->create()->each(function ($s){

            $s->lessons()->saveMany(factory(\App\Model\Lesson::class, 5)->make());

        });
    }
}
