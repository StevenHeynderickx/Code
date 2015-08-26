<div class="form-group">
    {!! Form::label('naam','Naam:') !!}
    {!! Form::text('naam',$jongere->naam,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('voornaam','Voornaam:') !!}
    {!! Form::text('voornaam',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('geboortedatum','Geboortedatum:') !!}
    {!! Form::input('date','geboortedatum',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('email','Email:') !!}
    {!! Form::text('email',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('facebook','Facebook:') !!}
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon2">https://www.facebook.com/</span>
        {!! Form::text('facebook',null,['class'=>'form-control'])!!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('origine_id','Origine:') !!}
    {!! Form::hidden('origine_id',null) !!}
    <!-- $jongere->origine->omschrijving -->
    {!! Form::text('nationaliteit_omschrijving',$jongere->origine->omschrijving,[
                    'placeholder'=>'Typ origine en selecteer',
                    'class'=>'form-control',
                    'onKeyUp'=>'javascript:obj1.bldUpdate();',
                    'id'=>'nationaliteit_omschrijving'
                    ])
    !!}
    <select name="select_field" size=5 class="form-control" onMouseUp="obj1.copySelectedToInput();">
        @foreach ($nationaliteiten as $key=>$value)
            <option value="{{ $key }}">
                {{ $value }}
            </option>
        @endforeach
    </select>

</div>


<div class="form-group">
    <br \>
    {!! Form::submit($submitButtonText,['class'=>'form-control btn btn-primary','id'=>'btnsubmit']) !!}
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
        this.copySelectedToInput = copySelectedToInput;
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
        pattern1 = new RegExp("^"+str,"i");
        for(var i=0;i<this.selectArr.length;i++) {
            if (pattern1.test(this.selectArr[i].text)) {
                document.forms[this.formName][this.selectField].options[j++] = this.selectArr[i];
            }
        }
        document.forms[this.formName][this.selectField].options.length = j;
        // if j=0 then there are no matches... select field can be removed
        if(j==0){
            document.forms[this.formName][this.selectField].style.display = 'none'
            document.getElementById('btnsubmit').style.display = 'none';
        } else {
            document.forms[this.formName][this.selectField].style.display = 'block';
            document.getElementById('btnsubmit').style.display = 'inline-block';
        }
    }




    function setUp() {
        obj1 = new SelObj('jongereForm','select_field','nationaliteit_omschrijving');
        //    form_name = the name of the form you use
        // select_field = the name of the select pulldown menu you use
        //  entry_field = the name of text box you use for typing in

        obj1.bldInitial();
    }



    function copySelectedToInput() {
        var e = document.forms[this.formName][this.selectField];
        $selectedId = (e.options[e.selectedIndex].value);
        $selectedName = (e.options[e.selectedIndex].text);
        document.forms[this.formName][this.enteryField].value = $selectedName;
        document.getElementById('origine_id').value = $selectedId;
        document.getElementById('nationaliteit_omschrijving').value = $selectedName;
        document.forms[this.formName][this.selectField].style.display = 'none';
    }
    window.onload=setUp;
    //  End -->
</script>