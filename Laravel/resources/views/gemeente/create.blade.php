@extends('staticPages.staticPage')

@section('content')
    <h1>Maak nieuwe Gemeente aan</h1>
    {!! Form::open(['route' => 'gemeente.store','name'=>'form_name']) !!}
    @include ('gemeente.form',['submitButtonText'=>'Maak'])
    {!! Form::close() !!}
    @include('errors.list')
@stop