@extends('staticPages.staticPage')

@section('content')
    <h2>Maak nieuwe stortingsperiode aan</h2>
    {!! Form::open(['route' => 'storting.store','name'=>'form_name']) !!}
    @include ('storting.form',['submitButtonText'=>'Maak'])
    {!! Form::close() !!}
    @include('errors.list')
@stop