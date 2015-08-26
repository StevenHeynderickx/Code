<div class="row">
    <div class="col-md-4">
        <p class="text-right" style="padding-right:10px;">
            {{$Many}}:&nbsp;
            <a href="#" type="button" class="btn btn-primary btn-xs" id="btn_show_{{$many}}_form"
               onclick="  document.getElementById('form_{{$many}}').style.display = 'block';
                       document.getElementById('btn_show_{{$many}}_form').style.visibility = 'hidden';
                       return false;">
                <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Toevoegen"></span>
            </a>
        </p>
    </div>
    <div class="col-md-8">
        <div class="container-fluid">
            <div class="row">
                @foreach($huisartsen as $huisarts)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a href="/huisarts/{{$huisarts->id}}">
                                        {{ $huisarts->naam }}&nbsp;{{ $huisarts->voornaam }}&nbsp;
                                    </a>
                                    <div class="btn-group" role="group" aria-label="...">
                                        <a href="/jongere/{{$jongere->id}}/huisarts/{{$huisarts->id}}/disconnect" type="button" class="btn btn-default btn-xs" id="btn_show_adress_form">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Verwijderen"></span>
                                        </a>
                                        <a href="/huisarts/{{$huisarts->id}}/edit/{{$jongere->id}}" type="button" class="btn btn-default btn-xs" id="btn_show_adress_form">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                                        </a>
                                        <a href="{{$huisarts->url}}" target="_blank" type="button" class="btn btn-default btn-xs" id="btn_show_adress_form">
                                            <span class="glyphicon glyphicon-link" aria-hidden="false" aria-label="Aanpassen"></span>
                                        </a>
                                    </div>
                                </h3>
                            </div>
                            <div class="panel-body">
                                {{ $huisarts->getStraat() }}&nbsp;{{ $huisarts->nummer }}@if($huisarts->bus){{'/'.$huisarts->bus}}@endif<br />
                                {{ $huisarts->getGemeente()->postcode}}&nbsp;{{$huisarts->getGemeente()->gemeente}}<br />
                                {{ $huisarts->contactnummer}}<br />
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-8" style="display:none" id="form_{{$many}}">

        {!! Form::open(['route' => $many.'.store',
        'name'=>'form_'.$many] )!!}
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-btn" id="alert_{{$many}}">
                    <a href="/huisarts/create/{{$jongere->id}}" type="button" class="btn btn-primary">
                        Onbekend, aanmaken? <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken" ></span>
                    </a>
                </div>
                {!! Form::text('entry_'.$many,null,[
                'placeholder'=>'Typ '.$many.' en selecteer',
                'class'=>'form-control',
                'onKeyUp'=>'javascript:combo'. $nr .'.comboUpdate();'])
                !!}
                <div class="input-group-btn">
                    <a href="/" type="button" class="btn btn-default" onmouseup="combo{{$nr}}.btnAddClicked()" id="btnAdd_{{$many}}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken" id="glyphiconAdd_{{$many}}"></span>
                    </a>
                </div>
            </div>

            <select name="select_{{$many}}" size=5 class="form-control" onmouseup="javascript:combo{{$nr}}.copySelectedToInput();">
                @foreach ($allManys as $oneMany)
                    <option value="{{ $oneMany->id }}">
                        {{ $oneMany->naam }} {{ $oneMany->voornaam }}
                    </option>
                @endforeach
            </select>
        </div>
        {!! Form::close() !!}
    </div>
</div>
