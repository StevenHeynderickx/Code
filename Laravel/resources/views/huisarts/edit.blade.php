@extends('staticPages.staticPage')

@section('content')
    <h2><small>Bewerk adres van huisarts&nbsp;<a href="/huisarts/{{$huisartsDTO->getId()}}">{{$huisartsDTO->getNaam()}} {{$huisartsDTO->getVoornaam()}}</a></small></h2>
    {!! Form::model($huisartsDTO,['method'=>'PATCH','action' => 'HuisartsController@update','name'=>'form_name']) !!}
    @include ('huisarts.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop