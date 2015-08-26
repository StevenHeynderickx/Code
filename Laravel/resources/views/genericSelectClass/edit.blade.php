@extends('staticPages.staticPage')

@section('content')
    <h1>Bewerk {!! $$className_String->$attribute !!}</h1>
    {!! Form::model($$className_String,['method'=>'PATCH','action' => [$ClassName_String.'Controller@update',$$className_String->id],'name'=>'form_name','id'=>'form_name']) !!}
    @include ('genericSelectClass.form',['submitButtonText'=>'Pas aan'])
    {!! Form::close() !!}
    @include ('errors.list')
@stop