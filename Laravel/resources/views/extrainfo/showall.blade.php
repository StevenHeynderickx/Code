@extends('staticPages.staticPage')

@section('content')



        <h1>Lijst Extra info
            <small>
                <a href="{{route('extrainfo.create')}}" type="button" class="btn btn-primary" id="btnAdd">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
                </a>
            </small>
        </h1>
        @unless(!$extrainfos)
        <div class="row">
            <div class="col-lg-12">
                <p>Extra-info's zijn kernachtige omschrijvingen die een beter inzicht geven
                in de socio-psychologiche situatie van de jongere en zijn/haar omgeving.</p>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Omschrijving</th>
                        <th>Toon</th>
                    </tr>
                    @foreach ($extrainfos as $extrainfo)
                    <tr>
                        <td>
                            <a href="{{ route('extrainfo.show', $extrainfo->id) }}">
                                {{ $extrainfo->omschrijving }}
                            </a>
                        </td>
                        <td>
                            <span class="zichtbaar{{$extrainfo->priority}}">
                                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                            </span>
                            <span class="onzichtbaar{{$extrainfo->priority}}">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <style>
            .zichtbaar1,.onzichtbaar0{display:inline}
            .zichtbaar0,.onzichtbaar1{display:none}
        </style>


    @endunless

@stop
