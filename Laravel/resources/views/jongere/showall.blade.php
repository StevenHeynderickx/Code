@extends('staticPages.staticPage')

@section('content')
@unless(!$jongeren)
<h1>Lijst Jongeren</h1>
<ul>
@foreach ($jongeren as $jongere)
<li>
<a href="{{ route('getJongereById', [$jongere->id]) }}">{{ $jongere->naam }} {{$jongere->voornaam}}</a>
</li>
@endforeach
</ul>
@endunless

@stop