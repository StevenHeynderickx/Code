<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Activiteit;
use App\Jongere;
use App\ActiviteitConnection;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActiviteitController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $activiteiten = Activiteit::with('countInschrijvingen')
            ->where('prijs','<=',0)
            ->whereNotIn('datum', array('2000-01-01'))
            ->orderBy('omschrijving')
            ->get();


        return view('activiteit.showall',compact('activiteiten'));
    }

// -------------------------------------------------
//  CREATE
    public function create() {
// -------------------------------------------------
        $activiteiten = DB::table('activiteiten')->orderBy('omschrijving')->get();
        return view('activiteit.create',compact('activiteiten'));
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\ActiviteitRequest $request) {
// -------------------------------------------------
        $activiteit = new Activiteit();
        $activiteit->prijs = $request->prijs<0?$request->prijs:$request->prijs*-1;
        $activiteit->omschrijving = $request->omschrijving;
        $activiteit->maaltijd = $request->maaltijd==null?0:1;
        $activiteit->datum = $request->datum;
        $activiteit  = Activiteit::create($activiteit->toArray());
        return redirect()->route('activiteit.show',$activiteit->id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $activiteit = Activiteit::find($id);
        $alleJongeren = Jongere::orderby('naam')->get();
        return view('activiteit.show',compact('activiteit','alleJongeren'));
    }

// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($id);
        $activiteiten = DB::table('activiteiten')->orderBy('omschrijving')->get();
        return view('activiteit.edit',compact('activiteit','activiteiten'));
    }

// -------------------------------------------------
//  UPDATE
    public function update($id, Requests\ActiviteitRequest $request) {
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($id);
       // dd($request->prijs<0?$request->prijs:$request->prijs*-1);
        $activiteit->prijs = $request->prijs<0?$request->prijs:$request->prijs*-1;
        $activiteit->omschrijving = $request->omschrijving;
        $activiteit->maaltijd = $request->maaltijd;
        $activiteit->datum = $request->datum;

        $activiteit->update($activiteit->toArray());
        return redirect()->route('activiteit.show',$id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($id);
        $activiteit->datum="2000-01-01";
        $activiteit->update();
        return redirect()->route('activiteit.index');
    }

// -------------------------------------------------
//  CONNECT JONGERE MET ACTIVITEIT
    public function connect(Requests\ActiviteitConnectionRequest $request){
// -------------------------------------------------
        $activiteit=Activiteit::findOrFail($request->activiteitId);
        $eetmee = $request->eetmee==null?0:1;
        $saldo = -abs($request->bedrag);
        $activiteitConnection = [
            'jongere_id' => $request->jongereId,
            'activiteit_id' => $request->activiteitId,
            'bedrag' => $saldo,
            'eetmee' => $eetmee
        ];
        ActiviteitConnection::create($activiteitConnection);
        return redirect()->route('activiteit.show',$request->activiteitId);

    }
// -------------------------------------------------
//  DISCONNECT JONGERE van ACTIVITEIT
    public function disconnect($connectionId,$activiteitId){
// -------------------------------------------------
        DB::table('activiteit_jongere')
            ->where('id',$connectionId)
            ->delete();
        return redirect()->route('activiteit.show',$activiteitId);

    }

}
