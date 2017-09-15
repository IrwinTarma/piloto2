<div class="form-group {{ $errors->has('nombre_generico') ? 'has-error' : ''}}">
    {!! Form::label('nombre_generico', 'Nombre Generico', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_generico', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_generico', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('nombre_especifico') ? 'has-error' : ''}}">
    {!! Form::label('nombre_especifico', 'Nombre Especifico', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_especifico', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_especifico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('material') ? 'has-error' : ''}}">
    {!! Form::label('material', 'Material', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('material', null, ['class' => 'form-control']) !!}
        {!! $errors->first('material', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('titulo_id') ? 'has-error' : ''}}">
    {!! Form::label('titulo_id', 'Titulo', ['class' => 'col-md-4 fillable control-label']) !!}
    <div class="col-md-6">
        <select name="titulo_id" class="fillable form-control">
            <?php foreach ($titulos as $titulo) : ?>
                <option value="<?php echo $titulo->id ?>" <?php if (isset($insumo)) echo ($titulo->id == $insumo->titulo_id)? 'selected' : '' ?>><?php echo $titulo->nombre ?></option>
            <?php endforeach ?>
        </select>
        {!! $errors->first('marca_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
    {!! Form::label('proveedor_id', 'Descripcion', ['class' => 'col-md-4 fillable control-label']) !!}
    <div class="col-md-6">
        <textarea name="descripcion" class="form-control" >{{$insumo->descripcion}}</textarea>
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>