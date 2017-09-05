<div class="row">
    <div class="col-md-4">
        <div class="{{ $errors->has('fecha') ? 'has-error' : ''}}">
            {!! Form::label('fecha', 'Fecha', ['class' => 'fillable control-label']) !!}
            {!! Form::date('fecha', date('Y-m-d'), ['class' => 'fillable form-control']) !!}
            {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-4">
        {!! Form::label('tipoabono_id', 'Concepto de Abono de Compra', ['class' => 'fillable control-label']) !!}
        
        <select name="tipoabono_id" id="tipoabono_id" class="fillable form-control">
            <option></option>
            <?php foreach ($tipos_abono as $tipo_abono) : ?>
                <option value="<?php echo $tipo_abono->id ?>" <?php if (isset($abono)) echo ($tipo_abono->id == $abono->tipoabono_id)? 'selected' : '' ?> ><?php echo $tipo_abono->nombre ?></option>
            <?php endforeach ?>
        </select>
        
    </div>

    <div class="col-md-4"></div>

</div>

<div class="row">

    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
        {!! Form::text('proveedor', $compra->proveedor['nombre_comercial'], ['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4">
        {!! Form::label('compra', 'Compra', ['class' => 'fillable control-label']) !!}
        {!! Form::text('compra', $compra->id, ['class' => 'form-control']) !!}
    </div>

    <div class="col-md-4">
        {!! Form::label('select_producto', 'Producto', ['class' => 'fillable control-label']) !!}
        <select name="select_producto" id="select_producto" class="fillable form-control">
            <option></option>
            <?php foreach ($productos as $producto) : ?>
                <option value="<?php echo $producto->id ?>"><?php echo $producto->nombre_generico ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('peso_bruto', 'Peso Bruto', ['class' => 'fillable control-label']) !!}
        {!! Form::text('peso_bruto', null, ['class' => 'onlynumbers fillable form-control']) !!}
    </div>

    <div class="col-md-4">
        {!! Form::label('peso_tara', 'Peso Tara', ['class' => 'fillable control-label']) !!}
        {!! Form::text('peso_tara', null, ['class' => 'onlynumbers fillable form-control']) !!}
    </div>

    <div class="col-md-4">
        {!! Form::label('cantidad_paquetes', 'Cantidad de Cajas/Bolsas', ['class' => 'fillable control-label']) !!}
        {!! Form::text('cantidad_paquetes', null, ['class' => 'onlynumbers fillable form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('monto', 'Monto en S/. por Kg.', ['class' => 'fillable control-label']) !!}
        {!! Form::text('monto', null, ['class' => 'onlynumbers fillable form-control']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-offset-4 col-md-4">
        <br>
        <a id="add_to_grid" class="btn btn-primary" href="#">Agregar al Detalle</a>
    </div>
</div>