@extends('backend.layouts.appv2')

@section('after-styles')
    <style>
    .dropdown{padding: 0;}
    .dropdown .dropdown-menu{border: 1px solid #999}
    .detallescompra{
        display: none;
        background-color: #ececec;
    }
    </style>
@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Planeamientos</div>
                    <div class="panel-body">

                        <a href="{{ url('/planeamientos/planeamientos/create') }}" class="btn btn-primary btn-xs" title="Nuevo Planeamiento"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>



                        <div id="compras">
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <input class="search form-control" placeholder="Filtrar Resultados" />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> U. Fecha Actualizacion </th>
                                        <th>Codigo</th>
                                        <th>Proveedor</th>
                                        <th>Producto a prod.</th>
                                        <th>Empleado</th>
                                        <th>Maquina</th>
                                        <th>Turno</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                  @foreach($planeamientos as $item)
                                      <tr>
                                          <td><span class="btn btn-info detalle">[ + ]</span></td>
                                          <td class="updated_at">{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                                          <td class="codigo">PLA{{ leadZero($item->id) }}</td>
                                          <td class="proveedor">{{ $item->proveedor['nombre_comercial'] }}</td>
                                          <td class="producto">{{ $item->producto["nombre_generico"] }}</td>
                                          <td class="empleado">{{$item->empleado->nombres}}</td>
                                          <td class="maquina">{{$item->maquina->nombre}}</td>
                                          <td class="turno">{{$item->turno}}</td>

                                          <td>
                                              <a href="{{ url('/planeamientos/planeamientos/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Compra"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                              @if ($item->estado == 0)
                                                <a href="{{ url('/planeamientos/planeamientos/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Compra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/planeamientos/planeamientos', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Deshabilitar Compra" />', array(
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-xs',
                                                            'title' => 'Deshabilitar Compra',
                                                            'onclick'=>'return confirm("Confirmar?")'
                                                    )) !!}
                                                {!! Form::close() !!}
                                              @endif

                                          </td>
                                      </tr>

                                      <tr class="detallescompra">
                                          <td colspan="9">
                                              <table class="table table-striped table-bordered table-hover">
                                                  <thead>
                                                      <th>Lote Insumo</th>
                                                      <th>Insumo</th>
                                                      <th>Titulo</th>
                                                      <!-- <th>Lote Accesorio</th> -->
                                                      <th>
                                                        Accesorio
                                                      </th>
                                                  </thead>

                                                  <tbody>
                                                    @foreach ($item->detalles as $key => $detalle)

                                                      <tr colspan="9">
                                                          <td>
                                                            {{$detalle->lote_insumo}}
                                                          </td>
                                                          <td>
                                                            {{$detalle->insumo["nombre_generico"]}}
                                                          </td>
                                                          <td>
                                                            {{$detalle->titulo["nombre"]}}
                                                          </td>
                                                          <td class="accesorio">
                                                            {{$detalle->accesorio["nombre"]}}
                                                          </td>
                                                      </tr>
                                                    @endforeach
                                                  </tbody>
                                              </table>
                                          </td>
                                      </tr>

                                  @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper">  </div>
                        </div><!-- /#compras -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Planeamientos</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <form class="" action="{{url('planeamientos/planeamientos/reporte')}}" method="get">

                        <div class="col-md-2">
                          <label for="">Fecha</label>
                          <input type="text" class="form-control" name="date" id="fecha_table" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="col-md-2">
                          <label for="">Proveedor</label>
                          <select class="form-control" name="proveedor" id="proveedor_table">
                            <option value="">Todos</option>
                            @foreach ($proveedores as $key => $proveedor)
                              <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="">Colaborador</label>
                          <select class="form-control" id="empleado_table" name="colaborador">
                            <option value="">Todos</option>
                            @foreach ($empleados as $key => $empleado)
                              <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="">Turno</label>
                          <select class="form-control" id="turno_table" name="turno">
                            <option value="">Todos</option>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noche">Noche</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="">Maquina</label>
                          <select class="form-control" name="maquina" id="maquina_table">
                            <option value="">Todos</option>
                            @foreach ($maquinas as $key => $maquina)
                              <option value="{{$maquina->id}}">{{$maquina->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="">Producto</label>
                          <select class="form-control" name="producto" id="producto_table">
                            <option value="">Todos</option>
                            @foreach ($productos as $key => $producto)
                              <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-1">
                          <label for="">Opción</label><br>
                          <a href="#" id="buscar-tabla" class="btn btn-primary">Buscar</a>
                        </div>
                        <div class="col-md-2">
                          <label for="">Opción</label><br>
                          <button type="submit" class="btn btn-primary">Descargar</a>
                        </div>
                      </form>

                      </div>
                    </div>
                    <div class="col-md-12">
                    <br>
                    <table id="mp-planeamiento" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>

                          </th>
                          <th>

                          </th>
                          <th>

                          </th>
                          <th>

                          </th>
                          <th>

                          </th>
                          <th>

                          </th>

                          <th>
                              MP
                          </th>
                          <th>
                              MP
                          </th>
                          <th>
                              MP
                          </th>
                          <th>
                              MP
                          </th>
                          <th>
                              MP
                          </th>
                          <th>
                            PT
                          </th>
                          <th>
                              PT
                          </th>
                          <th>
                              PT
                          </th>

                        </tr>
                        <tr>

                          <th>
                            Fecha
                          </th>
                          <th>
                            Proveedor
                          </th>
                          <th>
                            Colaborador
                          </th>
                          <th>
                            Turno
                          </th>
                          <th>
                            Maquina
                          </th>
                          <th>
                            Producto
                          </th>

                          <th>
                            lote
                          </th>
                          <th>
                            MP
                          </th>
                          <th>
                            Titulo
                          </th>
                          <th>
                            Cajas
                          </th>
                          <th>
                            Kg
                          </th>
                          <th>
                            Rollos
                          </th>
                          <th>
                            Kg
                          </th>
                          <th>
                            Falla Kg
                          </th>

                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>

        </div>

      </div>
    </div>

@endsection

@section('after-scripts')
    {{ Html::script('plugins/listjs/list.min.js') }}
    <script type="text/javascript">
       var options = {
            valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'nro_guia', 'peso', 'estado' ]
        };
        var userList = new List('compras', options);
    </script>

@stop
@push('scripts')
{{ Html::script('js/procesos/planeamiento.js') }}
<script type="text/javascript">
 

  Planeamiento.listar();
$("#fecha_table").datepicker({ format: 'yyyy-mm-dd'})
      .on("show", function(e) {
          console.log("show");
          return false;
      }).on("hide", function(e) {
          console.log("hide");
          return false;
      }).on("clearDate", function(e) {
          console.log("clear");
          return false;
  });
</script>
@endpush

