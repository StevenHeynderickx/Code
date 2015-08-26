<?php

namespace App\Http\Controllers;

use App\Nationaliteit;
use App\OuderConnection;
use App\Relatie;
use App\Jongere ;
use Illuminate\Http\Request;
use App\OuderDTO;
use App\Ouder;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OuderController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $ouders = Ouder::orderBy('naam')->get();
        return view('ouder.showall',compact('ouders'));
    }

// -------------------------------------------------
//  CREATE
    public function create($jongereId) {
// -------------------------------------------------
        $nationaliteiten = Nationaliteit::all();
        $relaties = Relatie::all();
        $ouders = DB::table('ouders')->orderBy('naam')->get();
        $jongere = Jongere::findOrFail($jongereId);
        $ouderDTO = new OuderDTO;
        $ouderDTO->setJongereId($jongereId);
        $ouderDTO->setJongereEntry($jongere->naam." ".$jongere->voornaam);
        return view('ouder.create',[
            'ouderDTO' => $ouderDTO,
            'ouders' => $ouders ,
            'nationaliteiten' => $nationaliteiten,
            'relaties' => $relaties
        ]);

    }

// -------------------------------------------------
//  STORE
    public function store(Requests\OuderRequest $request) {
// -------------------------------------------------
        $ouderConnection = new OuderConnection();
        if ($request->ouder_id==''){
            $ouder = new Ouder();
            $ouder->naam = $request->naam;
            $ouder->voornaam = $request->voornaam;
            $ouder->origine_id = $request->origine_id;
            $ouder = Ouder::create($ouder->toArray());
            $ouderConnection->ouder_id = $ouder->id;
        } else {
            $ouderConnection->ouder_id = $request->ouder_id;
        }
        $ouderConnection->jongere_id = $request->jongere_id;
        $ouderConnection->relatie_id = $request->relatie_id;

        OuderConnection::create($ouderConnection->toArray());

        return redirect()->route('jongere.show',$request->jongere_id);
    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $ouder = Ouder::findOrFail($id);
        //$alleJongeren = Jongere::orderby('naam')->get();
        return view('ouder.show',compact('ouder'));
    }

// -------------------------------------------------
//  EDIT
    public function edit($ouderId) {
// -------------------------------------------------
        $ouder = Ouder::findOrFail($ouderId);
        $nationaliteiten = Nationaliteit::all();
        $ouders = DB::table('ouders')->orderBy('naam')->get();


        return view('ouder.edit',[
            'ouder' => $ouder,
            'ouders' => $ouders ,
            'nationaliteiten' => $nationaliteiten
        ]);
    }

// -------------------------------------------------
//  UPDATE
    public function update(Requests\OuderRequest $request) {
// -------------------------------------------------
        $ouder = Ouder::findOrFail($request->ouder_id);
        $ouder->update($request->all());
        return redirect()->route('ouder.show',$request->ouder_id);
    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Ouder::destroy($id);
        return  redirect()->route('ouder.index');
    }
// -------------------------------------------------
//  CONNECT OUDER MET JONGERE
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
//  DISCONNECT OUDER VAN JONGERE
    public function disconnect($ouderId,$jongereId){
// -------------------------------------------------
        DB::table('jongere_ouder')
            ->where('jongere_id',$jongereId)
            ->where('ouder_id',$ouderId)
            ->delete();
        return redirect()->route('ouder.show',$ouderId);

    }
}

