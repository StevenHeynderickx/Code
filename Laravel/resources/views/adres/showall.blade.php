@extends('staticPages.staticPage')

@section('content')



        <h1>Lijst Adressen
            <small>
                <a href="{{route('adres.create')}}" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>
        @unless(!$adressen)

                <div class="row">
                    @foreach ($adressen as $adres)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('adres.show', $adres->id) }}">
                                {{ $adres->getStraat() }}&nbsp;{{ $adres->nummer }}@if( $adres->bus != '' )&nbsp;/{{ $adres->bus }}/@endif<br />
                                {{$adres->getGemeente()->postcode.' '.
                                $adres->getGemeente()->gemeente}}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endunless


@stop
