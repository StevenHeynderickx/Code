@extends('staticPages.staticPage')

@section('content')
    <h1>Den Tube: </h1>
    <h3>Jongeren</h3>
    <p>Gebruik familienaam om te zoeken of aan te maken</p>

    {!! Form::open(['route' => 'nationaliteit.store','name'=>'form_name']) !!}
    <div class="form-group">

        <div class="input-group">
            {!! Form::text('entry_field',null,['placeholder'=>'Familienaam','class'=>'form-control','onKeyUp'=>'javascript:obj1.bldUpdate();'])!!}
            <div class="input-group-btn">
                <a href="#" type="button" class="btn btn-default" id="btnAddJongere">
                    <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken" id="btnAdd"></span>
                </a>
                <a href="#" type="button" class="btn btn-default" id="btnEditJongere">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen" id="dsd"></span>
                </a>
                <a href="#" type="button" class="btn btn-default" id="btnDelJongere">
                    <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijderen"></span>
                </a>
                <a href="#" type="button" class="btn btn-default" id="btnShowJongere">
                    <span class="glyphicon glyphicon-search" aria-hidden="false" aria-label="Toon"></span>
                </a>
                <a href="{{route('jongere.index')}}" type="button" class="btn btn-default" id="btnListJongere">
                    <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Alles oplijsten"></span>
                </a>

            </div>
        </div>

        <select name="select_field" size=5 class="form-control" onMouseUp="javascript:obj1.copySelectedToInput();">
            @foreach ($jongeren as $jongere)
                <option value="{{ $jongere->id }}">
                    {{ $jongere->naam }} {{$jongere->voornaam}} {{$jongere->geboortedatum}}
                </option>
            @endforeach
        </select>
    </div>
    {!! Form::close() !!}
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
            this.copySelectedToInput = copySelectedToInput;
        }

        function initialize() {
            document.getElementById('btnDelJongere').style.display = 'none';
            document.getElementById('btnEditJongere').style.display = 'none';
            document.getElementById('btnShowJongere').style.display = 'none';

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
            document.getElementById('btnAddJongere').style.display = 'inline-block';
            for(var i=0;i<this.selectArr.length;i++)
                document.forms[this.formName][this.selectField].options[i] = this.selectArr[i];
            document.forms[this.formName][this.selectField].options.length = this.selectArr.length;
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
            pattern1 = new RegExp(str,"i");
            for(var i=0;i<this.selectArr.length;i++) {
                if (pattern1.test(this.selectArr[i].text)) {
                    document.forms[this.formName][this.selectField].options[j++] = this.selectArr[i];
                }
            }
            document.forms[this.formName][this.selectField].options.length = j;
            // if j=0 then there are no matches... select field can be removed
            if(j==0){
                document.forms[this.formName][this.selectField].style.display = 'none';
                document.getElementById('btnAddJongere').style.display = 'inline-block';
                var newName = document.forms[this.formName][this.enteryField].value;
                document.getElementById('btnAddJongere').setAttribute('href','/jongere/create/'+newName);
            } else {
                document.forms[this.formName][this.selectField].style.display = 'block';

            }
        }
        function setUp() {
            obj1 = new SelObj('form_name','select_field','entry_field');
            //    form_name = the name of the form you use
            // select_field = the name of the select pulldown menu you use
            //  entry_field = the name of text box you use for typing in
            obj1.bldInitial();
        }
        function copySelectedToInput() {
            var e = document.forms[this.formName][this.selectField];
            var selectedId = (e.options[e.selectedIndex].value);
            var selectedName = (e.options[e.selectedIndex].text);

            document.forms[this.formName][this.enteryField].value=selectedName;
            document.forms[this.formName][this.selectField].style.display = 'none';
            document.getElementById('btnAddJongere').style.display = 'none';
            document.getElementById('btnDelJongere').style.display = 'inline-block';
            document.getElementById('btnEditJongere').style.display = 'inline-block';
            document.getElementById('btnShowJongere').style.display = 'inline-block';
            document.getElementById('btnDelJongere').setAttribute('href','/jongere/'+selectedId+'/destroy');
            document.getElementById('btnEditJongere').setAttribute('href','/jongere/'+selectedId+'/edit');
            document.getElementById('btnShowJongere').setAttribute('href','/jongere/'+selectedId);
        }
        window.onload=setUp;
        //  End -->
    </script>
@stop