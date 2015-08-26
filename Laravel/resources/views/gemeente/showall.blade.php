@extends('staticPages.staticPage')

@section('content')



        <h1>Lijst Gemeenten
            <small>
                <a href="{{route('gemeente.create')}}" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>
        @unless(!$gemeenten)

                <div class="row">
                    @foreach ($gemeenten as $gemeente)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="{{ route('gemeente.show', $gemeente->id) }}">
                                {{ $gemeente->postcode.' '.$gemeente->gemeente}}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endunless


@stop
