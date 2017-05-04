<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
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
            'questions' => Question::where(['state' => 1, 'block' => 0])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function newQuestions()
    {
        return view('admin.all-questions', [
            'questions' => Question::where(['state' => 0, 'block' => 0])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    public function blockQuestions()
    {
        return view('admin.all-questions', [
            'questions' => Question::where([['block', '>', 0]])->orderBy('created_at', 'desc')->paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question;
        $question->author = $request->author;
        $question->email = $request->email;
        $question->rubric = $request->rubric;
        $question->name = $request->name;
        $question->text = $request->text;
        $question->alias = strtolower(strtr(trim($request->name), $this->translit));
        $question->state = 0;
        $question->block = 0;
        $question->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('admin.question', [
            'question' => $question,
            'rubrics' => Rubric::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.edit-question', [
            'question' => $question,
            'rubrics' => Rubric::all(),
            'edit' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        if ($request->has('answer')) {
            $question->answer = $request->answer;
            $question->state = 1;
            $question->admin = Auth::user()->id;
        } else {
            $question->text = $request->text;
            $question->name = $request->name;
            $question->rubric = $request->rubric;
            $question->author = $request->author;
            $question->alias = strtolower(strtr(trim($request->name), $this->translit));
        }

        $question->save();
        return redirect()->route('show.question', $question->id);
    }

    public function block($id)
    {
        $question = Question::findOrFail($id);
        $question->block = 1;
        $question->save();
        return redirect()->back();
    }

    public function unblock($id)
    {
        $question = Question::findOrFail($id);
        $question->block = 0;
        $question->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back();
    }
}
