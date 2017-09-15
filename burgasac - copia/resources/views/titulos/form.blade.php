<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('materia_prima') ? 'has-error' : ''}}">
    {!! Form::label('materia_prima', 'Materia Prima', ['class' => 'col-md-4 fillable control-label']) !!}
    <div class="col-md-6">
        <select name="materia_prima" class="fillable form-control">
            <option value="accesorio" <?php if (isset($titulo)) echo ($titulo->materia_prima == 'accesorio')? 'selected' : '' ?>>Accesorio</option>
            <option value="insumo" <?php if (isset($titulo)) echo ($titulo->materia_prima == 'insumo')? 'selected' : '' ?>>Insumo</option>
        </select>
        {!! $errors->first('marca_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>