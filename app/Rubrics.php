<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrics extends Model
{

    public static function routeInRubrics($route) {
        foreach(self::all() as $rubric) {
            if($rubric->alias == $route) return $rubric;
        }
    }

}
