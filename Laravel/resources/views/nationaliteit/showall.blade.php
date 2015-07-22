@extends('staticPages.staticPage')

@section('content')

    @unless(!$nationaliteiten)

        <h1>Lijst Nationaliteiten
            <small>
                <a href="{{route('nationaliteit.create')}}" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>


        <div class="row">
            @foreach ($nationaliteiten as $nationaliteit)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('nationaliteit.show', $nationaliteit->id) }}">
                        {{ $nationaliteit->omschrijving }}
                    </a>
                    - ({{ $nationaliteit->afkorting }})
                </div>
            @endforeach
        </div>

    @endunless

@stop