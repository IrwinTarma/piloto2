<div class="form-group {{ $errors->has('producto_id') ? 'has-error' : ''}}">
    
    <div class="col-md-4">
    	{!! Form::label('producto', 'Producto') !!}
        {!! Form::select('producto_id', $productos, $obj->producto_id, ['class' => 'form-control selectpicker', 'id' => 'producto', 'required' => 'required', 'data-live-search' => true]) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor') !!}
        {!! Form::select('proveedor_id', $proveedores, $obj->proveedor_id, ['class' => 'form-control', 'id' => 'proveedor', 'required' => 'required']) !!}
    </div>
    <div class="col-md-4">
        {!! Form::label('color', 'Color') !!}
        {!! Form::select('color_id', ["" => "Seleccione"], null, ['class' => 'form-control', 'id' => 'color', 'required' => 'required', 'disabled' => true]) !!}
    </div>
    <div class="col-md-1">
        {!! Form::label('moneda', 'Moneda') !!}
        {!! Form::select('moneda_id', [1 => "s/.", 2 => "USD"], $obj->moneda_id, ['class' => 'form-control', 'id' => 'moneda', 'required' => 'required']) !!}
    </div>
    <div class="col-md-3">
        {!! Form::label('precio', 'Precio') !!}
        {!! Form::text('precio', $obj->precio, ['class' => 'form-control decimales', 'required' => true]) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>