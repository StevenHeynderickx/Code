@extends('staticPages.staticPage')

@section('content')
<h1>Lijst Jongeren</h1>
@foreach ($jongeren as $jongere)
{{ $jongere->naam }} {{$jongere->voornaam}}
@endforeach

@stop