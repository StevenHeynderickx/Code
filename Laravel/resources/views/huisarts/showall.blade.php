@extends('staticPages.staticPage')

@section('content')
        <h1>Lijst Huisartsen
            <small>
                <a href="{{route('huisarts.create')}}" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>
    @unless(!$huisartsen)
        <div class="row">
            @foreach ($huisartsen as $huisarts)
                <div class="row col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="huisarts/{{$huisarts->id}}">
                                    {{ $huisarts->naam }}&nbsp;{{ $huisarts->voornaam }}
                                </a>
                            </h3>
                        </div>
                        <div class="panel-body">
                            {{ $huisarts->getStraat() }}&nbsp;{{ $huisarts->nummer }}@if($huisarts->bus){{'/'.$huisarts->bus}}@endif<br />
                            {{ $huisarts->getGemeente()->postcode}}&nbsp;{{$huisarts->getGemeente()->gemeente}}<br />
                            {{ $huisarts->contactnummer}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endunless


@stop
