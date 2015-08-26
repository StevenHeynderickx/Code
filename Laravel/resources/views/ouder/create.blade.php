@extends('staticPages.staticPage')

@section('content')
    <h1><small>Gegevens nieuwe ouder</small></h1>
    {!! Form::open(['route' => 'ouder.store','name'=>'form_name']) !!}
    <div class="form-group">
        {!! Form::label('naam','Naam') !!}
        {!! Form::text('naam', $ouderDTO->getNaam(),['class' => 'form-control','onKeyUp'=>'naamObj.bldNameUpdate()']) !!}
        <select id="naam_select_field" size=5 class="form-control" onMouseUp="naamObj.copySelectedNaamToInput()">
            @foreach ($ouders as $ouder)
                <option value="{{ $ouder->id }}">
                    {{ $ouder->naam }}&nbsp;{{$ouder->voornaam}}
                </option>
            @endforeach
        </select>

    </div>


    <div class="form-group" id="formVoornaamField">
        {!! Form::label('voornaam','Voornaam') !!}
        {!! Form::text('voornaam', $ouderDTO->getVoornaam(), ['class' => 'form-control']) !!}
    </div>

    <div class="form-group" id="formOrigineField">
        {!! Form::label('origine','Origine') !!}
        <div class="row">
            <div class="col-md-8">
                {!! Form::text('origine_entry',$ouderDTO->getOrigineEntry(),['class'=>'form-control','onKeyUp'=>'origineObj.bldUpdate()'])!!}
                <select id="origine_select_field" size=5 class="form-control" onMouseUp="origineObj.copySelectedOrigineToInput()">
                    @foreach ($nationaliteiten as $origine)
                        <option value="{{ $origine->id }}">
                            {{ $origine->omschrijving }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('naamJongere','Deze ouder heeft met '.$ouderDTO->getJongereEntry()) !!}
    </div>

    <div class="form-group" id="formRelatieField">
        {!! Form::label('relatie','een relatie :') !!}
        {!! Form::text('relatie_entry', $ouderDTO->getRelatieEntry(), ['class' => 'form-control','onKeyUp'=>'relatieObj.bldUpdate()']) !!}
        <select id="relatie_select_field" size=5 class="form-control" onMouseUp="relatieObj.copySelectedRelatieToInput()">
            @foreach ($relaties as $relatie)
                <option value="{{ $relatie->id }}">
                    {{ $relatie->omschrijving }}
                </option>
            @endforeach
        </select>
    </div>


    <div class="from-group">
        <br \>
        {!! Form::hidden('origine_id', $ouderDTO->getOrigineId(), ['id' => 'origine_id']) !!}
        {!! Form::hidden('relatie_id', $ouderDTO->getRelatieId(), ['id' => 'relatie_id']) !!}
        {!! Form::hidden('jongere_id', $ouderDTO->getJongereId(), ['id' => 'jongere_id','value'=>$ouderDTO->getJongereId()]) !!}
        {!! Form::hidden('ouder_id'  , $ouderDTO->getId()       , ['id' => 'ouder_id']) !!}

        {!! Form::submit('Maak',['class'=>'form-control btn btn-primary','id'=>'btnSubmit']) !!}
    </div>

    <script language="javascript" type="text/javascript">
        /* Visit http://www.yaldex.com/ for full source code
         and get more free JavaScript, CSS and DHTML scripts! */
        <!-- Begin
        function SelObj(formName,selectField,entryField,str) {
            this.formName = formName;
            this.selectField = selectField;
            this.enteryField = entryField;
            this.select_str = str || '';
            this.selectArr = new Array();
            this.initialize = initialize;
            this.bldInitial = bldInitial;
            this.bldUpdate = bldUpdate;
            this.bldNameUpdate = bldNameUpdate;
            this.copySelectedToInput = copySelectedToInput;
            this.copySelectedNaamToInput = copySelectedNaamToInput;
            this.copySelectedOrigineToInput = copySelectedOrigineToInput;
            this.copySelectedRelatieToInput = copySelectedRelatieToInput;
        }

        function initialize() {

            if (this.select_str =='') {
                for(var i=0;i<document.forms[this.formName][this.selectField].options.length;i++) {
                    this.selectArr[i] = document.forms[this.formName][this.selectField].options[i];
                    this.select_str += document.forms[this.formName][this.selectField].options[i].value+":"+
                            document.forms[this.formName][this.selectField].options[i].text+",";
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
        function bldInitial() {
            this.initialize();
            document.forms[this.formName][this.selectField].style.display = 'none';
            for(var i=0;i<this.selectArr.length;i++)
                document.forms[this.formName][this.selectField].options[i] = this.selectArr[i];
            document.forms[this.formName][this.selectField].options.length = this.selectArr.length;

        }

        function bldNameUpdate() {
            var str = document.forms[this.formName][this.enteryField].value.replace('^\\s*','');
            if(str == '') {
                this.bldInitial();
                document.getElementById('formVoornaamField').style.display='none';
                document.getElementById('formOrigineField').style.display='none';
                return;
            }
            document.forms[this.formName][this.selectField].style.display = 'block';
            this.initialize();
            // j = the amount of matches
            var j = 0;
            var pattern1 = new RegExp(str,"i");
            for(var i=0;i<this.selectArr.length;i++) {
                if (pattern1.test(this.selectArr[i].text)) {
                    document.forms[this.formName][this.selectField].options[j++] = this.selectArr[i];
                }
            }
            document.forms[this.formName][this.selectField].options.length = j;
            // if j=0 then there are no matches... select field can be removed
            if(j==0){
                document.forms[this.formName][this.selectField].style.display = 'none';
                document.getElementById('formVoornaamField').style.display='block';
                document.getElementById('formOrigineField').style.display='block';

            } else {
                document.forms[this.formName][this.selectField].style.display = 'block';
                document.getElementById('formVoornaamField').style.display='none';
                document.getElementById('formOrigineField').style.display='none';
            }
        }
        function bldUpdate() {
            var str = document.forms[this.formName][this.enteryField].value.replace('^\\s*','');
            if(str == '') {
                this.bldInitial();
                return;
            }
            document.forms[this.formName][this.selectField].style.display = 'block';
            this.initialize();
            // j = the amount of matches
            var j = 0;
            var pattern1 = new RegExp(str,"i");
            for(var i=0;i<this.selectArr.length;i++) {
                if (pattern1.test(this.selectArr[i].text)) {
                    document.forms[this.formName][this.selectField].options[j++] = this.selectArr[i];
                }
            }
            document.forms[this.formName][this.selectField].options.length = j;
            // if j=0 then there are no matches... select field can be removed
            if(j==0){
                document.forms[this.formName][this.selectField].style.display = 'none';

            } else {
                document.forms[this.formName][this.selectField].style.display = 'block';
            }
        }
        function setUp() {

            document.getElementById('formVoornaamField').style.display = 'none';
            document.getElementById('formOrigineField').style.display = 'none';
            document.getElementById('ouder_id').value = '';
            document.getElementById('origine_id').value = '';
            document.getElementById('relatie_id').value = '';



            naamObj = new SelObj('form_name','naam_select_field','naam');
            naamObj.bldInitial();

            origineObj = new SelObj('form_name','origine_select_field','origine_entry');
            origineObj.bldInitial();

            relatieObj = new SelObj('form_name','relatie_select_field','relatie_entry');
            relatieObj.bldInitial();


        }
        function copySelectedToInput() {
            var e = document.forms[this.formName][this.selectField];
            var selectedId = (e.options[e.selectedIndex].value);
            var selectedName = (e.options[e.selectedIndex].text);

            document.forms[this.formName][this.enteryField].value=selectedName;
            document.forms[this.formName][this.selectField].style.display = 'none';
            return selectedId;
        }
        function copySelectedNaamToInput() {
            document.getElementById('ouder_id').value = this.copySelectedToInput();
        }

        function copySelectedOrigineToInput() {
            document.getElementById('origine_id').value=this.copySelectedToInput();
        }

        function copySelectedRelatieToInput() {
            document.getElementById('relatie_id').value=this.copySelectedToInput();
        }
        window.onload=setUp;
        //  End -->
    </script>

    {!! Form::close() !!}
    @include('errors.list')
@stop