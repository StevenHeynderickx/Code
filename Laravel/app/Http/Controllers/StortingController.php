<?php

namespace App\Http\Controllers;

use App\Jongere;
use Illuminate\Http\Request;
use DB;
use App\Activiteit;
use App\ActiviteitConnection;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StortingController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $activiteiten = Activiteit::with('countStortingen')
            ->where('prijs','>',0)
            ->whereNotIn('datum', array('2000-01-01'))
            ->orderBy('omschrijving')
            ->get();



        return view('storting.showall',compact('activiteiten'));
    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $activiteiten = DB::table('activiteiten')->orderBy('omschrijving')->get();
        return view('storting.create',compact('activiteiten'));
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\StortingRequest $request) {
// -------------------------------------------------
        $activiteit = new Activiteit();
        $activiteit->omschrijving = $request->omschrijving;
        $activiteit->prijs = 1;
        $activiteit->datum = $request->datum;
        $activiteit = Activiteit::create($activiteit->toArray());
        return redirect()->route('storting.show',$activiteit->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $activiteit = Activiteit::find($id);
        $alleJongeren = Jongere::orderby('naam')->get();
        return view('storting.show',compact('activiteit','alleJongeren'));
    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($id);
        $activiteiten = DB::table('activiteiten')->orderBy('omschrijving')->get();
        return view('storting.edit',compact('activiteit','activiteiten'));
    }

// -------------------------------------------------
//  UPDATE
    public function update($id,Requests\StortingRequest $request) {
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($id);
        $activiteit->update($request->all());
        return redirect()->route('storting.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($id);
        $activiteit->datum="2000-01-01";
        $activiteit->update();
        return redirect()->route('storting.index');
    }
// -------------------------------------------------
//  CONNECT JONGERE MET STORTING
    public function connect(Requests\ActiviteitConnectionRequest $request){
// -------------------------------------------------
        $activiteitConnection = [
            'jongere_id' => $request->jongereId,
            'activiteit_id' => $request->activiteitId,
            'bedrag' => $request->bedrag,
            'eetmee' => 0
        ];
        ActiviteitConnection::create($activiteitConnection);
        return redirect()->route('storting.show',$request->activiteitId);

    }
// -------------------------------------------------
//  DISCONNECT JONGERE van STORTING
    public function disconnect($connectionId,$activiteitId){
// -------------------------------------------------
        DB::table('activiteit_jongere')
            ->where('id',$connectionId)
            ->delete();
        return redirect()->route('storting.show',$activiteitId);

    }

}
