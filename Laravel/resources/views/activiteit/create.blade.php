@extends('staticPages.staticPage')

@section('title')
    Maak nieuwe Activiteit aan
@stop

@section('content')
    <h1>Maak nieuwe Activiteit aan</h1>
    {!! Form::open(['route' => 'activiteit.store','name'=>'form_name']) !!}
    @include ('activiteit.form',['submitButtonText'=>'Maak'])
    {!! Form::close() !!}
    @include('errors.list')
@stop