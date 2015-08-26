<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Groep;
use DB;

class GroepController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $groepen = DB::table('groepen')->orderBy('omschrijving')->get();
        return view('genericSelectClass.showall',[
                'className_String'=>'groep',
                'classNames_String'=>'groepen',
                'classNames'=>$groepen,
                'attribute'=>'omschrijving'
            ]
        );

    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $groepen = DB::table('groepen')->orderBy('omschrijving')->get();
        return view('genericSelectClass.create',[
            'ClassName_String'=>'Groep',
            'className_String'=>'groep',
            'classNames'=>$groepen,
            'label'=>'Geef de naam van de groep',
            'attribute'=>'omschrijving'
        ]);
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\GroepRequest $request) {
// -------------------------------------------------
        $groep  = Groep::create($request->all());
        return redirect()->route('groep.show',$groep->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $groep = Groep::find($id);
        return view('genericSelectClass.show',[
            'className_String'=>'groep',
            'groep'=>$groep,
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $groep=Groep::findOrFail($id);
        $groepen = DB::table('groepen')->orderBy('omschrijving')->get();
        return view('genericSelectClass.edit',[
            'ClassName_String'=>'Groep',
            'className_String'=>'groep',
            'groep'=>$groep,
            'classNames'=>$groepen,
            'label'=>'Geef de naam van de groep',
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\GroepRequest $request) {
// -------------------------------------------------
        $groep=Groep::findOrFail($id);
        $groep->update($request->all());
        return redirect()->route('groep.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Groep::destroy($id);
        return redirect()->route('groep.index');
    }
}
