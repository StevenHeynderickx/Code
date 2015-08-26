@extends('staticPages.staticPage')

@section('title')
    Bewerk een activiteit
@stop

@section('content')
    <h1>Bewerk {!! $activiteit->omschrijving !!}</h1>
    {!! Form::model($activiteit,['method'=>'PATCH','action' => ['ActiviteitController@update',$activiteit->id],'name'=>'form_name']) !!}
    @include ('activiteit.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop