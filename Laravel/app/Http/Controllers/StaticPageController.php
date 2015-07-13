<?php namespace App\Http\Controllers;
class StaticPageController extends Controller{
    public function __construct(){
        $this->middleware('guest');
    }
    public function contact(){
        return view('staticPages.contact')->with(['voornaam' => 'Steven','achternaam' => 'Heynderickx']);
    }

    public function home(){
        return view('staticPages.welcome');
    }

   public function about(){
    $name = 'Steven the Great';
        return view('staticPages.about')->with ('name',$name);
    }
       public function people(){
    // $names = ['Steven the Great','Steven','Ayat'];
    $names = [];
        return view('staticPages.people',compact('names'));
        return view('staticPages.people',compact('names'));
    }
}
