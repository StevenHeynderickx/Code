<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Gemeente;

class GemeenteController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $gemeenten = DB::table('gemeenten')->orderBy('postcode')->get();
        return view('gemeente.showall',compact('gemeenten'));
    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $gemeenten = DB::table('gemeenten')->orderBy('postcode')->get();
        return view('gemeente.create',compact('gemeenten'));
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\GemeenteRequest $request) {
// -------------------------------------------------
        $gemeente  = Gemeente::create($request->all());
        return redirect()->route('gemeente.show',$gemeente->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $gemeente = Gemeente::find($id);
        return view('gemeente.show',compact('gemeente'));
    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $gemeente=Gemeente::findOrFail($id);
        $gemeenten = DB::table('gemeenten')->orderBy('postcode')->get();
        return view('gemeente.edit',compact('gemeente','gemeenten'));
    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\GemeenteRequest $request) {
// -------------------------------------------------
        $gemeente=Gemeente::findOrFail($id);
        $gemeente->update($request->all());
        return redirect()->route('gemeente.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Gemeente::destroy($id);
        return redirect()->route('gemeente.index');
    }
}
