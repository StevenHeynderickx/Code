@extends('staticPages.staticPage')

@section('content')

    @unless(!$jongeren)
        <h1>Lijst Jongeren
            <small>
                <a href="/jongere/create" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>

        <div class="row">
        @foreach ($jongeren as $jongere)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <a href="{{ route('jongere.show', [$jongere['id']]) }}">
                    {{ $jongere['naam'] }} {{$jongere['voornaam']}} {{$jongere['leeftijd']}}
                </a>
            </div>
        @endforeach
        </div>
    @endunless

@stop