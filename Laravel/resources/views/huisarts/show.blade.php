@extends('staticPages.staticPage')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $huisarts->naam }}&nbsp;{{ $huisarts->voornaam }}
                <small>
                    <a href="/huisarts/{{$huisarts->id}}/edit" type="button" class="btn btn-primary" id="btnEdit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                    </a>
                    <a href="/huisarts" type="button" class="btn btn-primary" id="btnList">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                        <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                    </a>
                    <a href="/huisarts/{{$huisarts->id}}/destroy" type="button" class="btn btn-danger" id="btnDel">
                        <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                    </a>
                </small>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Contactgegevens
                    </h3>
                </div>
                <div class="panel-body">
                    <b>Adres</b><br />
                    {{ $huisarts->getStraat() }}&nbsp;{{ $huisarts->nummer }}@if($huisarts->bus){{'/'.$huisarts->bus}}@endif<br />
                    {{ $huisarts->getGemeente()->postcode}}&nbsp;{{$huisarts->getGemeente()->gemeente}}<br />
                    <b>Telefoon</b><br />
                    {{ $huisarts->contactnummer}}<br />
                    <b>Internet</b><br />
                    <a href="{{ $huisarts->url}}">Link naar site</a>
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-7">
            @unless(!$huisarts->getJongeren()->get())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Behandelt volgende jongeren
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Naam</th>
                                    <th>Leeftijd</th>
                                </tr>

                                @foreach ($huisarts->getJongeren()->get() as $jongere)
                                    <tr>
                                        <td>
                                            <a href="/jongere/{{$jongere->id}}">{{$jongere->naam}}&nbsp;{{$jongere->voornaam}}</a>
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($jongere->geboortedatum)->diffInYears(\Carbon\Carbon::now())}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>
@stop
