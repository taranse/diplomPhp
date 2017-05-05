<?php

namespace App\Http\Controllers;

use App\User;
use App\Rubric;
use App\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.index');
    }

    public function moderators()
    {
        $admins = User::all();
        return view('admin.moderators', ['admins' => $admins]);
    }
}
