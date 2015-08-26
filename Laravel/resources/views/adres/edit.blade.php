@extends('staticPages.staticPage')

@section('content')
    <h2><small>Bewerk adres van&nbsp;<a href="/jongere/{{$jongere->id}}">{{$jongere->naam}} {{$jongere->voornaam}}</a></small></h2>
    {!! Form::model($adresDTO,['method'=>'PATCH','action' => 'AdresController@update','name'=>'form_name']) !!}
    @include ('adres.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop