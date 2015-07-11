@extends('staticPages.staticPage')

@section('content')
<h1>{{ $jongere->naam }} {{ $jongere->voornaam }}</h1>
Hier kunnen extra gegevens van de jongere komen
{{ $jongere }}

@stop