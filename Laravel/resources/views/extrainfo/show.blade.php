@extends('staticPages.staticPage')

@section('content')
    <div class="page-header">
        <h1>{{ $extrainfo->omschrijving }}
            <small>
                <span class="zichtbaar{{$extrainfo->priority}}">Zichtbaar</span>
                <span class="onzichtbaar{{$extrainfo->priority}}">Onzichtbaar</span>
                <a href="/extrainfo/{{$extrainfo->id}}/edit" type="button" class="btn btn-primary" id="btnEditJongere">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                </a>
                <a href="/extrainfo" type="button" class="btn btn-primary" id="btnList">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                </a>
                <a href="/extrainfo/{{$extrainfo->id}}/destroy" type="button" class="btn btn-danger" id="btnDel">
                    <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                </a>
            </small>
        </h1>
    </div>
    <style>
        .zichtbaar1,.onzichtbaar0{display:inline}
        .zichtbaar0,.onzichtbaar1{display:none}
    </style>
@stop
