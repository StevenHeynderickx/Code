@extends('staticPages.staticPage')

@section('content')
<h1>Maak nieuwe jongere aan</h1>
{!! Form::open(['route' => 'storeJongere']) !!}

<div class="fromgroup">
        {!! Form::label('naam','Naam:') !!}
        {!! Form::text('naam',null,['class'=>'form-control'])!!}
</div>
<div class="fromgroup">
        {!! Form::label('voornaam','Voornaam:') !!}
        {!! Form::text('voornaam',null,['class'=>'form-control'])!!}
</div>
<div class="fromgroup">
    {!! Form::label('geboortedatum','Geboortedatum:') !!}
    {!! Form::input('date','geboortedatum',null,['class'=>'form-control'])!!}
</div>
<div class="fromgroup">
    <br \>
    {!! Form::submit('Maak',['class'=>'form-control btn btn-primary']) !!}
</div>


{!! Form::close() !!}

@stop