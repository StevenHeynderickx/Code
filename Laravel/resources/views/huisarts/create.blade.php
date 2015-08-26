@extends('staticPages.staticPage')

@section('content')
    <h1><small>Gegevens nieuwe huisarts</small></h1>
    {!! Form::open(['route' => 'huisarts.store','name'=>'form_name']) !!}
    @include ('huisarts.form',['submitButtonText'=>'Maak'])
    {!! Form::close() !!}
    @include('errors.list')
@stop