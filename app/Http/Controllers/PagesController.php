<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
    public function policy()
    {
        return view('pages.policy');
    }
     public function about()
    {
        return view('pages.about');
    }
}


