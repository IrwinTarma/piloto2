<div class="form-group {{ $errors->has('nombres') ? 'has-error' : ''}}">
    {!! Form::label('nombres', 'Nombres', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombres', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombres', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('apellidos') ? 'has-error' : ''}}">
    {!! Form::label('apellidos', 'Apellidos', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('apellidos', null, ['class' => 'form-control']) !!}
        {!! $errors->first('apellidos', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : ''}}">
    {!! Form::label('fecha_nacimiento', 'Fecha Nacimiento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fecha_nacimiento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('telefono', 'Telefono', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
        {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('observaciones') ? 'has-error' : ''}}">
    {!! Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cargo_id') ? 'has-error' : ''}}">
    {!! Form::label('cargo', 'Cargo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('cargo_id', $cargos, $empleado->cargo_id, ['class' => 'form-control']) !!}
        {!! $errors->first('cargo_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>