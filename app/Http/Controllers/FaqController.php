<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RubricController as Rubric;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    function main()
    {
        return view('main', ['rubrics' => Rubric->getRubric(), 'active' => '']);
    }

    function rubric($rubric)
    {
        return view('main', ['rubrics' => '', 'active' => $rubric]);
    }
}
