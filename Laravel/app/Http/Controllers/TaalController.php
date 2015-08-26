<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Taal;
use DB;

class TaalController extends Controller

{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $talen = DB::table('talen')->orderBy('omschrijving')->get();
        return view('genericSelectClass.showall',[
                'className_String'=>'taal',
                'classNames_String'=>'talen',
                'classNames'=>$talen,
                'attribute'=>'omschrijving'
            ]
        );

    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $talen = DB::table('talen')->orderBy('omschrijving')->get();
        return view('genericSelectClass.create',[
            'ClassName_String'=>'Taal',
            'className_String'=>'taal',
            'classNames'=>$talen,
            'label'=>'Geef de naam van de taal',
            'attribute'=>'omschrijving'
        ]);
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\TaalRequest $request) {
// -------------------------------------------------
        $taal  = Taal::create($request->all());
        return redirect()->route('taal.show',$taal->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $taal = Taal::find($id);
        return view('genericSelectClass.show',[
            'className_String'=>'taal',
            'taal'=>$taal,
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $taal=Taal::findOrFail($id);
        $talen = DB::table('talen')->orderBy('omschrijving')->get();
        return view('genericSelectClass.edit',[
            'ClassName_String'=>'Taal',
            'className_String'=>'taal',
            'taal'=>$taal,
            'classNames'=>$talen,
            'label'=>'Geef de naam van de taal',
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\TaalRequest $request) {
// -------------------------------------------------
        $taal=Taal::findOrFail($id);
        $taal->update($request->all());
        return redirect()->route('taal.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Taal::destroy($id);
        return redirect()->route('taal.index');
    }
}