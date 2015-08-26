<?php

namespace App\Http\Controllers;


use App\Groep;
use App\Jongere;
use App\Nationaliteit;
use App\Ouder;
use App\Taal;
use App\Extrainfo;
use App\Adres;
use DB;
use App\Http\Requests;
use App\Huisarts;

use App\Http\Requests\JongereRequest;
use Carbon\Carbon;

class JongereController extends Controller
{
// -------------------------------------------------
//  INDEX
    public function index() {
// -------------------------------------------------
        $queryAllJongeren = Jongere::orderby('naam')->get();
        // Convert geboortedatum naar leeftijd
        $jongeren = $queryAllJongeren->map(function($jongere)
        {
            $geboortedatum = Carbon::createFromFormat('Y-m-d',$jongere->geboortedatum);
            //dd($geboortedatum->diffInYears(Carbon::now()));
            $leeftijd = $geboortedatum->diffInYears(Carbon::now());
            //dd($leeftijd);
            $newJongere = array(
                'id'=>$jongere->id,
                'naam'=>$jongere->naam,
                'voornaam'=>$jongere->voornaam,
                'leeftijd'=>$leeftijd
            );
            //dd($newJongere);
            return $newJongere;
        });
        //dd($jongeren);
        return view('jongere.showall',compact('jongeren'));
    }



// -------------------------------------------------
//  CREATE
    public function create($jongereNaam) {
// -------------------------------------------------
        $nationaliteiten = Nationaliteit::all()->lists('omschrijving','id');
        $jongere = new Jongere();
        $jongere->naam = $jongereNaam;
        $jongere->origine_id = 243;
        return view('jongere.create',[
                                'jongere'=>$jongere,
                            'nationaliteiten'=>$nationaliteiten
        ]);
    }


// -------------------------------------------------
//  CREATE
    public function createNoName() {
// -------------------------------------------------
        return $this->create('');
    }



// -------------------------------------------------
//  STORE
    public function store(Requests\JongereRequest $request) {
// -------------------------------------------------
        $jongere = Jongere::create($request->all());
        $nationaliteitIds=($request->input('nat_list'));
        $jongere->nationaliteit()->attach($nationaliteitIds);
        return redirect()->route('jongere.show',$jongere->id);
    }



// -------------------------------------------------
//  SHOW
    public function show($id) {
// -------------------------------------------------
        $jongere = Jongere::find($id);

        $nationaliteiten = $jongere->nationaliteit()->lists('omschrijving','id');
        $talen = $jongere->taal()->lists('omschrijving','id');
        $extrainfos = $jongere->extrainfo()->lists('omschrijving','id');
        $adressen = $jongere->adres()->get();
        $huisartsen = $jongere->huisarts()->get();
        $groepen = $jongere->groep()->lists('omschrijving','id');
        $activiteiten = $jongere->getActiviteit()->get();
        $ouders = $jongere->ouder()->get();

        $alleNationaliteiten = Nationaliteit::all();
        $alleTalen = Taal::all();
        $alleExtrainfos = Extrainfo::all();
        $alleAdressen = Adres::all();
        $alleGroepen = Groep::all();
        $alleHuisartsen = Huisarts::all();
        $alleOuders = Ouder::all();

        return view('jongere.show',[

                            'jongere' => $jongere,

                       'activiteiten' => $activiteiten,
                    'nationaliteiten' => $nationaliteiten,
                'alleNationaliteiten' => $alleNationaliteiten,
                              'talen' => $talen,
                          'alleTalen' => $alleTalen,
                         'extrainfos' => $extrainfos,
                     'alleExtrainfos' => $alleExtrainfos,
                           'adressen' => $adressen,
                       'alleAdressen' => $alleAdressen,
                            'groepen' => $groepen,
                        'alleGroepen' => $alleGroepen,
                         'huisartsen' => $huisartsen,
                     'alleHuisartsen' => $alleHuisartsen,
                             'ouders' => $ouders,
                         'alleOuders' => $alleOuders
                              ]);
    }


// -------------------------------------------------
//  EDIT
    public function edit($id) {
// -------------------------------------------------
        $jongere = Jongere::findOrFail($id);
        $jongereNaam = $jongere->naam;
        $nationaliteiten = Nationaliteit::all()->lists('omschrijving','id');

        return view('jongere.edit',[
                        'jongere'=>$jongere,
                    'jongereNaam'=>$jongereNaam,
                'nationaliteiten'=>$nationaliteiten]);
    }


// -------------------------------------------------
//  UPDATE
    public function update($id, JongereRequest $request) {
// -------------------------------------------------
        $jongere = Jongere::find($id);
        $jongere->naam = $request->naam;
        $jongere->voornaam = $request->voornaam;
        $jongere->geboortedatum = $request->geboortedatum;
        $jongere->email = $request->email;
        $jongere->facebook = $request->facebook;
        $jongere->origine_id = $request->origine_id;
        $jongere->save();
        return redirect()->route('jongere.show',compact('jongere'));

    }

// -------------------------------------------------
//  DESTROY
    public function destroy($id) {
// -------------------------------------------------
        $jongere=Jongere::destroy($id);
        $jongeren=Jongere::all();
        return view('staticpages.welcome',compact('jongere','jongeren'));
    }

// -------------------------------------------------
//  HELPER FUNCTIONS
    public function getBeschikbareNationaliteiten(){
// -------------------------------------------------
        $BeschikbareNationaliteiten = DB::table('nationaliteiten')
            ->leftJoin('jongere_nationaliteit', 'nationaliteiten.id', '=', 'jongere_nationaliteit.nationaliteit_id')
            ->select(DB::raw('nationaliteiten.omschrijving AS nationaliteit,
                COUNT(jongere_nationaliteit.jongere_id) AS aantal,
                nationaliteiten.id AS id'))
            ->groupBy('nationaliteiten.omschrijving')
            ->orderBy('aantal','desc')
            ->orderBy('nationaliteit','asc')
            ->get()
            ;
        $bound=count($BeschikbareNationaliteiten);
        for($i=0;$i<$bound;$i++){
            $valueObject=$BeschikbareNationaliteiten[$i]->id;
            //dd($valueObject);
            //$valueArray=collapse($valueObject);
            $CNat[$BeschikbareNationaliteiten[$i]->id]=$BeschikbareNationaliteiten[$i]->nationaliteit;
        }
        //dd($CNat);
        return ($CNat);
    }


    public function addNationaliteit($jongereId,$nationaliteitId){
        DB::table('jongere_nationaliteit')
            ->insert([
                    'nationaliteit_id' => $nationaliteitId,
                    'jongere_id' => $jongereId
                ]);
        return redirect()->route('jongere.show',$jongereId);
    }

    public function disconnectNationaliteit($jongereId,$nationaliteitId){
        DB::table('jongere_nationaliteit')
            ->where('nationaliteit_id','=', $nationaliteitId)
            ->where('jongere_id','=', $jongereId)
            ->delete();
        return redirect()->route('jongere.show',$jongereId);
    }
    public function addTaal($jongereId,$taalId){
        DB::table('jongere_taal')
            ->insert([
                    'taal_id' => $taalId,
                    'jongere_id' => $jongereId
                    ]);
        return redirect()->route('jongere.show',$jongereId);
    }

    public function disconnectTaal($jongereId,$taalId){
        DB::table('jongere_taal')
            ->where('taal_id','=', $taalId)
            ->where('jongere_id','=', $jongereId)
            ->delete();
        return redirect()->route('jongere.show',$jongereId);
    }

    public function addExtrainfo($jongereId,$extrainfoId){
        DB::table('extrainfo_jongere')
            ->insert([
                    'extrainfo_id' => $extrainfoId,
                    'jongere_id' => $jongereId
                ]);
        return redirect()->route('jongere.show',$jongereId);
    }

    public function disconnectExtrainfo($jongereId,$extrainfoId){
        DB::table('extrainfo_jongere')
            ->where('extrainfo_id','=', $extrainfoId)
            ->where('jongere_id','=', $jongereId)
            ->delete();
        return redirect()->route('jongere.show',$jongereId);
    }
    public function addGroep($jongereId,$groepId){
        DB::table('groep_jongere')
            ->insert([
                    'groep_id' => $groepId,
                    'jongere_id' => $jongereId
                ]);
        return redirect()->route('jongere.show',$jongereId);
    }

    public function disconnectGroep($jongereId,$groepId){
        DB::table('groep_jongere')
            ->where('groep_id','=', $groepId)
            ->where('jongere_id','=', $jongereId)
            ->delete();
        return redirect()->route('jongere.show',$jongereId);
    }

// -------------------------------------------------
//  CONNECT HUISARTS
    public function addHuisarts($jongereId,$huisartsId){
// -------------------------------------------------
        DB::table('huisarts_jongere')
            ->insert([
                'huisarts_id' => $huisartsId,
                'jongere_id' => $jongereId
            ]);
        return redirect()->route('jongere.show',$jongereId);
    }


// -------------------------------------------------
//  DISCONNECT HUISARTS
    public function disconnectHuisarts($jongereId,$huisartsId){
// -------------------------------------------------
        DB::table('huisarts_jongere')
            ->where('huisarts_id','=', $huisartsId)
            ->where('jongere_id','=', $jongereId)
            ->delete();
        return redirect()->route('jongere.show',$jongereId);
    }

    // -------------------------------------------------
//  CONNECT OUDER
    public function addOuder($jongereId,$ouderId){
// -------------------------------------------------
        DB::table('jongere_ouder')
            ->insert([
                'ouder_id' => $ouderId,
                'jongere_id' => $jongereId
            ]);
        return redirect()->route('jongere.show',$jongereId);
    }


// -------------------------------------------------
//  DISCONNECT OUDER
    public function disconnectOuder($jongereId,$ouderId){
// -------------------------------------------------
        DB::table('jongere_ouder')
            ->where('ouder_id','=', $ouderId)
            ->where('jongere_id','=', $jongereId)
            ->delete();
        return redirect()->route('jongere.show',$jongereId);
    }

}
