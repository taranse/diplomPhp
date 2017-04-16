<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    public static $rubrics = [
        ['title' => 'rubric 1', 'link' => 'rubric-one'],
        ['title' => 'rubric 2', 'link' => 'rubric-two'],
        ['title' => 'rubric 3', 'link' => 'rubric-three'],
        ['title' => 'rubric 4', 'link' => 'rubric-fourth'],
        ['title' => 'rubric 5', 'link' => 'rubric-fifth'],
        ['title' => 'rubric 6', 'link' => 'rubric-sixth'],
        ['title' => 'rubric 7', 'link' => 'rubric-seventh']
    ];
}
