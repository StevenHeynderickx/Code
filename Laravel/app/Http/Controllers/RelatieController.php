<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Relatie;
use DB;

class RelatieController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $relaties = DB::table('relaties')->orderBy('omschrijving')->get();
        return view('genericSelectClass.showall',[
                'className_String'=>'relatie',
                'classNames_String'=>'relaties',
                'classNames'=>$relaties,
                'attribute'=>'omschrijving'
            ]
        );

    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $relaties = DB::table('relaties')->orderBy('omschrijving')->get();
        return view('genericSelectClass.create',[
            'ClassName_String'=>'Relatie',
            'className_String'=>'relatie',
            'classNames'=>$relaties,
            'label'=>'Geef de naam van de relatie',
            'attribute'=>'omschrijving'
        ]);
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\RelatieRequest $request) {
// -------------------------------------------------
        $relatie  = Relatie::create($request->all());
        return redirect()->route('relatie.show',$relatie->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $relatie = Relatie::find($id);
        return view('genericSelectClass.show',[
            'className_String'=>'relatie',
            'relatie'=>$relatie,
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $relatie=Relatie::findOrFail($id);
        $relaties = DB::table('relaties')->orderBy('omschrijving')->get();
        return view('genericSelectClass.edit',[
            'ClassName_String'=>'Relatie',
            'className_String'=>'relatie',
            'relatie'=>$relatie,
            'classNames'=>$relaties,
            'label'=>'Geef de naam van de relatie',
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\RelatieRequest $request) {
// -------------------------------------------------
        $relatie=Relatie::findOrFail($id);
        $relatie->update($request->all());
        return redirect()->route('relatie.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Relatie::destroy($id);
        return redirect()->route('relatie.index');
    }
}