<?php

namespace App\Http\Controllers;

use App\User;
use App\Rubrics;
use App\Questions;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.index');
    }

    public function moderators()
    {
        return view('admin.moderators', ['admins' => User::all()]);
    }

    public function rubrics()
    {
        $rubrics = Rubrics::where('id', '>', 0)->paginate(10);
        foreach ($rubrics as $rubric) {
            $rubric->newQuestions = Questions::where(['state' => 0, 'rubric' => $rubric->id])->count();
            $rubric->oldQuestions = Questions::where(['state' => 1, 'rubric' => $rubric->id])->count();
            $rubric->blockQuestions = Questions::where(['state' => 2, 'rubric' => $rubric->id])->count();
            $rubric->authorName = User::where('id', $rubric->author)->first()->name;
        }
        return view('admin.rubrics', ['rubrics' => $rubrics]);
    }
}
