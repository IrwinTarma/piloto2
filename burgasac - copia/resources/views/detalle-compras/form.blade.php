<div class="form-group {{ $errors->has('lote') ? 'has-error' : ''}}">
    {!! Form::label('lote', 'Lote', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('lote', null, ['class' => 'form-control']) !!}
        {!! $errors->first('lote', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tipo_insumo') ? 'has-error' : ''}}">
    {!! Form::label('tipo_insumo', 'Tipo Insumo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tipo_insumo', null, ['class' => 'form-control']) !!}
        {!! $errors->first('tipo_insumo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
    {!! Form::label('tipo', 'Tipo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
        {!! $errors->first('tipo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nro_guia') ? 'has-error' : ''}}">
    {!! Form::label('nro_guia', 'Nro Guia', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nro_guia', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nro_guia', '<p class="help-block">:message</p>') !!}
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
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>