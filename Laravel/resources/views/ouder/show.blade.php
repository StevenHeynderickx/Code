@extends('staticPages.staticPage')

@section('content')
    <div class="row">
        <h1>{{ $ouder->naam }}&nbsp;{{ $ouder->voornaam }}
            <small class="hideMeForPrint">
                <a href="/ouder/{{$ouder->id}}/edit" type="button" class="btn btn-primary" id="btnEdit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                </a>
                <a href="/ouder" type="button" class="btn btn-primary" id="btnList">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                </a>
                <a href="/ouder/{{$ouder->id}}/destroy" type="button" class="btn btn-danger" id="btnDel">
                    <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                </a>
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Gegevens
                    </h3>
                </div>
                <div class="panel-body">
                    <b>Origine</b><br />
                    {{$ouder->getOrigine()}}<br />
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-7">
            @unless(!$ouder->getJongeren()->get())
                <div class="row">
                    <h4>Heeft een relatie met volgende jongeren</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Naam</th>
                                <th>Relatie</th>
                                <th class="hideMeForPrint">Acties</th>
                            </tr>

                            @foreach ($ouder->getJongeren()->get() as $jongere)
                                <tr>
                                    <td>
                                        <a href="/jongere/{{$jongere->id}}">{{$jongere->naam}}&nbsp;{{$jongere->voornaam}}</a>
                                    </td>
                                    <td>
                                        {{$jongere->getOuderRelatie($ouder->id)}}
                                    </td>
                                    <td class="hideMeForPrint">
                                        <a href="/ouder/{{$ouder->id}}/jongere/{{$jongere->id}}/disconnect" type="button" class="btn btn-default btn-xs">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Verwijderen"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endunless
        </div>
    </div>
@stop
