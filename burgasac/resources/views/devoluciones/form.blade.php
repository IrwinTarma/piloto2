<div class="form-group {{ $errors->has('factura') ? 'has-error' : ''}}">
    {!! Form::label('tipo_devolucion', 'Producto en mal estado', ['class' => 'fillable col-md-4 control-label']) !!}
    <div class="col-md-1">
        {!! Form::radio('tipo_devolucion', 'defectuoso', true) !!}
        {!! $errors->first('tipo_devolucion', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('sin_factura', 'Producto por peticion del cliente', ['class' => 'fillable col-md-4 control-label']) !!}
    <div class="col-md-1">
        {!! Form::radio('tipo_devolucion', 'peticion') !!}
        {!! $errors->first('tipo_devolucion', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="{{ $errors->has('fecha') ? 'has-error' : ''}}">
            {!! Form::label('fecha', 'Fecha', ['class' => 'fillable control-label']) !!}
            {!! Form::text('fecha', date('Y-m-d'), ['class' => 'fillable form-control']) !!}
            {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="proveedor" disabled>
          @foreach ($proveedores as $key => $proveedor)
            <option value="{{$proveedor->id}}"{{$compra->proveedor['nombre_comercial']==$proveedor->nombre_comercial? 'selected':''}} >{{$proveedor->nombre_comercial}}</option>
          @endforeach
        </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('compra', 'Compra', ['class' => 'fillable control-label']) !!}
        {!! Form::text('compra',  leadZero($compra->id), ['class' => 'form-control derecha']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('select_nro_lote', 'Lote', ['class' => 'fillable control-label']) !!}
        <select name="select_nro_lote" id="select_nro_lote" class="fillable form-control">
            <option></option>
            <?php foreach ($compra->detalles as $detalle) : ?>
                <option value="<?php echo $detalle->nro_lote ?>"><?php echo $detalle->nro_lote ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('producto', 'Producto', ['class' => 'fillable control-label']) !!}
        {!! Form::text('producto', null, ['class' => 'fillable form-control']) !!}
        <input type="hidden" name="insumo_id" id="insumo_id">
        <input type="hidden" name="accesorio_id" id="accesorio_id">
    </div>

    <div class="col-md-4">
        {!! Form::label('titulo', 'Titulo', ['class' => 'fillable control-label']) !!}
        {!! Form::text('titulo', null, ['class' => 'fillable form-control']) !!}
        <input type="hidden" name="marca" id="marca">
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
    <div class="col-md-offset-4 col-md-4">
        <br>
        <a id="add_to_grid" class="btn btn-primary" href="#">Agregar al Detalle</a>
    </div>
</div>
