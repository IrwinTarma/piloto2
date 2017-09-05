<div class="col-md-2 col-sm-2 col-xs-12 form-group">
    {!! Form::label('fecha', 'Fecha') !!}
    {!! Form::text('fechafiltro', date('Y-m-d'), ['class' => 'form-control', 'id' => 'fechafiltro']) !!}
</div>
@if(count($proveedor) > 0)
<div class="col-md-3 col-sm-3 col-xs-12 form-group">
	{!! Form::label('proveedores', 'Proveedores') !!}
    {!! Form::select('proveedorfiltro', $proveedor, null, ['class' => 'form-control selectpicker', 'id' => 'proveedorfiltro', 'data-live-search' => true, 'required' => 'required']) !!}
</div>
@endif
@if(count($producto) > 0)
<div class="col-md-3 col-sm-3 col-xs-12 form-group">
	{!! Form::label('productos', 'Productos') !!}
    {!! Form::select('productofiltro', $producto, null, ['class' => 'form-control selectpicker', 'id' => 'productofiltro', 'data-live-search' => true, 'required' => 'required']) !!}
</div>
@endif
@if(count($color) > 0)
<div class="col-md-3 col-sm-3 col-xs-12 form-group">
	{!! Form::label('colores', 'Colores') !!}
    {!! Form::select('colorfiltro', $color, null, ['class' => 'form-control selectpicker', 'id' => 'colorfiltro', 'data-live-search' => true, 'required' => 'required']) !!}
</div>
@endif
<div class="col-md-3 col-sm-3 col-xs-12 form-group">
	<button type="button" class="btn btn-success btn-search pull-right"><i class="fa fa-search"></i></button>
	<button type="button" class="btn btn-danger btn-download pull-right"><i class="fa fa-download"></i></button>
	<!-- <button type="button" class="btn btn-danger btn-send-cloud pull-right"><i class="fa fa-cloud-upload"></i></button> -->
</div>