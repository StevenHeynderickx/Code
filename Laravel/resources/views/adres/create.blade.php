@extends('staticPages.staticPage')

@section('content')
    <h1>Nieuw Adres voor&nbsp;<small>{{$jongere->naam}} {{$jongere->voornaam}}</small></h1>
    {!! Form::open(['route' => 'adres.store','name'=>'form_name']) !!}
    @include ('adres.form',['submitButtonText'=>'Maak'])
    {!! Form::close() !!}
    @include('errors.list')
@stop