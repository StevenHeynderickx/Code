<div class="form-group">
    {!! Form::label($attribute,$label) !!}
    <div class="input-group">
        {!! Form::text($attribute,null,['class'=>'form-control','onKeyUp'=>'javascript:obj1.bldUpdate();','autocomplete'=>'off'])!!}
        <div class="input-group-btn">
            <a href="/{{$className_String}}" type="button" class="btn btn-primary" id="btnAdd" onclick="document.getElementById('form_name').submit();return false">
                <span class="glyphicon glyphicon-plus" aria-hidden="false" aria-label="Maken"></span>
            </a>
        </div>
    </div>
    <select id="select_field" size=5 class="form-control" onMouseUp="javascript:obj1.copySelectedToInput();">
        @foreach ($classNames as $$className_String)
            <option value="{{ $$className_String->id }}">
                {{ $$className_String->$attribute }}
            </option>
        @endforeach
    </select>
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
        if(document.getElementById('btnSubmit').value!='Pas aan') {
            document.getElementById('btnAdd').style.display = 'inline-block';
        } else {
            document.getElementById('btnAdd').style.display = 'none';

        }
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
            if(document.getElementById('btnSubmit').value!='Pas aan') {
                document.getElementById('btnAdd').style.display = 'inline-block';
            }
            var newValue = document.forms[this.formName][this.enteryField].value;
            //document.getElementById('btnAdd').setAttribute('href','/{{$className_String}}/create/'+newValue);
        } else {
            document.forms[this.formName][this.selectField].style.display = 'block';

        }
    }
    function setUp() {
        obj1 = new SelObj('form_name','select_field','{{$attribute}}','{{$className_String}}');
        //    form_name = the name of the form you use
        // select_field = the name of the select pulldown menu you use
        //  entry_field = the name of text box you use for typing in
        obj1.bldInitial();
    }
    function copySelectedToInput() {
        var e = document.forms[this.formName][this.selectField];
        var selectedName = (e.options[e.selectedIndex].text);
        document.forms[this.formName][this.enteryField].value=selectedName;
        document.forms[this.formName][this.selectField].style.display = 'none';
        document.getElementById('btnAdd').style.display = 'none';
        document.getElementById('btnSubmit').style.display = 'none';
    }
    window.onload=setUp;
    //  End -->
</script>
