<?php

namespace App\Http\Controllers;

use App\Huisarts;
use App\HuisartsDTO;
use App\Gemeente;
use App\Straat;
use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HuisartsController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $huisartsen = Huisarts::orderBy('naam')->get();
        return view('huisarts.showall',compact('huisartsen'));
    }

// -------------------------------------------------
//  CREATE
    public function create($jongereId=null) {
// -------------------------------------------------
        $straten = Straat::all();
        $gemeenten = Gemeente::all();
        $huisartsDTO = new HuisartsDTO();
        $huisartsDTO->setJongereId($jongereId);
        return view('huisarts.create',[
            'huisartsDTO' => $huisartsDTO,
            'gemeenten' => $gemeenten ,
            'straten' => $straten
        ]);
    }

// -------------------------------------------------
//  STORE
    public function store(Requests\HuisartsRequest $request) {
// -------------------------------------------------
        $huisarts = new Huisarts();
        $huisarts->straat_id = $request->straat_id;
        $huisarts->naam = $request->naam;
        $huisarts->voornaam = $request->voornaam;
        $huisarts->url = $request->url;
        $huisarts->contactnummer = $request->contactnummer;
        $huisarts->gemeente_id = $request->gemeente_id;
        $huisarts->nummer = $request->nummer;
        $huisarts->bus = $request->bus;
        $straatnaam = $request->straat_entry;
        $jongereId = $request->jongere_id;
        if ($huisarts->straat_id == ''){
            $straat = new Straat;
            $straat->straatnaam = $straatnaam;
            $straat = Straat::create($straat->toArray());
            $huisarts->straat_id = $straat->id;
        }
        $huisarts=Huisarts::create($huisarts->toArray());
        if ($jongereId == ''){
            return redirect()->route('huisarts.index');
        }else {
            DB::table('huisarts_jongere')->insert(
                ['huisarts_id' => $huisarts->id, 'jongere_id' => $jongereId]
            );
            return redirect()->route('jongere.show', $jongereId);
        }

    }

// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $huisarts = Huisarts::find($id);
        return view('huisarts.show',['huisarts' => $huisarts]);
    }

// -------------------------------------------------
//  EDIT
    public function edit($huisartsid,$jongereId=null) {
// -------------------------------------------------
        $huisarts = Huisarts::find($huisartsid);
        $gemeente = Gemeente::find($huisarts->gemeente_id);
        $straat = Straat::find($huisarts->straat_id);

        $huisartsDTO = new HuisartsDTO();
        $huisartsDTO->setId($huisarts->id);
        $huisartsDTO->setNaam($huisarts->naam);
        $huisartsDTO->setVoornaam($huisarts->voornaam);
        $huisartsDTO->setUrl($huisarts->url);
        $huisartsDTO->setContactnummer($huisarts->contactnummer);
        $huisartsDTO->setStraatEntry($straat->straatnaam);
        $huisartsDTO->setStraatId($straat->id);
        $huisartsDTO->setJongereId($jongereId);
        $huisartsDTO->setNummer($huisarts->nummer);
        $huisartsDTO->setBus($huisarts->bus);
        $huisartsDTO->setGemeenteEntry($gemeente->postcode.' '.$gemeente->gemeente);
        $huisartsDTO->setGemeenteId($gemeente->id);

        $straten = Straat::all();
        $gemeenten = Gemeente::all();
        return view('huisarts.edit',[
            'huisartsDTO' => $huisartsDTO,
            'gemeenten' => $gemeenten ,
            'straten' => $straten
             ]);

    }

// -------------------------------------------------
//  UPDATE
    public function update(Requests\HuisartsRequest $request) {
// -------------------------------------------------
        $huisarts=Huisarts::findOrFail($request->huisarts_id);
        $huisarts->straat_id = $request->straat_id;
        $huisarts->naam = $request->naam;
        $huisarts->voornaam = $request->voornaam;
        $huisarts->url = $request->url;
        $huisarts->contactnummer = $request->contactnummer;
        $huisarts->gemeente_id = $request->gemeente_id;
        $huisarts->nummer = $request->nummer;
        $huisarts->bus = $request->bus;
        $straatnaam = $request->straat_entry;
        $jongereId = $request->jongere_id;
        if ($huisarts->straat_id == ''){
            $straat = new Straat;
            $straat->straatnaam = $straatnaam;
            $straat = Straat::create($straat->toArray());
            $huisarts->straat_id = $straat->id;
        }
        $huisarts->update();

        if($jongereId==''){
            return redirect()->route('huisarts.show',$huisarts->id);
        }else{
            return redirect()->route('jongere.show',$jongereId);
        }



    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        Huisarts::destroy($id);
        return  redirect()->route('huisarts.index');

    }
}
