<?php

namespace App\Http\Controllers;

use App\Rubrics;
use App\Questions;
use App\User;
use Illuminate\Http\Request;

class RubricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rubrics = Rubrics::where('id', '>', 0)->paginate(10);
        foreach ($rubrics as $rubric) {
            $rubric->newQuestions = Questions::where(['state' => 0, 'rubric' => $rubric->id, 'block' => 0])->count();
            $rubric->oldQuestions = Questions::where(['state' => 1, 'rubric' => $rubric->id, 'block' => 0])->count();
            $rubric->blockQuestions = Questions::where([['rubric', '=', $rubric->id], ['block', '>', 0]])->count();
            $rubric->authorName = User::where('id', $rubric->author)->first()->name;
        }
        return view('admin.rubrics', ['rubrics' => $rubrics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd($this);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rubric = new Rubrics;
        $rubric->name = $request->name;
        $rubric->author = $request->author;
        $rubric->alias = strtr(trim($request->alias), [' ' => '', '/' => '-']);
        $oldRubric = Rubrics::orWhere(function ($query) use ($request) {
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
     * @param  var $alias
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $filter = isset($_GET['filter']) ? explode(',', $_GET['filter']) : [];
        $rubric = Rubrics::where('alias', $alias)->first();
        if (!in_array('-1', $filter) and $filter != []) {
            $questions = Questions::where([['rubric', '=', $rubric->id], ['block', '=', 0]])->whereIn('state', $filter)->orderBy('state')->orderBy('block')->paginate(5);
        } elseif (in_array('-1', $filter) and $filter != []) {
            $questions = Questions::where([['rubric', '=', $rubric->id], ['block', '>', 0]])->orderBy('state')->orderBy('block')->paginate(5);
        } else {
            $questions = Questions::where([['rubric', '=', $rubric->id]])->orderBy('state')->orderBy('block')->paginate(5);
        }
        return view('admin.rubric', ['rubric' => $rubric, 'questions' => $questions, 'filter' => $filter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  var $alias
     * @return \Illuminate\Http\Response
     */
    public function edit($alias)
    {
        $rubric = Rubrics::where('alias', $alias)->first();
        $questions = Questions::where([['rubric', '=', $rubric->id]])->orderBy('state')->orderBy('block')->paginate(5);
        return view('admin.rubric', ['rubric' => $rubric, 'edit' => true, 'questions' => $questions]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  var $alias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $alias)
    {
        $rubric = Rubrics::where('alias', $alias)->first();
        $rubric->name = $request->name;
        $rubric->alias = strtr(trim($request->alias), [' ' => '', '/' => '-']);
        $rubric->save();
        return redirect(url('admin/rubrics/' . strtr(trim($request->alias), [' ' => '', '/' => '-'])));
    }

    public function deleteQuestions($rubric)
    {
        $questions = Questions::leftJoin('rubrics', 'rubrics.id', '=', 'questions.rubric')->where('rubrics.alias', $rubric)->get();
        foreach ($questions as $question) {
            $question->delete();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Rubrics $rubric
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rubrics $rubric)
    {
        $questions = Questions::where('rubric', $rubric->id)->get();
        foreach ($questions as $question) {
            $question->delete();
        }
        $rubric->delete();
        return redirect()->back();
    }
}
