<div class="row">
    <div class="input-field col s8 offset-s2">
        {!! Form::text('name', null, ['id'=>'txtName']) !!}
        {!! Form::label('txtName','Nombre') !!}
        <span class="" id="helName" data-error="wrong" data-success="right"></span>
    </div>
</div>
<div class="row">
    <div class="input-field col s8 offset-s2" id="txtDescr">
        {!! Form::text('description', null, ['id'=>'txtDescription']) !!}
        {!! Form::label('txtDescription','Descripción') !!}
        <span class="helper-text red-text text-darken-2" id="helDescri" data-error="wrong" data-success="right"></span>
    </div>
</div>
<div class="row center-align col s8 offset-s2">
    {!! Form::button('Enviar', ['class' => 'waves-effect waves-light btn cyan darken-3',  'type' => 'submit']) !!}
</div>
