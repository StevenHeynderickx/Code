<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Straat;
use DB;

class StraatController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $straten = DB::table('straten')->orderBy('straatnaam')->get();
        return view('genericSelectClass.showall',[
                'className_String'=>'straat',
                'classNames_String'=>'straten',
                'classNames'=>$straten,
                'attribute'=>'straatnaam'
            ]
        );
    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $straten = DB::table('straten')->orderBy('straatnaam')->get();
        //$straten = Straat::all();
        return view('genericSelectClass.create',[
            'ClassName_String'=>'Straat',
            'className_String'=>'straat',
            'classNames'=>$straten,
            'label'=>'Geef de straatnaam',
            'attribute'=>'straatnaam'
        ]);
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\StraatRequest $request) {
// -------------------------------------------------
        $straat = Straat::create($request->all());
        return redirect()->route('straat.show',$straat->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $straat = Straat::find($id);
        return view('genericSelectClass.show',[
            'className_String'=>'straat',
            'straat'=>$straat,
            'attribute'=>'straatnaam'
        ]);
    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $straat=Straat::findOrFail($id);
        $straten = DB::table('straten')->orderBy('straatnaam')->get();
        return view('genericSelectClass.edit',[
            'ClassName_String'=>'Straat',
            'className_String'=>'straat',
            'straat'=>$straat,
            'classNames'=>$straten,
            'label'=>'Geef de straatnaam',
            'attribute'=>'straatnaam'
        ]);
    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\StraatRequest $request) {
// -------------------------------------------------
        $straat=Straat::findOrFail($id);
        $straat->update($request->all());
        return redirect()->route('straat.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Straat::destroy($id);
        return redirect()->route('straat.index');
    }
}
