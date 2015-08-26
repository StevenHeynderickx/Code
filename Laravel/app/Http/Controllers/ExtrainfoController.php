<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Extrainfo;
use DB;

class ExtrainfoController extends Controller

{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $extrainfos = DB::table('extrainfos')->orderBy('omschrijving')->get();
        return view('extrainfo.showall',compact('extrainfos'));
    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $extrainfos = DB::table('extrainfos')->orderBy('omschrijving')->get();
        return view('extrainfo.create',compact('extrainfos'));
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\ExtrainfoRequest $request) {
// -------------------------------------------------
        $extrainfo  = Extrainfo::create($request->all());
        return redirect()->route('extrainfo.show',$extrainfo->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $extrainfo = Extrainfo::find($id);
        return view('extrainfo.show',compact('extrainfo'));
    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $extrainfo=Extrainfo::findOrFail($id);
        $extrainfos = DB::table('extrainfos')->orderBy('omschrijving')->get();
        return view('extrainfo.edit',compact('extrainfo','extrainfos'));
    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\ExtrainfoRequest $request) {
// -------------------------------------------------
        $extrainfo=Extrainfo::findOrFail($id);

        $search_array = $request->all();
        if (!array_key_exists('priority', $search_array)) {
            $extrainfo->priority="0";
        } else {
            $extrainfo->priority="1";
        }
        $extrainfo->omschrijving=$request->omschrijving;
        $extrainfo->update();

        return redirect()->route('extrainfo.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Extrainfo::destroy($id);
        return redirect()->route('extrainfo.showall');
    }
}
