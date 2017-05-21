<?php

namespace App\Http\Controllers;

use App\BlockWords;
use App\Http\Requests\BlockWordsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BlockWordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blockWords = BlockWords::where('id', '>', 0)->paginate(15);
        return view('admin.block-list', [
            'blockWords' => $blockWords
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlockWordsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockWordsRequest $request)
    {
        $params = $request->except('_token');
        $blockWord = BlockWords::create($params);
        Log::info('Администратор '. Auth::user()->name. ' добавил блок-слово "'. $blockWord->word . '" ('.$blockWord->id.')' );
        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $blockWord
     * @return \Illuminate\Http\Response
     */
    public function destroy($blockWord)
    {
        $blockWords = BlockWords::findOrFail($blockWord);
        $blockWords->delete();
        Log::info('Администратор ' . Auth::user()->name . ' удалил блок-слово "' . $blockWords->name . '" ('.$blockWords->id.')' );
        return redirect()->back();
    }
}
