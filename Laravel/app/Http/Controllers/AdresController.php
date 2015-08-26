<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Adres;
use App\Straat;
use App\Gemeente;
use App\Jongere;
use DB;
use App\AdresDTO;

class AdresController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $adressen=Adres::all();
        //dd($adressen);
        return view('adres.showall',compact('adressen'));
    }


// -------------------------------------------------
//  CREATE
    public function create($jongereId){
// -------------------------------------------------

        $jongere = Jongere::find($jongereId);
        $straten = Straat::all();
        $gemeenten = Gemeente::all();
        $adresDTO = new AdresDTO;
        return view('adres.create',[
            'adresDTO' => $adresDTO,
            'gemeenten' => $gemeenten ,
            'straten' => $straten ,
            'jongere' => $jongere ]);
    }


// -------------------------------------------------
//  STORE
    public function store(Requests\AdresRequest $request) {
// -------------------------------------------------
        $adres = new Adres();
        $adres->straat_id = $request->straat_id;
        $adres->omschrijving = $request->omschrijving;
        if($request->officieel==null){$adres->officieel = 0;
        } else {$adres->officieel = $request->officieel;}
        $adres->gemeente_id = $request->gemeente_id;
        $adres->nummer = $request->nummer;
        $adres->bus = $request->bus;
        $straatnaam = $request->straat_entry;
        $jongereId = $request->jongere_id;
        //dd($adres->straat_id);
        if ($adres->straat_id == ''){
            $straat = new Straat;
            $straat->straatnaam = $straatnaam;
            $straat = Straat::create($straat->toArray());
            $adres->straat_id = $straat->id;
        }
        $adres=Adres::create($adres->toArray());
        DB::table('adres_jongere')->insert(
            ['adres_id' => $adres->id, 'jongere_id' => $jongereId]
        );
        return redirect()->route('jongere.show',$jongereId);
    }


// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------

    }

// -------------------------------------------------
//  EDIT
    public function edit($adresId,$jongereId){
// -------------------------------------------------
        $adres = Adres::find($adresId);
        $jongere = Jongere::find($jongereId);
        $gemeente = Gemeente::find($adres->gemeente_id);
        $straat = Straat::find($adres->straat_id);

        $adresDTO = new AdresDTO;
        $adresDTO->setId($adres->id);
        $adresDTO->setOmschrijving($adres->omschrijving);
        $adresDTO->setOfficieel($adres->officieel);
        $adresDTO->setStraatEntry($straat->straatnaam);
        $adresDTO->setStraatId($straat->id);
        $adresDTO->setJongereId($jongereId);
        $adresDTO->setNummer($adres->nummer);
        $adresDTO->setBus($adres->bus);
        $adresDTO->setGemeenteEntry($gemeente->postcode.' '.$gemeente->gemeente);
        $adresDTO->setGemeenteId($gemeente->id);
        $adresDTOArray = $adresDTO->toArray();

        //dd($adresDTO);

        $straten = Straat::all();
        $gemeenten = Gemeente::all();
        return view('adres.edit',[
            'adresDTO' => $adresDTO,
            'gemeenten' => $gemeenten ,
            'straten' => $straten ,
            'jongere' => $jongere ]);

    }


// -------------------------------------------------
//  UPDATE
    public function update(Requests\AdresRequest $request) {
// -------------------------------------------------
        $adres=Adres::findOrFail($request->adres_id);
        $adres->straat_id = $request->straat_id;
        $adres->omschrijving = $request->omschrijving;
        $adres->officieel = $request->officieel==null?0:1;
        $adres->gemeente_id = $request->gemeente_id;
        $adres->nummer = $request->nummer;
        $adres->bus = $request->bus;
        $straatnaam = $request->straat_entry;
        $jongereId = $request->jongere_id;
        if ($adres->straat_id == ''){
            $straat = new Straat;
            $straat->straatnaam = $straatnaam;
            $straat = Straat::create($straat->toArray());
            $adres->straat_id = $straat->id;
        }
        $adres->update();

        return redirect()->route('jongere.show',$jongereId);
    }


// -------------------------------------------------
//  DESTROY
    public function destroy($adresId,$jongereId) {
// -------------------------------------------------
        Adres::destroy($adresId);
        return  redirect()->route('jongere.show',$jongereId);
    }
}

