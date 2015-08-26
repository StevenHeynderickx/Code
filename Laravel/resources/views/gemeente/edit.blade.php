@extends('staticPages.staticPage')

@section('content')
    <h1>Bewerk {!! $gemeente->gemeente !!}</h1>
    {!! Form::model($gemeente,['method'=>'PATCH','action' => ['GemeenteController@update',$gemeente->id],'name'=>'form_name']) !!}
    @include ('gemeente.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop