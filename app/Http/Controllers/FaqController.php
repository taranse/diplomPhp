<?php

namespace App\Http\Controllers;

use App\Questions;
use App\Rubrics;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    function main()
    {
        return view('main', ['rubrics' => Rubrics::where('id', '>', '0')->paginate(12), 'main' => true]);
    }

    function rubric($rubric)
    {
        $rubric = Rubrics::where('alias', $rubric)->first();
        $questions = $rubric->getQuestions()->where(['state' => 1])->paginate(10);
        return view('rubric', [
            'data' => [
                'links' => Rubrics::all(),
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
        $rubric = Rubrics::where('alias', $rubric)->first();
        $questions = $rubric->getQuestions()->where(['state' => 1])->get();
        foreach ($questions as $quest) {
            $quest->alias = $rubric->alias . '/' . $quest->alias;
        }
        $question = Questions::where('questions.alias', $question)->first();
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
        return view('create', ['rubrics' => Rubrics::all()]);
    }

    function create($rubric)
    {
        $rubric = Rubrics::where('alias', $rubric)->first();
        return view('create', [
            'activeRubricName' => $rubric->name,
            'activeRubricAlias' => $rubric->alias,
            'activeRubricId' => $rubric->id,
            'create' => true
        ]);
    }
}
