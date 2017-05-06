<?php

namespace App\Http\Controllers;

use App\Http\Requests\RubricRequest;
use App\Rubric;
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
            $rubric->newQuestions = $rubric->getQuestions()->newItems()->count();
            $rubric->oldQuestions = $rubric->getQuestions()->active()->count();
            $rubric->blockQuestions = $rubric->getQuestions()->block()->count();
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
        $rubric = new Rubric;
        $rubric->name = $request->name;
        $rubric->author = $request->author;
        $rubric->alias = strtr(trim($request->alias), [' ' => '', '/' => '-']);
        $rubric->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  string $alias
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show($alias, Request $request)
    {
        $filter = $request->has('filter') ? explode(',', $request->filter) : [];
        $rubric = Rubric::alias($alias);
        if (!in_array('-1', $filter) and $filter != []) {
            $questions = $rubric->getQuestions()->where('block', 0)->whereIn('state', $filter)->orderBy('state')->orderBy('block')->paginate(5);
        } elseif (in_array('-1', $filter) and $filter != []) {
            $questions = $rubric->getQuestions()->block()->orderBy('state')->orderBy('block')->paginate(5);
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
        $rubric = Rubric::alias($alias);
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
    public function update(RubricRequest $request, $alias)
    {
        $rubric = Rubric::alias($alias);
        $rubric->name = $request->name;
        $rubric->alias = strtr(trim($request->alias), [' ' => '', '/' => '-']);
        $rubric->save();
        return redirect(url('admin/rubrics/' . strtr(trim($request->alias), [' ' => '', '/' => '-'])));
    }

    public function deleteQuestions($rubric)
    {
        $questions = Rubric::alias($rubric)->getQuestions;
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
