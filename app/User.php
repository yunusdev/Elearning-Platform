<?php

namespace App;

use App\Entities\Learning;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Config;
use Redis;

class User extends Authenticatable
{
    use Notifiable, Learning;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return in_array($this->email,  ['ade@gmail.com', 'yunus@gmail.com']);
//        dd(config('admin.administrators'));
    }




}
