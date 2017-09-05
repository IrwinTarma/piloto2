
<div class="row">
    <div class="col-md-4">
        {!! Form::label('fecha', 'Fecha', ['class' => 'fillable control-label']) !!}
        {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control','required'=> '','disabled']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="proveedor" required disabled>
          @foreach ($proveedores as $key => $proveedor)
            @if (isset($planeamiento))
              <option value="{{$proveedor->id}}" {{$proveedor->id == $planeamiento->proveedor_id? 'selected':''}}>{{$proveedor->nombre_comercial}}</option>
            @else
              <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
            @endif
          @endforeach
        </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('empleado', 'Tejedor', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="empleado" required disabled>
          @foreach ($empleados as $key => $empleado)
              <option value="{{$empleado->id}}" {{$empleado->id == $planeamiento->empleado_id? 'selected':''}} >{{$empleado->nombres}} {{$empleado->apellidos}}</option>
          @endforeach
        </select>
    </div>
    <div class="col-md-4">
          {!! Form::label('producto_prod', 'Producto a prod.', ['class' => 'fillable control-label']) !!}

        <select name="producto" id="select_insumo" class="fillable form-control" required disabled>
          <option value=""></option>
          @foreach ($productos as $key => $producto)
            @if (isset($planeamiento))
              <option value="{{$producto->id}}" {{$producto->id == $planeamiento->producto_id? 'selected':''}} >{{$producto->nombre_generico}}</option>
            @else
              <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
            @endif
          @endforeach
        </select>
    </div>

</div>

<div class="row">
  <div class="col-md-4">
      {!! Form::label('maquina', 'Maquina', ['class' => 'fillable control-label']) !!}
      <select name="maquina" id="proveedor" class="form-control"  required>
          @foreach ($maquinas as $key => $maquina)
              <option value="{{$maquina->id}}" {{$maquina->id == $planeamiento->maquina_id? 'selected':''}} >{{$maquina->nombre}}</option>
          @endforeach
      </select>
  </div>
  <div class="col-md-4">
      {!! Form::label('turno', 'Turno', ['class' => 'fillable control-label']) !!}
      <select class="form-control" name="turno" required >
        <option value="Mañana">Mañana</option>
        <option value="Tarde">Tarde</option>
        <option value="Noche">Noche</option>
      </select>
  </div>

</div>
<h3>Accesorios</h3>
<div class="row">

    <div class="col-md-4">
      {!! Form::label('accesorio', 'Accesorio', ['class' => 'fillable control-label']) !!}
      <select name="accesorio" id="select_titulo" class="form-control">
          <option value=""></option>
          @foreach ($accesorios as $key => $accesorio)
            @if ($accesorio->id==$planeamiento->accesorio_id)
              <option value="{{$accesorio->id}}" selected>{{$accesorio->nombre}}</option>
            @else
              <option value="{{$accesorio->id}}" >{{$accesorio->nombre}}</option>
            @endif
          @endforeach
      </select>
    </div>
    <div class="col-md-4">
      {!! Form::label('lote', 'Lote', ['class' => 'fillable control-label']) !!}
      <select name="lote_accesorio" id="select_titulo" class="form-control">
        <option></option>
      </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('cantidad', 'Cantidad', ['class' => 'fillable control-label']) !!}
        {!! Form::number('cantidad', $planeamiento->cantidad, ['class' => 'onlynumbers fillable form-control']) !!}
    </div>
</div>
<h3>Materia Prima</h3>
<div class="row">


    <div class="col-md-4">
        {!! Form::label('insumo', 'Materia prima', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="insumo">
          <option value=""></option>
          @foreach ($insumos as $key => $insumo)
            @if ($insumo->id==$detallePlaneamiento->insumo_id)
              <option value="{{$insumo->id}}" selected>{{$insumo->nombre_generico}}</option>
            @else
              <option value="{{$insumo->id}}" >{{$insumo->nombre_generico}}</option>
            @endif
          @endforeach
        </select>
    </div>
    <div class="col-md-4">
      {!! Form::label('lote', 'Lote', ['class' => 'fillable control-label']) !!}
      <select name="lote_insumo" id="select_titulo" class="form-control">
        <option></option>
      </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('lote', 'Titulo', ['class' => 'fillable control-label']) !!}
        <select name="titulo" id="select_titulo" class="form-control">
          <option value=""></option>
          @foreach ($titulos as $key => $titulo)
            @if ($titulo->id == $detallePlaneamiento->titulo_id)
              <option value="{{$titulo->id}}" selected>{{$titulo->nombre}}</option>
            @else
              <option value="{{$titulo->id}}">{{$titulo->nombre}}</option>
            @endif
          @endforeach
        </select>
    </div>

</div>
