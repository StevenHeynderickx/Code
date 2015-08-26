<div class="form-group">
    {!! Form::label('gemeente','Naam van de gemeente') !!}
    <div class="input-group">
        {!! Form::text('gemeente',null,['class'=>'form-control','onKeyUp'=>'javascript:obj1.bldUpdate();'])!!}
        <div class="input-group-btn">
            <a href="#" type="button" class="btn btn-default" id="btnEdit">
                <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
            </a>
            <a href="#" type="button" class="btn btn-default" id="btnDel">
                <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijderen"></span>
            </a>
            <a href="#" type="button" class="btn btn-default" id="btnShow">
                <span class="glyphicon glyphicon-search" aria-hidden="false" aria-label="Toon"></span>
            </a>
            <a href="{{route('gemeente.index')}}" type="button" class="btn btn-default" id="btnList">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Alles oplijsten"></span>
                <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Alles oplijsten"></span>
            </a>

        </div>
    </div>

    <select id="select_field" size=5 class="form-control" onMouseUp="javascript:obj1.copySelectedToInput();">
        @foreach ($gemeenten as $gemeente)
            <option value="{{ $gemeente->id }}">
                {{ $gemeente->postcode }} {{ $gemeente->gemeente }}
            </option>
        @endforeach
    </select>

</div>

<div class="form-group">
    {!! Form::label('postcode','Postcode:') !!}
    {!! Form::text('postcode',null,['class'=>'form-control']) !!}
</div>


<div class="fromgroup">
    <br \>
    {!! Form::submit($submitButtonText,['class'=>'form-control btn btn-primary','id'=>'btnSubmit']) !!}
</div>

<script language="javascript" type="text/javascript">
    /* Visit http://www.yaldex.com/ for full source code
     and get more free JavaScript, CSS and DHTML scripts! */
    <!-- Begin
    function SelObj(formName,selectField,entryField,className,str) {
        this.formName = formName;
        this.selectField = selectField;
        this.enteryField = entryField;
        this.select_str = str || '';
        this.selectArr = new Array();
        this.initialize = initialize;
        this.bldInitial = bldInitial;
        this.bldUpdate = bldUpdate;
        this.copySelectedToInput = copySelectedToInput;
        this.className = className;
    }

    function initialize() {
        document.getElementById('btnDel').style.display = 'none';
        document.getElementById('btnEdit').style.display = 'none';
        document.getElementById('btnShow').style.display = 'none';

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
            //document.getElementById('btnSubmit').style.display = 'block';
        } else {
            document.forms[this.formName][this.selectField].style.display = 'block';

        }
    }
    function setUp() {
        obj1 = new SelObj('form_name','select_field','gemeente','gemeente');
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
        document.getElementById('btnSubmit').style.display = 'none';
        document.getElementById('btnDel').style.display = 'inline-block';
        document.getElementById('btnEdit').style.display = 'inline-block';
        document.getElementById('btnShow').style.display = 'inline-block';
        document.getElementById('btnDel').setAttribute('href','/'+this.className+'/'+selectedId+'/destroy');
        document.getElementById('btnEdit').setAttribute('href','/'+this.className+'/'+selectedId+'/edit');
        document.getElementById('btnShow').setAttribute('href','/'+this.className+'/'+selectedId);
    }
    window.onload=setUp;
    //  End -->
</script>
