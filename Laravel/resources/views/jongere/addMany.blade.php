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
        <p class="text-left">

            @foreach($manys as $key=>$value)
                <span class="btn-group" role="group">
                        <a href="/{{$many}}/{{$key}}" type="button" class="btn btn-default btn-sm">
                            {{$value}}
                        </a>
                        <a href="/jongere/{{$jongere->id}}/{{$many}}/{{$key}}/disconnect" type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Verwijder"></span>
                        </a>
                    </span>&nbsp;
            @endforeach
        </p>
    </div>
</div>


<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-8" style="display:none" id="form_{{$many}}">

        {!! Form::open(['route' => $many.'.store',
        'name'=>'form_'.$many] )!!}
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" style="display:none" id="alert_{{$many}}">
                    Onbekende {{$Many}}
                </span>
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
                        {{ $oneMany->omschrijving }}
                    </option>
                @endforeach
            </select>
        </div>
        {!! Form::close() !!}
    </div>
</div>
