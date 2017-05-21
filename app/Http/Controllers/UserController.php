<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->password = bcrypt($request->password);
        $user->save();
        Log::info('Администратор ' . Auth::user()->name . ' изменил пароль администратора ' . $user->name . ' на ' . $request->password);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Log::info('Администратор ' . Auth::user()->name . ' удалил администратора ' . $user->name);
        return redirect()->back();
    }
}
