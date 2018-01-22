<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application main page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
