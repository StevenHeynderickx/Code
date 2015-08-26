@extends('staticPages.staticPage')

@section('content')
    <h1>Bewerk {!! $extrainfo->omschrijving !!}</h1>
    {!! Form::model($extrainfo,['method'=>'PATCH','action' => ['ExtrainfoController@update',$extrainfo->id],'name'=>'form_name']) !!}
    @include ('extrainfo.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop