@extends('staticPages.staticPage')

@section('content')
    <div class="page-header">
        <h1>{{ $gemeente->postcode.' '. $gemeente->gemeente }}
            <small>
                <a href="/gemeente/{{$gemeente->id}}/edit" type="button" class="btn btn-primary" id="btnEdit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                </a>
                <a href="/gemeente" type="button" class="btn btn-primary" id="btnList">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                    <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                </a>
                <a href="/gemeente/{{$gemeente->id}}/destroy" type="button" class="btn btn-danger" id="btnDel">
                    <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                </a>
            </small>
        </h1>
    </div>
@stop
