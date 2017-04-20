<?php

namespace App\Http\Controllers;

use App\Rubrics;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    function main()
    {
        return view('main', ['rubrics' => Rubrics::all(), 'main' => true]);
    }

    function rubric($rubric)
    {
        return view('faq', ['rubrics' => Rubrics::all(), 'active' => Rubrics::routeInRubrics($rubric)]);
    }
}
