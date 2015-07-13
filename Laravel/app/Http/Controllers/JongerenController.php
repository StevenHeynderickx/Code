<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Requests\CreateJongereRequest;
use App\Http\Controllers\Controller;
use App\Jongere;
use Carbon\Carbon;

class JongerenController extends Controller
{

    public function index() {

        $jongeren = Jongere::latest('geboortedatum')->meerderjarig()->get();
        return view('jongere.showall',compact('jongeren'));
    }

    public function show($id) {

        $jongere = Jongere::find($id);
        dd($jongere->geboortedatum->year);
        return view('jongere.show_jongere_info',compact('jongere'));

    }

    public function read($id) {

        $jongere = Jongere::find($id);
        return view('jongere.show_jongere_info',compact('jongere'));

    }

    public function create() {

        return view('jongere.create_jongere');
    }

    public function store(Requests\CreateJongereRequest $request) {

        Jongere::create($request->all());
        return redirect(route('showJongeren'));
    }

    public function edit($id) {

    }

    public function update($id) {

    }

    public function destroy($id) {

    }
}
