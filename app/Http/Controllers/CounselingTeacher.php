<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CounselingTeacher extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('counselor.home');
    }
}
