<?php

namespace App\Http\Controllers;

use App\User;
use App\Rubrics;
use App\Questions;
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
        return view('admin.moderators', ['admins' => User::all()]);
    }
}
