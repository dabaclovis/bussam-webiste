<?php 

namespace App\Http\Controllers;

classs PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
}