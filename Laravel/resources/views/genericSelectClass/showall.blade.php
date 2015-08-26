@extends('staticPages.staticPage')

@section('content')



        <h1>Lijst {{$classNames_String}}
            <small>
                <a href="{{route($className_String.'.create')}}" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>


        @unless(!$classNames)
            <div class="row">
                @foreach ($classNames as $$className_String)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                        <a href="{{ route($className_String.'.show', $$className_String->id) }}">
                            {{ $$className_String->$attribute }}
                        </a>
                    </div>
                @endforeach
            </div>

        @endunless


@stop
