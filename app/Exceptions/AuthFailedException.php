<?php
/**
 * Created by PhpStorm.
 * User: QUDUS
 * Date: 12/28/2018
 * Time: 9:56 AM
 */


namespace App\Exceptions;

use Exception;

class AuthFailedException extends Exception{


    public function render(){

        return response()->json([

            'message' => 'This credentials do not match our records. '

        ],422);

    }


}