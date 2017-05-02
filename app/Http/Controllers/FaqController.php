<?php

namespace App\Http\Controllers;

use App\Question;
use App\Rubric;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    function main()
    {
        return view('main', ['rubrics' => Rubric::where('id', '>', '0')->paginate(12), 'main' => true]);
    }

    function rubric($rubric)
    {
        $rubric = Rubric::where('alias', $rubric)->first();
        $questions = $rubric->getQuestions()->where(['state' => 1])->paginate(10);
        return view('rubric', [
            'data' => [
                'links' => Rubric::all(),
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
        $rubric = Rubric::where('alias', $rubric)->first();
        $questions = $rubric->getQuestions()->where(['state' => 1])->get();
        foreach ($questions as $quest) {
            $quest->alias = $rubric->alias . '/' . $quest->alias;
        }
        $question = Question::where('questions.alias', $question)->first();
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
        return view('create', ['rubrics' => Rubric::all()]);
    }

    function create($rubric)
    {
        $rubric = Rubric::where('alias', $rubric)->first();
        return view('create', [
            'activeRubricName' => $rubric->name,
            'activeRubricAlias' => $rubric->alias,
            'activeRubricId' => $rubric->id,
            'create' => true
        ]);
    }
}
