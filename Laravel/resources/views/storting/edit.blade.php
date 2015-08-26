@extends('staticPages.staticPage')

@section('content')
    <h1>Bewerk {!! $activiteit->omschrijving !!}</h1>
    {!! Form::model($activiteit,['method'=>'PATCH','action' => ['StortingController@update',$activiteit->id],'name'=>'form_name']) !!}
    @include ('storting.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop