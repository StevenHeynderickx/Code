<?php

namespace App\Http\Controllers;

use App\Jongere;

class StaticPageController extends Controller{
    public function __construct(){
        $this->middleware('guest');
    }

    public function contact(){
        return view('staticPages.contact')->with(['voornaam' => 'Steven','achternaam' => 'Heynderickx']);
    }

    public function home(){
        $jongeren = Jongere::all();
        return view('staticPages.welcome',compact('jongeren'));
    }

    public function about(){
        $name = 'Steven the Great';
        return view('staticPages.about')->with ('name',$name);
    }
    public function people(){
        $names = [];
        return view('staticPages.people',compact('names'));
    }
}
