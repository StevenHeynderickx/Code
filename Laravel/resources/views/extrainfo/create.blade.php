@extends('staticPages.staticPage')

@section('content')
    <h1>Maak nieuwe Extra-info aan</h1>
    {!! Form::open(['route' => 'extrainfo.store','name'=>'form_name']) !!}
    @include ('extrainfo.form',['submitButtonText'=>'Maak'])
    {!! Form::close() !!}
    @include('errors.list')
@stop