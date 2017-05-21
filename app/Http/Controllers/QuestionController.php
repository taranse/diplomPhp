<?php

namespace App\Http\Controllers;

use App\BlockWords;
use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $questions = Question::active()->fiveItems();
        return view('admin.all-questions', [
            'questions' => $questions
        ]);
    }

    public function newQuestions()
    {
        $questions = Question::newItems()->fiveItems();
        return view('admin.all-questions', [
            'questions' => $questions
        ]);
    }

    public function blockQuestions()
    {
        $questions = Question::block()->fiveItems();
        return view('admin.all-questions', [
            'questions' => $questions
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  QuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuestionRequest $request)
    {
        $params = $request->except('_token');
        $params["alias"] = strtolower(strtr(trim($request->name), $this->translit));
        $params["state"] = 0;
        $params["block"] = 0;
        $blockWords = BlockWords::get();
        foreach ($blockWords as $word) {
            if(strpos($request->text, $word->word)) {
                $params["block"] = 2;
                break;
            }
        }
        Question::create($params);
        $rubric = Rubric::find($request->rubric);
        Log::info('Пользователь '. $request->author. ' задал вопрос в рубрике "'. $rubric->name . '" ('.$rubric->id.')' );
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
        $rubrics = Rubric::all();
        return view('admin.question', [
            'question' => $question,
            'rubrics' => $rubrics,
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
        $rubrics = Rubric::all();
        return view('admin.edit-question', [
            'question' => $question,
            'rubrics' => $rubrics,
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
            $rubric = Rubric::find($question->rubric);
            Log::info('Администратор '. Auth::user()->name. ' опубликовал вопрос "'. $question->name .'" ('.$question->id.') в рубрике "'. $rubric->name . '" ('.$rubric->id.')' );
            $question->save();
        } else {
            $question->text = $request->text;
            $question->name = $request->name;
            $question->rubric = $request->rubric;
            $question->author = $request->author;
            $question->alias = strtolower(strtr(trim($request->name), $this->translit));
            $rubric = Rubric::find($question->rubric);
            $question->save();
            Log::info('Администратор '. Auth::user()->name. ' изменил вопрос "'. $question->name .'" ('.$question->id.') в рубрике "'. $rubric->name . '" ('.$rubric->id.')' );

        }

        return redirect()->route('show.question', $question->id);
    }

    public function block($id)
    {
        $question = Question::findOrFail($id);
        $question->block = 1;
        $rubric = Rubric::find($question->rubric);
        Log::info('Администратор '. Auth::user()->name. ' заблокировал вопрос "'. $question->name .'" ('.$question->id.') в рубрике "'. $rubric->name . '" ('.$rubric->id.')' );
        $question->save();
        return redirect()->back();
    }

    public function unblock($id)
    {
        $question = Question::findOrFail($id);
        $question->block = 0;
        $rubric = Rubric::find($question->rubric);
        Log::info('Администратор '. Auth::user()->name. ' разблокировал вопрос "'. $question->name .'" ('.$question->id.') в рубрике "'. $rubric->name . '" ('.$rubric->id.')' );
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
        $rubric = Rubric::find($question->rubric);
        Log::info('Администратор '. Auth::user()->name. ' удалил вопрос "'. $question->name .'" ('.$question->id.') в рубрике "'. $rubric->name . '" ('.$rubric->id.')' );
        $question->delete();
        return redirect()->back();
    }
}
