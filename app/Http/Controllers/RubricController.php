<?php

namespace App\Http\Controllers;

use App\Http\Requests\RubricRequest;
use App\Rubric;
use App\Question;
use App\User;
use Illuminate\Http\Request;

class RubricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubrics = Rubric::where('id', '>', 0)->paginate(10);
        foreach ($rubrics as $rubric) {
            $rubric->newQuestions = $rubric->getQuestions()->where(['state' => 0, 'block' => 0])->count();
            $rubric->oldQuestions = $rubric->getQuestions()->where(['state' => 1, 'rubric' => $rubric->id, 'block' => 0])->count();
            $rubric->blockQuestions = $rubric->getQuestions()->where([['block', '>', 0]])->count();
            $rubric->authorName = $rubric->getAuthor->name;
        }
        return view('admin.rubrics', ['rubrics' => $rubrics]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RubricRequest $request)
    {
        dd($request);
        $rubric = new Rubric;
        $rubric->name = $request->name;
        $rubric->author = $request->author;
        $rubric->alias = strtr(trim($request->alias), [' ' => '', '/' => '-']);
        $oldRubric = Rubric::orWhere(function ($query) use ($request) {
            $query->where('name', '=', $request->name)->where('alias', '=', strtr(trim($request->alias), [' ' => '', '/' => '-']));
        })->first();
        if ($oldRubric) {
            return redirect()->back()->withErrors(['name' => 'Рубрика с данным именем уже существует']);
        }
        $rubric->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $filter = isset($_GET['filter']) ? explode(',', $_GET['filter']) : [];
        $rubric = Rubric::where('alias', $alias)->first();
        if (!in_array('-1', $filter) and $filter != []) {
            $questions = $rubric->getQuestions()->where([['block', '=', 0]])->whereIn('state', $filter)->orderBy('state')->orderBy('block')->paginate(5);
        } elseif (in_array('-1', $filter) and $filter != []) {
            $questions = $rubric->getQuestions()->where([['block', '>', 0]])->orderBy('state')->orderBy('block')->paginate(5);
        } else {
            $questions = $rubric->getQuestions()->orderBy('state')->orderBy('block')->paginate(5);
        }
        return view('admin.rubric', ['rubric' => $rubric, 'questions' => $questions, 'filter' => $filter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function edit($alias)
    {
        $rubric = Rubric::where('alias', $alias)->first();
        $questions = $rubric->getQuestions()->orderBy('state')->orderBy('block')->paginate(5);
        return view('admin.rubric', ['rubric' => $rubric, 'edit' => true, 'questions' => $questions]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $alias)
    {
        $rubric = Rubric::where('alias', $alias)->first();
        $rubric->name = $request->name;
        $rubric->alias = strtr(trim($request->alias), [' ' => '', '/' => '-']);
        $rubric->save();
        return redirect(url('admin/rubrics/' . strtr(trim($request->alias), [' ' => '', '/' => '-'])));
    }

    public function deleteQuestions($rubric)
    {
        $questions = Rubric::where('alias', $rubric)->first()->getQuestions;
        foreach ($questions as $question) {
            $question->delete();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rubric $rubric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubric $rubric)
    {
        $questions = $rubric->getQuestions;
        foreach ($questions as $question) {
            $question->delete();
        }
        $rubric->delete();
        return redirect()->back();
    }
}
