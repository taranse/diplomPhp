<?php

namespace App\Http\Controllers;

use App\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public $translit = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'j', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'x', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shh',
        'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'YO', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'J', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'X', 'Ц' => 'C',
        'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SHH',
        'Ь' => '', 'Ы' => 'I', 'Ъ' => '',
        'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        ' ' => '-', '/' => '-'
    ];


    public function index()
    {
        return view('admin.all-questions', [
            'questions' => Questions::where(['state' => 1, 'block' => 0])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function newQuestions()
    {
        return view('admin.all-questions', [
            'questions' => Questions::where(['state' => 0, 'block' => 0])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function blockQuestions()
    {
        return view('admin.all-questions', [
            'questions' => Questions::where([['block', '>', 0]])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $question = new Questions;
        $question->author = $request->author;
        $question->email = $request->email;
        $question->rubric = $request->rubric;
        $question->name = $request->name;
        if (empty($request->text)) {
            return redirect()->back()->withErrors(['text' => 'Вопрос не может быть пустым']);
        }
        $question->text = $request->text;
        $question->alias = strtolower(strtr(trim($request->name), $this->translit));
        if (Questions::where('alias', $question->alias)->first()) {
            return redirect()->back()->withErrors(['name' => 'Вопрос с таким именем уже существует']);
        }
        $question->state = 0;
        $question->block = 0;
        $question->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questions $questions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Questions::where('questions.id', $id)
            ->join('rubrics', 'questions.rubric', '=', 'rubrics.id')
            ->select('questions.*', 'rubrics.id as rubric_id', 'rubrics.name as rubric_name')
            ->first();
        return view('admin.question', [
            'question' => $question,
            'rubrics' => Rubrics::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questions $questions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Questions::where('questions.id', $id)
            ->join('rubrics', 'questions.rubric', '=', 'rubrics.id')
            ->select('questions.*', 'rubrics.id as rubric_id', 'rubrics.name as rubric_name')
            ->first();
        return view('admin.edit-question', [
            'question' => $question,
            'rubrics' => Rubrics::all(),
            'edit' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Questions $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        $question = $questions;
        $rubric = Rubrics::find($request->rubric);

        if (isset($request->answer)) {
            $question->answer = $request->answer;
            $question->state = 1;
            $question->admin = Auth::user()->id;
        } else {
            $question->text = $request->text;
            $question->name = $request->name;
            $question->rubric = $rubric->id;
            $question->author = $request->author;
            $question->alias = strtolower(strtr(trim($request->name), $this->translit));
        }

        $question->save();
        return redirect()->route('show.question', $question->id);
    }

    public function block($id)
    {
        $question = Questions::find($id);
        $question->block = 1;
        $question->save();
        return redirect()->back();
    }

    public function unblock($id)
    {
        $question = Questions::find($id);
        $question->block = 0;
        $question->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questions $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {
        dd($questions);
//        $question = Questions::find($id);
        $questions->delete();
        return redirect()->back();
    }
}
