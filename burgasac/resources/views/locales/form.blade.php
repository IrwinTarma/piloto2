<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
    {!! Form::label('direccion', 'Direccion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('telefono', 'Telefono', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
        {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ciudad') ? 'has-error' : ''}}">
    {!! Form::label('ciudad', 'Ciudad', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('ciudad', ['Lima', ' Arequipa', ' Cusco'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('ciudad', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('distrito') ? 'has-error' : ''}}">
    {!! Form::label('distrito', 'Distrito', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('distrito', ['Jesus Maria', 'Miraflores', ' Barranco'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('distrito', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('observaciones') ? 'has-error' : ''}}">
    {!! Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>