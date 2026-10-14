<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $intro = 'This website is built for students!';
        return view('about', compact('intro'));
    }
}
