@extends('staticPages.staticPage')

@section('content')

    <div class="container">
        <!-- Titel -->
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-right" style="padding-right:10px;">{{$jongere->naam}}
                    <small>
                        {{$jongere->voornaam}}
                    </small>
                </h2>
            </div>
            <div class="col-md-8">
                <h2>
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="/jongere/{{$jongere->id}}/edit" type="button" class="btn btn-primary btn-sm" id="btnEdit">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="false" aria-label="Aanpassen"></span>
                        </a>
                        <a href="/jongere" type="button" class="btn btn-primary btn-sm" id="btnList">
                            <span class="glyphicon glyphicon-list-alt" aria-hidden="false" aria-label="Lijst"></span>
                            <span class="glyphicon glyphicon-arrow-up" aria-hidden="false" aria-label="Lijst"></span>
                        </a>
                        <a href="/jongere/{{$jongere->id}}/destroy" type="button" class="btn btn-danger btn-sm" id="btnList">
                            <span class="glyphicon glyphicon-trash" aria-hidden="false" aria-label="Verwijder"></span>
                        </a>
                    </div>
                </h2>
            </div>
        </div>
        <!-- One to one properties -->
        <div class="row">
            <div class="col-md-4">
                <p class="text-right" style="padding-right:10px;">Geboortedatum:</p>
            </div>
            <div class="col-md-8">
                <p class="text-left">{{$jongere->geboortedatum}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p class="text-right" style="padding-right:10px;">Email:</p>
            </div>
            <div class="col-md-8">
                <p class="text-left"><a href="mailto:{{$jongere->email}}">{{$jongere->email}}</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p class="text-right" style="padding-right:10px;">Facebook:</p>
            </div>
            <div class="col-md-8">
                <p class="text-left"><a href="https://www.facebook.com/{{$jongere->facebook}}">https://www.facebook.com/{{$jongere->facebook}}</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <p class="text-right" style="padding-right:10px;">Origine:</p>
            </div>
            <div class="col-md-8">

                <p class="text-left">{{$jongere->origine->omschrijving}}</p>

            </div>
        </div>


    <!-- Many to Many properties -->
    @include ('jongere.addMany',   [
                    'Many'=>'Nationaliteit',
                    'many'=>'nationaliteit',
                    'nr'=>'1',
                    'allManys'=>$alleNationaliteiten,
                    'manys'=>$nationaliteiten])
    @include ('jongere.addMany',   [
                    'Many'=>'Taal',
                    'many'=>'taal',
                    'nr'=>'2',
                    'allManys'=>$alleTalen,
                    'manys'=>$talen])
    @include ('jongere.addMany',   [
                    'Many'=>'Extrainfo',
                    'many'=>'extrainfo',
                    'nr'=>'3',
                    'allManys'=>$alleExtrainfos,
                    'manys'=>$extrainfos])
    @include ('jongere.addMany',   [
                    'Many'=>'Groep',
                    'many'=>'groep',
                    'nr'=>'4',
                    'allManys'=>$alleGroepen,
                    'manys'=>$groepen])
    @include('jongere.showAdressen')
    @include('jongere.showHuisartsen',   [
                    'Many'=>'Huisarts',
                    'many'=>'huisarts',
                    'nr'=>'5',
                    'allManys'=>$alleHuisartsen,
                    'manys'=>$huisartsen])
    @include('jongere.showOuders',   [
                    'Many'=>'Ouder',
                    'many'=>'ouder',
                    'nr'=>'6',
                    'allManys'=>$alleOuders,
                    'manys'=>$ouders])

    <!-- One to Many properties -->
    </div>
    <div class="container">
        @unless(!$activiteiten)
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Volgende Activiteiten en Stortingen bestaan
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                @unless($jongere->getActiviteit()->orderBy('datum')->get()->count()==0)
                                    <tr>
                                        <th>Ingeschreven voor volgende activiteiten</th>
                                        <th class="text-center">Datum</th>
                                        <th class="text-center">Bedrag</th>
                                    </tr>
                                    @foreach ($jongere->getActiviteit()->orderBy('datum')->get() as $activiteit)
                                        <tr>
                                            <td>
                                                <a href="/activiteit/{{$activiteit->id}}">{{$activiteit->omschrijving}}</a>
                                            </td>
                                            <td class="text-center">
                                                {{$activiteit->datum}}
                                            </td>
                                            <td class="text-center">
                                                {{abs($activiteit->pivot->bedrag)}}/{{-$activiteit->prijs}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endunless
                                @unless($jongere->getStorting()->orderBy('datum')->get()->count()==0)
                                    <tr>
                                        <th>Volgende stortingen werden geboekt</th>
                                        <th class="text-center">Datum</th>
                                        <th class="text-center">Bedrag</th>
                                    </tr>
                                    @foreach ($jongere->getStorting()->orderBy('datum')->get() as $activiteit)
                                        <tr>
                                            <td>
                                                <a href="/storting/{{$activiteit->id}}">{{$activiteit->omschrijving}}</a>
                                            </td>
                                            <td class="text-center">
                                                {{$activiteit->datum}}
                                            </td>
                                            <td class="text-center">
                                                {{abs($activiteit->pivot->bedrag)}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endunless
                                <tr>
                                    <td></td>
                                    <th class="text-right">Saldo</th>
                                    <th class="text-center">{{
                                $jongere->getSaldo()
                                }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endunless
    </div>
    <script language="javascript" type="text/javascript">
        /* Visit http://www.yaldex.com/ for full source code
         and get more free JavaScript, CSS and DHTML scripts! */
        <!-- Begin
        function ComboBoxObj(many,one,str) {
            this.formName       = 'form_' + many;
            this.selectField    = 'select_' + many;
            this.entryField     = 'entry_' + many;
            this.many           = many;
            this.className      = one;
            this.select_str = str || '';
            this.selectArr = [];
            this.initialize = initialize;
            this.comboInitial = comboInitial;
            this.comboUpdate = comboUpdate;
            this.copySelectedToInput = copySelectedToInput;
            this.btnAddClicked  = btnAddClicked;
        }

        function initialize() {
            // PERFORM IF THE FORM WAS NEVER SETUP
            if (this.select_str =='') {
                for(var i=0;i<document.forms[this.formName][this.selectField].options.length;i++) {
                    this.selectArr[i] = document.forms[this.formName][this.selectField].options[i];
                    this.select_str +=
                            document.forms[this.formName][this.selectField].options[i].value+":"+
                            document.forms[this.formName][this.selectField].options[i].text+",";
                    toggleBtnAdd('empty',this.many);
                    document.getElementById(this.formName).style.display = 'none';
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
                document.forms[this.formName][this.selectField].options[i] = this.selectArr[i];
            }
            document.forms[this.formName][this.selectField].options.length = this.selectArr.length;
        }

        function comboUpdate() {
            // PERFORM IF USER REMOVES ENTERED DATA (LEAVES EMPTY FIELD)
            if (document.forms[this.formName][this.entryField].value.length<1){
                toggleBtnAdd('empty',this.many);
            }

            var str = document.forms[this.formName][this.entryField].value.replace('^\\s*','');
            if(str == '') {
                this.comboInitial();
                return;
            }
            this.initialize();
            var j = 0;
            pattern1 = new RegExp("^"+str,"i");
            for(var i=0;i<this.selectArr.length;i++) {
                if (pattern1.test(this.selectArr[i].text)) {
                    document.forms[this.formName][this.selectField].options[j++] = this.selectArr[i];

                }
            }
            document.forms[this.formName][this.selectField].options.length = j;
            // if j=0 then there are no matches... select field can be removed
            // ZERO options left over -> INVALID
            if(j==0){
                document.forms[this.formName][this.selectField].style.display = 'none';
                document.getElementById('btnAdd_' + this.many).setAttribute('href','#');
                toggleBtnAdd('wrong',this.many);
            }
            // ONE option left over -> AUTOSELECT
            else if(j==1){
                // selectedName = document.forms[this.formName][this.selectField].options[0].text;
                // document.forms[this.formName][this.entryField].value=selectedName;
                // document.forms[this.formName][this.selectField].style.display = 'none';
                // SET BTN LINK FOR ENTRY FIELD TO CREATE OPTION
                selectedId = document.forms[this.formName][this.selectField].options[0].value;
                $link = '/' + this.className + '/' + {{$jongere->id}} + '/'+this.many+'/'+selectedId;
                document.getElementById('btnAdd_'+this.many).setAttribute('href',$link);
                toggleBtnAdd('ok',this.many);
            }
            // MANY options left over -> INVALID
            else {
                document.forms[this.formName][this.selectField].style.display = 'block';
                toggleBtnAdd('many',this.many);
            }
        }
        function toggleBtnAdd($status,$name){

            if($status=='ok'){
                document.getElementById('alert_' + $name).style.display = 'none';
                document.getElementById('btnAdd_' + $name).setAttribute('class','btn btn-default');
                document.getElementById('glyphiconAdd_' + $name).setAttribute('class','glyphicon glyphicon-plus');
            } else if ($status=='wrong'){
                document.getElementById('alert_' + $name).style.display = 'table-cell';
                document.getElementById('btnAdd_' + $name).setAttribute('class','btn btn-danger');
                document.getElementById('glyphiconAdd_' + $name).setAttribute('class','glyphicon glyphicon-remove');
            } else {
                document.getElementById('alert_' + $name).style.display = 'none';
                document.getElementById('btnAdd_' + $name).setAttribute('class','btn btn-danger');
                document.getElementById('glyphiconAdd_' + $name).setAttribute('class','glyphicon glyphicon-remove');
            }
        }

        function btnAddClicked(){
            // CHECK STATUS OF BUTTON (btnAdd_...)
            // IN CASE OF ALERT
            if(document.getElementById('btnAdd_' + this.many).classList[1]=='btn-danger') {
                // CLEAR AND HIDE HELPERFORM
                // TOGGLE BTN TO NORMAL
                toggleBtnAdd('ok',this.many);
                // CLEAR ENTERED TEXT BY USER
                document.forms[this.formName][this.entryField].value = '';
                // SHOW BLUE BUTTON (btn_show_extrainfo_form) AGAIN
                document.getElementById('btn_show_' + this.many + '_form').style.visibility = 'visible';
                // RESET BTN LINK FOR ENTRY FIELD
                document.getElementById('btnAdd_' + this.many).setAttribute('href', '#');
                document.getElementById(this.formName).style.display = 'none';
            } else {
                //document.getElementById('btnAdd_' + this.many).setAttribute('href', '#');
                document.getElementById(this.formName).style.display = 'none';
                return true;
            }
        }

        function copySelectedToInput() {
            var e = document.forms[this.formName][this.selectField];
            var selectedId = (e.options[e.selectedIndex].value);
            var selectedName = (e.options[e.selectedIndex].text);

            document.forms[this.formName][this.entryField].value=selectedName;
            document.forms[this.formName][this.selectField].style.display = 'none';
            // SET BTN LINK FOR ENTRY FIELD TO CREATE OPTION
            $link = '/' + this.className + '/' + {{$jongere->id}} + '/'+this.many+'/'+selectedId;
            document.getElementById('btnAdd_'+this.many).setAttribute('href',$link);
            toggleBtnAdd('ok',this.many);
        }

        function setUp() {
            combo1 = new ComboBoxObj('nationaliteit','jongere');
            combo1.comboInitial();
            combo2 = new ComboBoxObj('taal','jongere');
            combo2.comboInitial();
            combo3 = new ComboBoxObj('extrainfo','jongere');
            combo3.comboInitial();
            combo4 = new ComboBoxObj('groep','jongere');
            combo4.comboInitial();
            combo5 = new ComboBoxObj('huisarts','jongere');
            combo5.comboInitial();
        }
        window.onload=setUp;
    </script>
@stop