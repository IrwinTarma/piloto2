<div class="row">
    <div class="col-md-4">
        {!! Form::label('fecha', 'Fecha', ['class' => 'fillable control-label']) !!}
        {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control','required'=> '','disabled'=> '', 'id' => 'fecha']) !!}
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="proveedor" disabled>
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
        <select class="form-control" name="empleado" disabled>
          @foreach ($empleados as $key => $empleado)
            @if (isset($planeamiento))
              <option value="{{$empleado->id}}" {{$empleado->id == $planeamiento->empleado_id}} >{{$empleado->nombres}} {{$empleado->apellidos}}</option>
            @else
              <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
            @endif
          @endforeach
        </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('turno', 'Turno', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="turno" disabled>
          <option value="Mañana">Mañana</option>
          <option value="Tarde">Tarde</option>
          <option value="Noche">Noche</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('maquina', 'Maquina', ['class' => 'fillable control-label']) !!}
        <select name="maquina" id="proveedor" class="form-control"  disabled>
            <option></option>
            @foreach ($maquinas as $key => $maquina)
              @if (isset($planeamiento))
                <option value="{{$maquina->id}}" {{$maquina->id == $planeamiento->maquina_id? 'selected':''}} >{{$maquina->nombre}}</option>
              @else
                <option value="{{$maquina->id}}">{{$maquina->nombre}}</option>
              @endif
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
          {!! Form::label('producto_prod', 'Producto a prod.', ['class' => 'fillable control-label']) !!}

        <select name="producto" id="select_insumo" class="fillable form-control" disabled>
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
<br>
<br>
<table id="planeamientos_grid" class="table table-bordered table-striped table-hover">
<thead>
    <tr>
      <th>Lote</th>
      <th>Insumo</th>
      <th>Titulo</th>
      <th>Cantidad</th>
      <th>Kg</th>
      <th>Cajas</th>
    </tr>
</thead>
    <tbody>
      <tr>

      </tr>
      @foreach ($planeamiento->detalles as $i => $detalle)
          <tr class="fila-materia-prima" data-indicador_valor="{{ is_null($indicadores[$i]) ? 0 : $indicadores[$i]->valor }}">
            <td class="hide">
              <input type="text" name="detalles[{{$i}}][id]" value="{{$detalle->id}}">
            </td>
            <td>
              <input type="hidden" name="detalles[{{$i}}][lote_insumo]" value="{{$detalle->lote_insumo}}">
              {{$detalle->lote_insumo}}
            </td>
            <td>
                {{ $detalle->insumo? $detalle->insumo->nombre_generico : $detalle->accesorio->nombre}}
            </td>
            <td>
              <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$detalle->titulo_id}}">
              {{$detalle->titulo->nombre}}
            </td>
            <td  class="cantidad">
              @if ($detalle->insumo)
                <input type="hidden"  data-id="{{$detalle->insumo_id}}" value="{{$detalle->cantidad_maxima->cantidad}}">
                <input disabled="disabled" type="number" step="any" class="cantidad_maxima_insumo" name="detalles[{{$i}}][cantidad_mp]"  data-max="{{$detalle->cantidad_maxima->cantidad}}" value="{{$detalle->cantidad}}">
              @else
                <input type="hidden"  data-id="{{$detalle->accesorio_id}}" value="{{$detalle->cantidad_maxima->cantidad}}">
                <input type="hidden" name="detalles[{{$i}}][id_accesorio]" value="{{$detalle->accesorio_id}}">
                <input type="number" step="any" class="cantidad_maxima_accesorio" name="detalles[{{$i}}][cantidad_accesorio]"  data-max="{{$detalle->cantidad_maxima->cantidad}}" value="{{$detalle->cantidad}}">
              @endif
            </td>
            <td class="materia">
              @if ($detalle->insumo)
                <input class="input-insumo" disabled="disabled" type="number" step="any" name="detalles[{{$i}}][materia]" value="{{ number_format($detalle->kg, 2)}}">
              @endif

            </td>
            <td class="cajas">
              @if ($detalle->insumo)

              <input disabled="disabled" type="number" step="any" name="detalles[{{$i}}][cajas]" value="{{$detalle->cajas}}">
            @endif

              <!-- <span>{{$detalle->kg}}</span> -->

            </td>
            <!-- <td class="ingresado">
              @if ($detalle->cajas&&$detalle->kg)
                Ingresado
              @else
                No ingresado
              @endif
            </td> -->
          </tr>
          @endforeach


            {{-- @foreach ($planeamiento->accesorio as $i => $accesorios)
            <tr>
              <td class=hide>
                <input type="text" name="detalles[{{$i}}][id]" value="{{$accesorios->id}}">
              </td>
              <td class="hide">

                <input type="hidden" name="detalles[{{$i}}][id_accesorio]" value="{{$accesorios->accesorio_id}}">
              </td>
              <td>
                <input type="hidden" name="" value="{{$accesorios->accesorio_id}}">
                0

              </td>
              <td>

                {{$accesorios->nombre}}
              </td>
              <td>
                <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$accesorios->titulo_id}}">
                {{$accesorios->tnombre}}
              </td>
              <td  class="cantidad">
                  <input type="number" step="any" name="detalles[{{$i}}][cantidad_accesorio]" value="{{$accesorios->cantidad}}">
              </td>

            </tr>
            @endforeach --}}

    </tbody>
</table>
<!-- <h3>Materia prima</h3>
<div class="row">

    <div class="col-md-4">
      <label for="">Cajas</label>
      <input type="number" name="cajas" value="" class="form-control">
    </div>
    <div class="col-md-4">
      <label for="">Kg. Materia Prima</label>
      <input type="number" name="materia_prima" value="" class="form-control">
    </div>

    <div class="col-md-4">
      <br>
      <button type="button" id="agregar-materia" name="button" class="btn btn-primary">Agregar</button>
    </div>
</div> -->
<h3>Producto Terminado</h3>
<div class="row">
    <div class="col-md-4">
      <label for="">Rollos</label>
      <input type="number" step="any" name="rollos" class="form-control" value="{{$planeamiento->rollos}}">
    </div>
    <div class="col-md-4">
      <label for="">Rollos con falla</label>

      <input type="number" step="any" class="form-control" name="rollos_falla" value="{{$planeamiento->rollos_falla}}">
    </div>
    <div class="col-md-4">
      <label for="">Kg. Producidos</label>
      <input type="number" step="any" name="kg_producidos" class="form-control" value="{{$planeamiento->kg_producidos}}">
    </div>
    <div class="col-md-4">
      <label for="">Kg. con falla</label>
      <input type="number" step="any" name="kg_falla" class="form-control" value="{{$planeamiento->kg_falla}}">
    </div>


</div>
