<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    
    <div class="col-md-6">
    	{!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('estado', 'Estado') !!}
        {!! Form::select('estado', [0 => 'Inactivo', 1 => 'Activo'], $color->estado, ['class' => 'form-control', 'id' => 'estado', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>