@extends('staticPages.staticPage')

@section('content')

    <h1>Bewerk {!! $jongere->naam !!} {!! $jongere->voornaam !!}</h1>

    {!! Form::model($jongere,['method'=>'PATCH','action' => ['JongereController@update',$jongere->id],'name'=>'jongereForm']) !!}

        @include ('jongere.form',['submitButtonText'=>'Pas aan'])

    {!! Form::close() !!}

    @include ('errors.list')

@stop