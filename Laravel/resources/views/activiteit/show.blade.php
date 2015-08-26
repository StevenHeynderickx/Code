@extends('staticPages.staticPage')

@section('title')
    Activiteit details
@stop


@section('content')
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $activiteit->omschrijving }}</h2>
        </div>
        <div class="col-md-4 text-right hideMeForPrint">
            <h2>&nbsp;
                <div class="btn-group" role="group" aria-label="...">
                    <a href="/activiteit/{{$activiteit->id}}/edit" type="button" class="btn btn-primary" id="btnEdit">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                    </a>
                    <a href="/activiteit" type="button" class="btn btn-primary" id="btnList">
                        <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                        <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                    </a>
                    <a href="/activiteit/{{$activiteit->id}}/destroy" type="button" class="btn btn-danger" id="btnDel">
                        <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                    </a>
                </div>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading hideMeForPrint">
                    <h3 class="panel-title">
                        Activiteitgegevens
                    </h3>
                </div>
                <div class="panel-body">
                    <b>Datum:&nbsp;</b>{{$activiteit->datum}}<br />
                    <b>Maaltijd:&nbsp;</b>{{$activiteit->maaltijd}}<br />
                    <b>Prijs:&nbsp;</b>{{-$activiteit->prijs}}
                </div>
            </div>
            <div class="panel panel-default hideMeForPrint" id="formPanel">
                <div class="panel-heading">
                            <h3 class="panel-title">
                                Voeg een jongere toe aan deze activiteit
                            </h3>
                </div>
                <div class="panel-body">
                    <!-- form -->
                    <div class="row">
                        <div class="col-md-12" id="form_jongere">

                            {!! Form::open(['route' => 'activiteit.connect',
                                             'name' => 'form_jongere',
                                               'id' => 'form_jongere'])
                            !!}
                            <div class="form-group">
                                    {!! Form::text('entry_jongere',null,[
                                        'placeholder' => 'Typ de naam en selecteer',
                                              'class' => 'form-control',
                                            'onKeyUp' => 'javascript:combo1.comboUpdate();',

                                            'onfocus' => 'combo1.toggleSelect(1)',
                                                 'id' => 'entry_jongere'])
                                !!}
                                <select id = "select_jongere" name="select_jongere" size=3 class="form-control" onmouseup="javascript:combo1.copySelectedToInput();">
                                    @foreach ($alleJongeren as $jongere)
                                        <option value="{{ $jongere->id }}">
                                            {{ $jongere->naam }} {{ $jongere->voornaam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Betaald bedrag</span>
                                    {!! Form::text('bedrag',-$activiteit->prijs,[
                                    'class'=>'form-control',
                                    'id' => 'bedrag'])
                                    !!}
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-euro" aria-hidden="false" aria-label="Aanpassen"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('eetmee', 1, $activiteit->maaltijd, ['id' => 'maaltijd']) !!} {!! Form::label('eetmee','Deze persoon eet mee') !!}
                                </label>
                            </div>
                            <div class="formgroup">
                                <br \>
                                {!! Form::hidden('jongereId',null,['id' => 'jongereId'])!!}
                                {!! Form::hidden('activiteitId',$activiteit->id,['id' => 'activiteitId'])!!}
                                {!! Form::submit('Toevoegen',['class'=>'form-control btn btn-primary','id'=>'btnSubmit']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <div class="col-md-6">
            @unless(!$activiteit->getJongeren()->get())
                <div class="panel panel-default">
                    <div class="panel-heading hideMeForPrint">
                        <h3 class="panel-title">
                            Volgende jongeren staan ingeschreven
                        </h3>
                    </div>
                    <div class="panel-body">
                        <!-- table -->
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Naam</th>
                                    <th>Betaalde</th>
                                    <th>Eet mee</th>
                                    <th class="hideMeForPrint">Acties</th>
                                </tr>
                                @foreach ($activiteit->getJongeren()->orderBy('eetmee')->orderBy('naam')->get() as $jongere)
                                    <tr>
                                        <td>
                                            <a href="/jongere/{{$jongere->id}}">{{$jongere->naam}}&nbsp;{{$jongere->voornaam}}</a>
                                        </td>
                                        <td>
                                            {{-$jongere->pivot->bedrag}}
                                        </td>
                                        <td>
                                            <span class="zichtbaar{{$jongere->pivot->eetmee}}">
                                                <span class="glyphicon glyphicon-apple" aria-hidden="false" aria-label="Aanpassen"></span>
                                            </span>
                                            <span class="onzichtbaar{{$jongere->pivot->eetmee}}">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Aanpassen"></span>
                                            </span>
                                        </td>
                                        <td class="hideMeForPrint">
                                            <a href="/activiteit/{{$jongere->pivot->id}}/disconnect/{{$activiteit->id}}" type="button" class="btn btn-default btn-sm">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="false" aria-label="Verwijder"></span>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>
    <style>
        .zichtbaar1,.onzichtbaar0{display:inline}
        .zichtbaar0,.onzichtbaar1{display:none}

    </style>
    <script language="javascript" type="text/javascript">
        /* Visit http://www.yaldex.com/ for full source code
         and get more free JavaScript, CSS and DHTML scripts! */
        <!-- Begin
        function ComboBoxObj(str) {
            this.select_str = str || '';
            this.selectArr = [];
            this.initialize = initialize;
            this.comboInitial = comboInitial;
            this.comboUpdate = comboUpdate;
            this.copySelectedToInput = copySelectedToInput;
            this.toggleSelect = toggleSelect;
        }

        function initialize() {
            // PERFORM IF THE FORM WAS NEVER SETUP
            this.toggleSelect(0);
            toggleBtnSubmit('none');
            if (this.select_str =='') {
                for(var i=0;i<document.getElementById('select_jongere').options.length;i++) {
                    this.selectArr[i] = document.getElementById('select_jongere').options[i];
                    this.select_str +=
                            document.getElementById('select_jongere').options[i].value+":"+
                            document.getElementById('select_jongere').options[i].text+",";
                }
            }
            else {
                var tempArr = this.select_str.split(',');
                for(var i=0;i<tempArr.length;i++) {
                    var prop = tempArr[i].split(':');
                    this.selectArr[i] = new Option(prop[1],prop[0]);
                }
            }
        }

        function comboInitial() {
            this.initialize();
            for(var i=0;i<this.selectArr.length;i++) {
                document.getElementById('select_jongere').options[i] = this.selectArr[i];
            }
            document.getElementById('select_jongere').options.length = this.selectArr.length;
        }

        function comboUpdate() {
            // PERFORM IF USER REMOVES ENTERED DATA (LEAVES EMPTY FIELD)
            if (document.getElementById('entry_jongere').value.length<1){
                toggleBtnSubmit('none');
            }

            var str = document.getElementById('entry_jongere').value.replace('^\\s*','');
            if(str == '') {
                this.comboInitial();
                return;
            }
            this.initialize();
            var j = 0;
            pattern1 = new RegExp(str,"i");
            for(var i=0;i<this.selectArr.length;i++) {
                if (pattern1.test(this.selectArr[i].text)) {
                    document.getElementById('select_jongere').options[j++] = this.selectArr[i];
                }
            }
            document.getElementById('select_jongere').options.length = j;
            // if j=0 then there are no matches... select field can be removed
            // ZERO options left over -> INVALID
            if(j==0){
                toggleBtnSubmit('noOptionLeft');
            }
            // ONE option left over -> AUTOSELECT
            else if(j==1){
                selectedId = document.getElementById('select_jongere').options[0].value;
                selectedName = document.getElementById('select_jongere').options[0].text;
                document.getElementById('jongereId').value = selectedId;
                document.getElementById('entry_jongere').value = selectedName;
                toggleBtnSubmit('ok');
                toggleSelect(0);
            }
            // MANY options left over -> INVALID
            else {
                document.getElementById('select_jongere').style.display = 'block';
                toggleBtnSubmit('tooMany');
            }
        }

        function copySelectedToInput() {
            var e = document.getElementById('select_jongere');
            document.getElementById('entry_jongere').value=e.options[e.selectedIndex].text;
            document.getElementById('select_jongere').style.display = 'none';
            document.getElementById('jongereId').value=e.options[e.selectedIndex].value;
            toggleBtnSubmit('ok');
        }

        function toggleSelect($status) {
            if ($status){
                document.getElementById('select_jongere').style.display = 'inline-block'
            } else {
                document.getElementById('select_jongere').style.display = 'none'}
        }

        function toggleBtnSubmit($status){

            if($status=='ok'){
                document.getElementById('btnSubmit').style.display = 'block';
            } else {
                document.getElementById('btnSubmit').style.display = 'none';            }
        }

        function setUp() {
            combo1 = new ComboBoxObj();
            combo1.comboInitial();
        }
        window.onload=setUp;

    </script>

@stop
