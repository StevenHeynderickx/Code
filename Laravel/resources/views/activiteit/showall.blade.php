@extends('staticPages.staticPage')

@section('title')
    Lijst Activiteiten
@stop


@section('content')



    <h2>Lijst Activiteiten
        <small class="hideMeForPrint">
            <a href="{{route('activiteit.create')}}" type="button" class="btn btn-primary hideMeForPrint" id="btnAdd">
                <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
            </a>
        </small>
    </h2>
    @unless(!$activiteiten)
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Volgende Activiteiten bestaan
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th class="text-left">Omschrijving</th>
                                <th class="text-center">Datum</th>
                                <th class="text-right">Prijs</th>
                                <th class="text-center">Maaltijd</th>
                                <th class="text-center">Inschrijvingen</th>
                                <th class="text-center hideMeForPrint">Acties</th>

                            </tr>

                            @foreach ($activiteiten as $activiteit)
                                <tr>
                                    <td>
                                        <a href="/activiteit/{{$activiteit->id}}">{{$activiteit->omschrijving}}</a>
                                    </td>
                                    <td class="text-center">
                                        {{$activiteit->datum}}
                                    </td>
                                    <td class="text-right">
                                        {{$activiteit->getPositivePrijs()}}
                                    </td>
                                    <td class="text-center">
                                            <span class="zichtbaar{{$activiteit->maaltijd}}">
                                                Voorzien&nbsp;<span class="badge btn-primary">&nbsp;{{$activiteit->countMaaltijden->first()["maaltijden"]}}&nbsp;</span>
                                            </span>
                                            <span class="onzichtbaar{{$activiteit->maaltijd}}">
                                                Niet Voorzien
                                            </span>


                                    </td>
                                    <td class="text-center">
                                        <span class="badge btn-primary">&nbsp;{{$activiteit->countInschrijvingen->first()["inschrijvingen"]}}&nbsp;</span>
                                    </td>
                                    <td class="text-center hideMeForPrint">
                                        <a href="/activiteit/{{$activiteit->id}}/edit" type="button" class="btn btn-primary" id="btnAdd">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endunless
    <style>
        .zichtbaar1,.onzichtbaar0{display:inline}
        .zichtbaar0,.onzichtbaar1{display:none}

    </style>

@stop
