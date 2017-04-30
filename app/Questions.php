<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    public static $state;

    static function newQuestions()
    {
        return count(self::where(['state' => 0, 'block' => 0])->get());
    }
    static function blockQuestions()
    {
        return count(self::where('block', '>', 0)->get());
    }


    public static function state()
    {
        $request = explode('/', \Request::route()->uri);
        self::$state = 1;
        if ($request[1] == 'block-questions') {
            self::$state = -1;
        } else if ($request[1] == 'new-questions') {
            self::$state = 0;
        }
        return self::$state;
    }
}
