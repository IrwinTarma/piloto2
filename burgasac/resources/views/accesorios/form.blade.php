<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('titulo_id') ? 'has-error' : ''}}">
    {!! Form::label('titulo_id', 'Titulo', ['class' => 'col-md-4 fillable control-label']) !!}
    <div class="col-md-6">
        <select name="titulo_id" class="fillable form-control">
            <?php foreach ($titulos as $titulo) : ?>
                <option value="<?php echo $titulo->id ?>" <?php if (isset($accesorio)) echo ($titulo->id == $accesorio->titulo_id)? 'selected' : '' ?>><?php echo $titulo->nombre ?></option>
            <?php endforeach ?>
        </select>
        {!! $errors->first('marca_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('proveedor_id') ? 'has-error' : ''}}">
    {!! Form::label('proveedor_id', 'Proveedor', ['class' => 'col-md-4 fillable control-label']) !!}
    <div class="col-md-6">
        <select name="proveedor_id" class="fillable form-control">
            <?php foreach ($proveedores as $proveedor) : ?>
                <option value="<?php echo $proveedor->id ?>" <?php if (isset($accesorio)) echo ($proveedor->id == $accesorio->proveedor_id)? 'selected' : '' ?>><?php echo $proveedor->nombre_comercial ?></option>
            <?php endforeach ?>
        </select>
        {!! $errors->first('proveedor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>