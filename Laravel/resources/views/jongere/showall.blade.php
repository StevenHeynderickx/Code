@extends('staticPages.staticPage')

@section('content')
@unless(!$jongeren)
<h1>Lijst Jongeren 18+</h1>
<ul>
@foreach ($jongeren as $jongere)
<li>
<a href="{{ route('showJongereById', [$jongere->id]) }}">{{ $jongere->naam }} {{$jongere->voornaam}}</a>
</li>
@endforeach
</ul>
@endunless

@stop