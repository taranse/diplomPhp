<?php

namespace App\Http\Controllers;

use App\Question;
use App\Rubric;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    function main()
    {
        $rubrics = Rubric::where('id', '>', '0')->paginate(12);
        return view('main', ['rubrics' => $rubrics, 'main' => true]);
    }

    function rubric($rubric)
    {
        $rubric = Rubric::alias($rubric);
        $rubrics = Rubric::all();
        $questions = $rubric->activeQuestions()->paginate(10);
        return view('rubric', [
            'data' => [
                'links' => $rubrics,
                'activeName' => $rubric->name,
                'activeAlias' => $rubric->alias,
                'header' => 'Выбранная рубрика'
            ],
            'breadcrumbs' => [
                $rubric->name => $rubric->alias
            ],
            'questions' => $questions
        ]);
    }

    function question($rubric, $question)
    {
        $rubric = Rubric::alias($rubric);
        $questions = $rubric->activeQuestions()->get();
        $questions->map(function ($quest) use ($rubric) {
            $quest->alias = $rubric->alias . '/' . $quest->alias;
        });
        $question = Question::where('questions.alias', $question)->firstOrFail();
        return view('question', [
            'data' => [
                'links' => $questions,
                'header' => 'Выбранный вопрос',
                'activeName' => $question->name,
                'activeAlias' => $rubric->alias . '/' . $question->alias
            ],
            'breadcrumbs' => [
                $rubric->name => $rubric->alias,
                $question->name => $rubric->alias . '/' . $question->alias
            ],
            'question' => $question
        ]);
    }

    function getRubricForCreate()
    {
        $rubrics = Rubric::all();
        return view('create', ['rubrics' => $rubrics]);
    }

    function create($rubric)
    {
        $rubric = Rubric::alias($rubric);
        return view('create', [
            'activeRubricName' => $rubric->name,
            'activeRubricAlias' => $rubric->alias,
            'activeRubricId' => $rubric->id,
            'create' => true
        ]);
    }
}
