<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\NationaliteitRequest;
use App\Http\Controllers\Controller;
use App\Nationaliteit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class NationaliteitController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $nationaliteiten = DB::table('nationaliteiten')->orderBy('omschrijving')->get();
        return view('genericSelectClass.showall',[
                'className_String'=>'nationaliteit',
                'classNames_String'=>'nationaliteiten',
                'classNames'=>$nationaliteiten,
                'attribute'=>'omschrijving'
            ]
        );

    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $nationaliteiten = DB::table('nationaliteiten')->orderBy('omschrijving')->get();
        return view('genericSelectClass.create',[
            'ClassName_String'=>'Nationaliteit',
            'className_String'=>'nationaliteit',
            'classNames'=>$nationaliteiten,
            'label'=>'Geef de naam van de nationaliteit',
            'attribute'=>'omschrijving'
        ]);
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\NationaliteitRequest $request) {
// -------------------------------------------------
        $nationaliteit  = Nationaliteit::create($request->all());
        return redirect()->route('nationaliteit.show',$nationaliteit->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $nationaliteit = Nationaliteit::find($id);
        return view('genericSelectClass.show',[
            'className_String'=>'nationaliteit',
            'nationaliteit'=>$nationaliteit,
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $nationaliteit=Nationaliteit::findOrFail($id);
        $nationaliteiten = DB::table('nationaliteiten')->orderBy('omschrijving')->get();
        return view('genericSelectClass.edit',[
            'ClassName_String'=>'Nationaliteit',
            'className_String'=>'nationaliteit',
            'nationaliteit'=>$nationaliteit,
            'classNames'=>$nationaliteiten,
            'label'=>'Geef de naam van de nationaliteit',
            'attribute'=>'omschrijving'
        ]);

    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\NationaliteitRequest $request) {
// -------------------------------------------------
        $nationaliteit=Nationaliteit::findOrFail($id);
        $nationaliteit->update($request->all());
        return redirect()->route('nationaliteit.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Nationaliteit::destroy($id);
        return redirect()->route('nationaliteit.index');
    }
}

