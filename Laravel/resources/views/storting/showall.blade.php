@extends('staticPages.staticPage')

@section('content')



    <h1>Lijst Stortingen
        <small>
            <a href="{{route('storting.create')}}" type="button" class="btn btn-primary hideMeForPrint" id="btnAdd">
                <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
            </a>
        </small>
    </h1>
    @unless(!$activiteiten)
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Volgende Stortingen bestaan
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Omschrijving</th>
                                <th>Datum</th>
                                <th class="text-center">#Stortingen</th>
                                <th class="text-center">Totaal</th>
                                <th class="text-center hideMeForPrint">Acties</th>

                            </tr>

                            @foreach ($activiteiten as $activiteit)
                                <tr>
                                    <td>
                                        <a href="/storting/{{$activiteit->id}}">{{$activiteit->omschrijving}}</a>
                                    </td>
                                    <td>
                                        {{$activiteit->datum}}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge btn-primary">&nbsp;{{$activiteit->countStortingen->first()["stortingen"]}}&nbsp;</span>
                                    </td>
                                    <td class="text-center">
                                        {{$activiteit->countStortingen->first()["totaal"]}}
                                    </td>
                                    <td class="text-center">
                                        <a href="/storting/{{$activiteit->id}}/edit" type="button" class="btn btn-primary hideMeForPrint" id="btnEdit">
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
@stop
