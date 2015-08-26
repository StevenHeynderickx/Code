@extends('staticPages.staticPage')

@section('content')

    <h1>Maak nieuwe jongere aan</h1>

    {!! Form::open(['route' => 'jongere.store','name'=>'jongereForm']) !!}

        @include ('jongere.form',[
        'submitButtonText'  =>  'Maak',
        'jongere'       =>  $jongere ,
        'nationaliteiten'   =>  $nationaliteiten])


    {!! Form::close() !!}

    @include('errors.list')

@stop