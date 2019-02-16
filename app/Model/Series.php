<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
    public $guarded = [];

    public $with = ['lessons'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function lessons(){

        return $this->hasMany(Lesson::class);

    }

    public function SetTitleAttribute($value){

        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getOrderedLessons() {

        return $this->lessons()->orderBy('episode_number', 'asc')->get();

    }

}
