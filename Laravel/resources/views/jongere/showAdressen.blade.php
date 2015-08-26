<div class="row">
    <div class="col-md-4">
        <p class="text-right" style="padding-right:10px;">
            Adressen:&nbsp;
            <a href="/adres/create/{{$jongere->id}}" type="button" class="btn btn-primary btn-xs" id="btn_show_adress_form">
                <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Toevoegen"></span>
            </a>
        </p>
    </div>
    <div class="col-md-8">
        <div class="container-fluid">
            <div class="row">
                @foreach($jongere->adres as $adres)
                    <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $adres->omschrijving }}&nbsp;
                            <div class="btn-group" role="group" aria-label="...">
                                <a href="/adres/{{$adres->id}}/{{$jongere->id}}/destroy" type="button" class="btn btn-default btn-xs" id="btn_show_adress_form">
                                    <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Verwijderen"></span>
                                </a>
                                <a href="/adres/{{$adres->id}}/{{$jongere->id}}/edit" type="button" class="btn btn-default btn-xs" id="btn_show_adress_form">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                                </a>
                            </div>
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ $adres->getStraat() }}&nbsp;{{ $adres->nummer }}@if($adres->bus){{'/'.$adres->bus}}@endif<br />
                        {{ $adres->getGemeente()->postcode}}&nbsp;{{$adres->getGemeente()->gemeente}}<br />
                    </div>
                </div>
            </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
