
<div class="row">
    <div class="col-md-4">
        {!! Form::label('fecha', 'Fecha', ['class' => 'fillable control-label']) !!}
        {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control','required'=> '', 'id' => 'fecha']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
      {!! Form::label('producto', 'Producto', ['class' => 'fillable control-label ']) !!}
      <select class="form-control selectpicker" name="producto" data-live-search="true">
        <option value="">Seleccione</option>
        @foreach ($productos as $key => $producto)
            <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
        @endforeach
      </select>

    </div>
    <div class="col-md-4">
      {!! Form::label('lote', 'Lotes', ['class' => 'fillable control-label ']) !!}
      <select class="form-control selectpicker" name="lote" data-live-search="true" id="lote" required="" disabled="">
      </select>

    </div>

    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
        <select class="form-control selectpicker" name="proveedor" data-live-search="true" id="proveedor" >
          <option value="">Seleccione</option>
          @foreach ($proveedores as $key => $proveedor)
            <option value="{{$proveedor->proveedor_id}}">{{$proveedor->nombre_comercial}}</option>
        @endforeach
        </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('turno', 'Color', ['class' => 'fillable control-label']) !!}
        <select class="form-control selectpicker" name="color" data-live-search="true" >
          <option value="">Seleccione</option>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        {!! Form::label('cantidad', 'Kg', ['class' => 'fillable control-label']) !!}
        <input class="form-control" type="text" name="kg" value="">
    </div>
    <div class="col-md-4">
      {!! Form::label('cantidad', 'Rollos', ['class' => 'fillable control-label']) !!}
      <input class="form-control" type="text" name="rollos" value="">
    </div>


    <div class="col-md-4">
      <br>
      <a class="btn btn-primary" id="add_to_grid" href="#">Agregar</a>
    </div>
</div>
<br>
<br>
<table id="despachos_grid" class="table table-bordered table-striped table-hover">
<thead>
    <tr>
      <th>
        Fecha
      </th>
      <th>Proveedor</th>
      <th width="2">Producto</th>
      <th>Lote</th>
      <th>Color</th>
      <th>KG</th>
      <th>Rollos</th>
      <th>Eliminar</th>
    </tr>
</thead>
    <tbody>
        <tr class="hide">
          <td>
          </td>
          <td>
          </td>
          <td></td>
          <td>
          </td>
          <td>
          </td>
          <td>
          </td>
          <td class="cajas">
          </td>
        </tr>
     </tbody>
</table>
