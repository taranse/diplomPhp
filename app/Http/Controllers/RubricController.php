<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RubricController extends Controller
{

    public function getRubrics()
    {
        return Rubric::$rubric;
    }

}
