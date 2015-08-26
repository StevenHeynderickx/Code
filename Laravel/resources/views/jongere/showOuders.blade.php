<div class="row">
    <div class="col-md-4">
        <p class="text-right" style="padding-right:10px;">
            {{$Many}}:&nbsp;
            <a href="/ouder/create/{{$jongere->id}}" type="button" class="btn btn-primary btn-xs" id="btn_show_{{$many}}_form">
                <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Toevoegen"></span>
            </a>
        </p>
    </div>
    <div class="col-md-8">
        <div class="container-fluid">
            <div class="row">
                @foreach($jongere->ouder()->get() as $ouder)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="/ouder/{{$ouder->id}}">
                                        {{ $ouder->naam }}&nbsp;{{ $ouder->voornaam }}&nbsp;
                                    </a>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="/jongere/{{$jongere->id}}/ouder/{{$ouder->id}}/disconnect" type="button" class="btn btn-default btn-xs" id="btn_del_{{$many}}_form">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Verwijderen"></span>
                                        </a>
                                        <a href="/ouder/{{$ouder->id}}/edit/{{$jongere->id}}" type="button" class="btn btn-default btn-xs" id="btn_edit_{{$many}}_form">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                                        </a>
                                    </div>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <b>Origine</b>&nbsp;:{{ $ouder->origine->omschrijving }}<br />
                                Ingeschreven kinderen&nbsp;:<br />
                                @foreach($ouder->getJongeren as $jongere)
                                    <b>{{ $jongere->getOuderRelatie($ouder->id) }}</b> van <a href="/jongere/{{$jongere->id}}">{{$jongere->naam}}&nbsp;{{$jongere->voornaam}}</a><br />
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
