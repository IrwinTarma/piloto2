<div class="row">
    <div class="col-md-4">
        {!! Form::label('fecha', 'Fecha', ['class' => 'fillable control-label']) !!}
        @if (isset($planeamiento))
          {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control','required'=> '', 'disabled' => true]) !!}
        @else
          {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control','required'=> '']) !!}
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="proveedor" required>
          <option value=""> Seleccione</option>
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
        <select class="form-control" name="empleado" required>
          @foreach ($empleados as $key => $empleado)
            @if (isset($planeamiento))
              <option value="{{$empleado->id}}" {{$empleado->id == $planeamiento->empleado_id? 'selected':''}} >{{$empleado->nombres}} {{$empleado->apellidos}}</option>
            @else
              <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
            @endif
          @endforeach
        </select>
    </div>

    <div class="col-md-4">
        {!! Form::label('turno', 'Turno', ['class' => 'fillable control-label']) !!}
        <select class="form-control" name="turno" required>

          <option value="Mañana">Mañana</option>
          <option value="Tarde">Tarde</option>
          <option value="Noche">Noche</option>
            @if (isset($planeamiento))
            <option value="{{$planeamiento->turno}}" selected='' >{{$planeamiento->turno}}</option>
            @else
          @endif
        </select>
    </div>
</div>
<div class="row">

  <div class="col-md-4">
      {!! Form::label('maquina', 'Maquina', ['class' => 'fillable control-label']) !!}
      <select name="maquina" id="proveedor" class="form-control"  required>
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

      <select name="producto" id="select_producto" class="fillable form-control" required>
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

<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#tab_accesorios" aria-controls="tab_accesorios" role="tab" data-toggle="tab">Accesorios</a>
        </li>
        <li role="presentation">
            <a href="#tab_insumo" aria-controls="tab_insumo" role="tab" data-toggle="tab">Materia Prima</a>
        </li>
    </ul>

    <!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="tab_accesorios">

        <?php
            $i = 0;
        ?>

        <style media="screen">
          #select_accesorio{
            display: block;
          }
        </style>
        <div class="row">
          <div class="col-md-4">
              {!! Form::label('titulo_acesorio', 'Titulo Accesorio', ['class' => 'control-label']) !!}
              <select name = "titulo" id="select_titulo_accesorio"   class="form-control">
                  <option></option>
                  <?php foreach ($titulos_accesorio as $titulo_accesorio) : ?>
                      <option value="<?php echo $titulo_accesorio->id ?>"><?php echo $titulo_accesorio->nombre ?></option>
                  <?php endforeach ?>
              </select>
          </div>
            <div class="col-md-4">
              {!! Form::label('accesorio', 'Accesorio', ['class' => 'fillable control-label']) !!}

              <select name="accesorio" id="select_accesorio" class="form-control">
                <option value=""></option>
                @foreach ($accesorios as $key => $accesorio)
                  <option value="{{$accesorio->id}}">{{$accesorio->nombre}}</option>
                @endforeach
              </select>
            </div>


            <div class="col-md-4">
                {!! Form::label('cantidad', 'Cantidad', ['class' => 'fillable control-label']) !!}
                {!! Form::number('cantidad', null, ['class' => 'solo-enteros fillable form-control','id'=>'cantidad_accesorio']) !!}
            </div>
            <div class="col-md-offset-4 col-md-4">
              <a href="#" id="add_accesorio_to_grid" class="btn btn-primary">Agregar accesorio</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <h3>Detalle de Accesorios</h3>
                <div class="row">

                </div>
                <table id="compras_grid_accesorio" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Accesorio</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr>
                        @if (isset($planeamiento))
                          @foreach ($planeamiento->accesorios as $key => $detalle)
                            @if($detalle->accesorio_id!=0)
                              <tr>
                                <td>

                                  <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$detalle->titulo_id}}">
                                  {{$detalle->titulo->nombre}}
                                </td>

                                <td>
                                  <input type="hidden" name="detalles[{{$i}}][accesorio_id]" value="{{$detalle->accesorio_id}}">
                                  <span class="accesorio hide">{{$detalle->accesorio_id}}</span>
                                  {{$detalle->accesorio->nombre}}
                                </td>
                                <td>
                                  <input type="hidden" step="any" name="detalles[{{$i}}][cantidad]" value="{{$detalle->cantidad}}">
                                  {{$detalle->cantidad}}
                                </td>
                                <td>
                                  <a class="eliminar" style="cursor:pointer">
                                    <i class="fa fa-remove"></i></a>
                                  </a>

                                </td>
                              </tr>
                            <?php $i++; ?>
                            @endif
                          @endforeach
                        @else
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>
    <div role="tabpanel" class="tab-pane" id="tab_insumo">

        <div class="row">
          <div class="col-md-4">
            {!! Form::label('lote', 'Lote', ['class' => 'fillable control-label']) !!}
            <select name="lote_insumo" id="nro_lote" class="form-control">
              <option></option>
              
            </select>
          </div>

          <div class="col-md-4">
              {!! Form::label('insumo', 'Materia prima', ['class' => 'fillable control-label']) !!}
              <select class="form-control" id="select_insumo_t" name="insumo">
                <option value=""></option>
              </select>
          </div>

          <div class="col-md-4">
              {!! Form::label('lote', 'Titulo', ['class' => 'fillable control-label']) !!}
              <select name="titulo" class="form-control" id="select_titulo_insumo">
                <option value=""></option>
              </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-offset-4 col-md-4">
            <a href="#" class="btn btn-primary" id="add_insumo_to_grid">Agregar insumo</a>
          </div>

        </div>
        <div class="row">
            <div class="col-md-12">

                <h3>Detalle de Materia Primas</h3>
                <table id="compras_grid_insumo" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Lote</th>
                            <th>Materia Prima</th>
                            <th>Titulo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>

                      </tr> 
                      @if (isset($planeamiento))
                        @foreach ($planeamiento->insumos as $key => $detalle)
                           <tr>

                            <td>
                                <input type="hidden" name="detalles[{{$i}}][nro_lote]" value="{{$detalle->lote_insumo}}">
                              {{$detalle->lote_insumo}}
                            </td>
                            <td>

                              <input type="hidden" name="detalles[{{$i}}][insumo_id]" value="{{ isset($detalle->insumo)? $detalle->insumo->id : ''}}">
                              {{ isset($detalle->insumo)? $detalle->insumo->nombre_generico:''}}
                            </td>
                            <td>
                              <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$detalle->titulo_id}}">
                              {{$detalle->titulo->nombre}}
                            </td>
                            <td>
                              <a class="eliminar" style="cursor:pointer">
                                <i class="fa fa-remove"></i></a>
                              </a>
                            </td>
                            </tr>

                        @endforeach
                      @else
                      @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
</div>
