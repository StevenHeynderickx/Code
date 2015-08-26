@extends('staticPages.staticPage')

@section('content')
    <h2><small>Bewerk gegevens ouder&nbsp;<a href="/ouder/{{$ouder->id}}">{{$ouder->naam}} {{$ouder->voornaam}}</a></small></h2>
    {!! Form::model($ouder,['method'=>'PATCH','action' => 'OuderController@update','name'=>'form_name']) !!}
    <div class="form-group">
        {!! Form::label('naam','Naam') !!}
        {!! Form::text('naam', $ouder->naam,['class' => 'form-control','onKeyUp'=>'naamObj.bldNameUpdate()']) !!}
        <select id="naam_select_field" size=5 class="form-control" onMouseUp="naamObj.copySelectedNaamToInput()">
            @foreach ($ouders as $ouderx)
                <option value="{{ $ouderx->id }}">
                    {{ $ouderx->naam }}&nbsp;{{$ouderx->voornaam}}
                </option>
            @endforeach
        </select>

    </div>


    <div class="form-group" id="formVoornaamField">
        {!! Form::label('voornaam','Voornaam') !!}
        {!! Form::text('voornaam', $ouder->voornaam, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group" id="formOrigineField">
        {!! Form::label('origine','Origine') !!}
        <div class="row">
            <div class="col-md-8">

                {!! Form::text('origine_entry',$ouder->origine->omschrijving,['class'=>'form-control','onKeyUp'=>'origineObj.bldUpdate()'])!!}
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

    <div class="from-group">
        <br \>
        {!! Form::hidden('origine_id', $ouder->origine_id, ['id' => 'origine_id']) !!}
        {!! Form::hidden('ouder_id'  , $ouder->id     , ['id' => 'ouder_id']) !!}

        {!! Form::submit('Pas aan',['class'=>'form-control btn btn-primary','id'=>'btnSubmit']) !!}
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
            naamObj = new SelObj('form_name','naam_select_field','naam');
            naamObj.bldInitial();

            origineObj = new SelObj('form_name','origine_select_field','origine_entry');
            origineObj.bldInitial();
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

        window.onload=setUp;
        //  End -->
    </script>
    {!! Form::close() !!}
    @include ('errors.list')
@stop