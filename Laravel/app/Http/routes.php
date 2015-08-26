<?php

/*
|--------------------------------------------------------------------------
| Route
|--------------------------------------------------------------------------
*/

Route::get('/'          ,['as'=>'home','uses'=>'StaticPageController@home']);

/*
|--------------------------------------------------------------------------
| Static Pages
|--------------------------------------------------------------------------
*/

Route::get('/hello'     , function () {return 'hello world';});
Route::get('/contact'   , 'StaticPageController@contact');
Route::get('/about'     , 'StaticPageController@about');
Route::get('/people'    , 'StaticPageController@people');

/*
|--------------------------------------------------------------------------
| Jongere
|--------------------------------------------------------------------------
*/
Route::post     ('/jongere'                                             , ['as'=>'jongere.store'            ,'uses'=>'JongereController@store']);
Route::get      ('/jongere'                                             , ['as'=>'jongere.index'            ,'uses'=>'JongereController@index']);
Route::get      ('/jongere/create'                                      , ['as'=>'jongere.createNoName'     ,'uses'=>'JongereController@createNoName']);
Route::get      ('/jongere/create/{naam}'                               , ['as'=>'jongere.create'           ,'uses'=>'JongereController@create']);
Route::get      ('/jongere/{id}/edit'                                   , ['as'=>'jongere.edit'             ,'uses'=>'JongereController@edit']);
Route::get      ('/jongere/{id}/destroy'                                , ['as'=>'jongere.destroy'          ,'uses'=>'JongereController@destroy']);
Route::get      ('/jongere/{id}'                                        , ['as'=>'jongere.show'             ,'uses'=>'JongereController@show']);
Route::put      ('/jongere/{id}'                                        , ['as'=>'jongere.update'           ,'uses'=>'JongereController@update']);
Route::patch    ('/jongere/{id}'                                        , [                                  'uses'=>'JongereController@update']);
Route::get      ('/jongere/{jong_id}/nationaliteit/{nat_id}'            , ['as'=>'jongere.addNationaliteit' ,'uses'=>'JongereController@addNationaliteit']);
Route::get      ('/jongere/{jong_id}/nationaliteit/{nat_id}/disconnect' , ['as'=>'jongere.delNationaliteit' ,'uses'=>'JongereController@disconnectNationaliteit']);
Route::get      ('/jongere/{jong_id}/taal/{nat_id}'                     , ['as'=>'jongere.addTaal'          ,'uses'=>'JongereController@addTaal']);
Route::get      ('/jongere/{jong_id}/taal/{nat_id}/disconnect'          , ['as'=>'jongere.delTaal'          ,'uses'=>'JongereController@disconnectTaal']);
Route::get      ('/jongere/{jong_id}/extrainfo/{xtr_id}'                , ['as'=>'jongere.addExtrainfo'     ,'uses'=>'JongereController@addExtrainfo']);
Route::get      ('/jongere/{jong_id}/extrainfo/{xtr_id}/disconnect'     , ['as'=>'jongere.delExtrainfo'     ,'uses'=>'JongereController@disconnectExtrainfo']);
Route::get      ('/jongere/{jong_id}/groep/{groep_id}'                  , ['as'=>'jongere.addGroep'         ,'uses'=>'JongereController@addGroep']);
Route::get      ('/jongere/{jong_id}/groep/{groep_id}/disconnect'       , ['as'=>'jongere.delGroep'         ,'uses'=>'JongereController@disconnectGroep']);
Route::get      ('/jongere/{jong_id}/huisarts/{huisarts_id}'            , ['as'=>'jongere.addHuisarts'      ,'uses'=>'JongereController@addHuisarts']);
Route::get      ('/jongere/{jong_id}/huisarts/{huisarts_id}/disconnect' , ['as'=>'jongere.delHuisarts'      ,'uses'=>'JongereController@disconnectHuisarts']);
Route::get      ('/jongere/{jong_id}/ouder/{huisarts_id}'               , ['as'=>'jongere.addOuder'         ,'uses'=>'JongereController@addOuder']);
Route::get      ('/jongere/{jong_id}/ouder/{huisarts_id}/disconnect'    , ['as'=>'jongere.delOuder'         ,'uses'=>'JongereController@disconnectOuder']);


