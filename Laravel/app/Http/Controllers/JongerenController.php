<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jongere;

class JongerenController extends Controller
{
    
    public function index() {
          
        $jongeren = Jongere::all();
        return view('jongere.showall',compact('jongeren'));
    }

    public function show($id) {

        $jongere = Jongere::find($id);
        return view('jongere.show_jongere_info',compact('jongere'));

    }

    public function read($id) {

        $jongere = Jongere::find($id);
        return view('jongere.show_jongere_info',compact('jongere'));

    }

    public function create() {
        
        return view('jongere.create_jongere');
    }

    public function store() {
       
    }
     
    public function edit($id) {
        
    }

    public function update($id) {
        
    }

    public function destroy($id) {
    
    }
}
