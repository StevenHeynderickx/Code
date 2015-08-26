@extends('staticPages.staticPage')

@section('content')
    <div class="page-header">
        <h1>{{ $$className_String->$attribute }}
            <small>
                <a href="/{{$className_String}}/{{$$className_String->id}}/edit" type="button" class="btn btn-primary" id="btnEditJongere">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                </a>
                <a href="/{{$className_String}}/{{$$className_String->id}}/destroy" type="button" class="btn btn-danger" id="btnDel">
                    <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                </a>
                <a href="/{{$className_String}}" type="button" class="btn btn-primary" id="btnList">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                </a>
                <a href="/{{$className_String}}/create" type="button" class="btn btn-primary" id="btnDel">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Verwijder"></span>
                    <span class="glyphicon glyphicon-arrow-right" aria-hidden="false" aria-label="Lijst"></span>
                </a>
            </small>
        </h1>
    </div>
@stop