Route::get      ('/nationaliteit/{id}/destroy'                          , ['as'=>'nationaliteit.destroy'    ,'uses'=>'NationaliteitController@destroy']);
Route::get      ('/straat/{id}/destroy'                                 , ['as'=>'straat.destroy'           ,'uses'=>'StraatController@destroy']);
Route::get      ('/groep/{id}/destroy'                                  , ['as'=>'groep.destroy'            ,'uses'=>'GroepController@destroy']);
Route::get      ('/taal/{id}/destroy'                                   , ['as'=>'taal.destroy'             ,'uses'=>'TaalController@destroy']);
Route::get      ('/relatie/{id}/destroy'                                , ['as'=>'relatie.destroy'          ,'uses'=>'RelatieController@destroy']);
Route::get      ('/gemeente/{id}/destroy'                               , ['as'=>'gemeente.destroy'         ,'uses'=>'GemeenteController@destroy']);
Route::get      ('/activiteit/{id}/destroy'                             , ['as'=>'activiteit.destroy'       ,'uses'=>'ActiviteitController@destroy']);
Route::get      ('/storting/{id}/destroy'                               , ['as'=>'storting.destroy'         ,'uses'=>'StortingController@destroy']);
Route::get      ('/ouder/{id}/destroy'                                  , ['as'=>'ouder.destroy'            ,'uses'=>'OuderController@destroy']);

Route::post     ('/activiteit/connect/'                                 , ['as'=>'activiteit.connect'       ,'uses'=>'ActiviteitController@connect']);
Route::get      ('/activiteit/{connectionId}/disconnect/{activiteitId}' , ['as'=>'activiteit.disconnect'    ,'uses'=>'ActiviteitController@disconnect']);

Route::post     ('/storting/connect'                                    , ['as'=>'storting.connect'         ,'uses'=>'StortingController@connect']);
Route::get      ('/storting/{connectionId}/disconnect/{stortingId}'     , ['as'=>'storting.disconnect'      ,'uses'=>'StortingController@disconnect']);

Route::get      ('/adres/create/{jongereId}'                            , ['as'=>'adres.create'             ,'uses'=>'AdresController@create']);
Route::get      ('/adres/{adresId}/{jongereId}/edit'                    , ['as'=>'adres.edit'               ,'uses'=>'AdresController@edit']);
Route::get      ('/adres/{adresId}/{jongereId}/destroy'                 , ['as'=>'adres.destroy'            ,'uses'=>'AdresController@destroy']);

Route::get      ('/ouder/create/{jongereId}'                            , ['as'=>'ouder.create'             ,'uses'=>'OuderController@create']);
Route::get      ('/ouder/{ouderId}/edit'                                , ['as'=>'ouder.edit'               ,'uses'=>'OuderController@edit']);
Route::get      ('/ouder/{ouderId}/edit/{jongereId?}'                   , ['as'=>'ouder.edit'               ,'uses'=>'OuderController@edit']);
Route::get      ('/ouder/{ouderId}/{jongereId}/destroy'                 , ['as'=>'ouder.destroy'            ,'uses'=>'OuderController@destroy']);
Route::get      ('/ouder/{ouderId}/jongere/{jongereId}/disconnect'      , ['as'=>'ouder.disconnect'         ,'uses'=>'OuderController@disconnect']);

Route::get      ('/huisarts/create/{jongereId?}'                        , ['as'=>'huisarts.create'          ,'uses'=>'HuisartsController@create']);
Route::get      ('/huisarts/{huisartsId}/edit/{jongereId?}'             , ['as'=>'huisarts.edit'            ,'uses'=>'HuisartsController@edit']);
Route::get      ('/huisarts/{huisartsId}/destroy'                       , ['as'=>'huisarts.destroy'         ,'uses'=>'HuisartsController@destroy']);



Route::resource ('nationaliteit','NationaliteitController');
Route::resource ('relatie','RelatieController');
Route::resource ('taal','TaalController');
Route::resource ('extrainfo','ExtrainfoController');
Route::resource ('groep','GroepController');
Route::resource ('straat','StraatController');
Route::resource ('gemeente','GemeenteController');
Route::resource ('adres','AdresController');
Route::resource ('huisarts','HuisartsController');
Route::resource ('activiteit','ActiviteitController');
Route::resource ('storting','StortingController');
Route::resource ('ouder','OuderController');
