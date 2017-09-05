<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    
    <div class="col-md-6">
    	{!! Form::label('nombre', 'Nombre') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-6">
        {!! Form::label('estado', 'Estado') !!}
        {!! Form::select('estado', [0 => 'Inactivo', 1 => 'Activo'], $cargo->estado, ['class' => 'form-control', 'id' => 'estado', 'required' => 'required']) !!}
    </div>
    <div class="col-md-12">
        {!! Form::label('descripcion', 'Descripción') !!}
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>