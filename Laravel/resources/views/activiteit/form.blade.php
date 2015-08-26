<div class="form-group">
    {!! Form::label('omschrijving','Omschrijving van de activiteit') !!}
    {!! Form::text('omschrijving',null,['class'=>'form-control','id' => 'omschrijving'])!!}
</div>

<div class="form-group">
    {!! Form::label('datum','Datum van de activiteit:') !!}
    {!! Form::input('date','datum',null,['class'=>'form-control','id' => 'datum'])!!}
</div>


<div class="form-group">
    {!! Form::label('prijs','Prijs:') !!}
    {!! Form::text('prijs',null,['class'=>'form-control','id' => 'prijs']) !!}
</div>

<div class="checkbox">
    <label>
        {!! Form::checkbox('maaltijd', 1, null, ['id' => 'maaltijd']) !!} {!! Form::label('maaltijd','Dit is een activiteit met maaltijd ') !!}
    </label>
</div>


<div class="fromgroup">
    <br \>
    {!! Form::submit($submitButtonText,['class'=>'form-control btn btn-primary','id'=>'btnSubmit']) !!}
</div>
