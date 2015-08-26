@extends('staticPages.staticPage')

@section('content')
    <h1>Maak nieuwe {{$ClassName_String}} aan</h1>
    {!! Form::open(['route' => $className_String.'.store','name'=>'form_name','id'=>'form_name']) !!}
    @include ('genericSelectClass.form')
    {!! Form::close() !!}
    @include('errors.list')
@stop