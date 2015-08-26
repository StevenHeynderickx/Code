<div class="form-group">
    {!! Form::label('naam','Naam') !!}
    {!! Form::text('naam', $huisartsDTO->getNaam(), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('voornaam','Voornaam') !!}
    {!! Form::text('voornaam', $huisartsDTO->getVoornaam(), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('url','Website voor info') !!}
    {!! Form::text('url', $huisartsDTO->getUrl(), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('contactnummer','Telefoonnummer') !!}
    {!! Form::text('contactnummer', $huisartsDTO->getContactnummer(), ['class' => 'form-control']) !!}
</div>
<div class="form-group">
        {!! Form::label('Adres','Straat') !!}
        <div class="row">
            <div class="col-md-8">
                {!! Form::text('straat_entry',$huisartsDTO->getStraatEntry(),['class'=>'form-control','onKeyUp'=>'straatObj.bldUpdate()'])!!}
                <select id="straat_select_field" size=5 class="form-control" onMouseUp="straatObj.copySelectedStraatToInput()">
                    @foreach ($straten as $straat)
                        <option value="{{ $straat->id }}">
                            {{ $straat->straatnaam }}
                        </option>
                    @endforeach
                </select>
                {!! Form::hidden('straat_id', $huisartsDTO->getStraatId(), ['id' => 'straat_id']) !!}
                {!! Form::hidden('jongere_id', $huisartsDTO->getJongereId(), ['id' => 'jongere_id']) !!}
                {!! Form::hidden('huisarts_id', $huisartsDTO->getId(), ['id' => 'huisarts_id']) !!}

            </div>
            <div class="col-md-2">

                    {!! Form::text('nummer', $huisartsDTO->getNummer(), ['class' => 'form-control' , 'placeholder' => 'nummer']) !!}

            </div>
            <div class="col-md-2">

                    {!! Form::text('bus', $huisartsDTO->getBus(), ['class' => 'form-control' , 'placeholder' => 'bus']) !!}

            </div>
        </div>

</div>



<div class="form-group">
    {!! Form::label('gemeente','Gemeente:') !!}
    {!! Form::text('gemeente_entry', $huisartsDTO->getGemeenteEntry(), ['class' => 'form-control','onKeyUp'=>'gemeenteObj.bldUpdate()']) !!}
    <select id="gemeente_select_field" size=5 class="form-control" onMouseUp="gemeenteObj.copySelectedGemeenteToInput()">
        @foreach ($gemeenten as $gemeente)
            <option value="{{ $gemeente->id }}">
                {{ $gemeente->postcode }} {{$gemeente->gemeente}}
            </option>
        @endforeach
    </select>
    {!! Form::hidden('gemeente_id', $huisartsDTO->getGemeenteId(), ['class' => 'form-control','id' => 'gemeente_id']) !!}

</div>


<div class="from-group">
    <br \>
    {!! Form::submit($submitButtonText,['class'=>'form-control btn btn-primary','id'=>'btnSubmit']) !!}
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
        this.copySelectedStraatToInput = copySelectedStraatToInput;
        this.copySelectedGemeenteToInput = copySelectedGemeenteToInput;
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
        document.getElementById('straat_id').value='';
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
        straatObj = new SelObj('form_name','straat_select_field','straat_entry');
        straatObj.bldInitial();

        gemeenteObj = new SelObj('form_name','gemeente_select_field','gemeente_entry');
        gemeenteObj.bldInitial();
        alert('gemeenteObj created');
    }
    function copySelectedToInput() {
        var e = document.forms[this.formName][this.selectField];
        var selectedId = (e.options[e.selectedIndex].value);
        var selectedName = (e.options[e.selectedIndex].text);

        document.forms[this.formName][this.enteryField].value=selectedName;
        document.forms[this.formName][this.selectField].style.display = 'none';
        return selectedId;
    }
    function copySelectedStraatToInput() {
        document.getElementById('straat_id').value=this.copySelectedToInput();
    }
    function copySelectedGemeenteToInput() {
        document.getElementById('gemeente_id').value=this.copySelectedToInput();
    }
    window.onload=setUp;
    //  End -->
</script>
