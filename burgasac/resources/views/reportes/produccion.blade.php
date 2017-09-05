@extends('backend.layouts.app')

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
    <div>
      <div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Produccion</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <form class="" action="{{route('reportes.produccion_descargar')}}" method="get">
                          <div class="col-md-2">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="fecha_p" value="">
                          </div>
                          <div class="col-md-2">
                            <label for="">Proveedor</label>
                            <select class="form-control" id="proveedor_p" name="proveedor">
                              <option value="">Todos</option>
                              @foreach ($proveedores as $key => $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Colaborador</label>
                            <select class="form-control" id="colaborador_p" name="empleado">
                              <option value="">Todos</option>
                              @foreach ($empleados as $key => $empleado)
                                <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Turno</label>
                            <select class="form-control" id="turno_p" name="turno">
                              <option value="">Todos</option>
                              <option value="Mañana">Mañana</option>
                              <option value="Tarde">Tarde</option>
                              <option value="Noche">Noche</option>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Maquina</label>
                            <select class="form-control" name="maquina" id="maquina_p">
                              <option value="">Todos</option>
                              @foreach ($maquinas as $key => $maquina)
                                <option value="{{$maquina->id}}">{{$maquina->nombre}}</option>
                              @endforeach
                            </select>
                          </div>


                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <a href="#" id="buscar-tabla-produccion" class="btn btn-primary">Buscar</a>
                          </div>
                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <button type="submit"  class="btn btn-primary">Descargar</a>
                          </div>
                        </form>

                      </div>
                    </div>
                    <div class="col-md-12">
                    <br>
                    <table id="produccion" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>
                            Fecha
                          </th>
                          <th>
                            Proveedor
                          </th>
                          <th>
                            Tejedor
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
                          <th>Insumo/Accesorio</th>
                          <th>
                            Bolsas/Paquetes
                          </th>
                          <th>
                            Peso Neto (KG)
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
    <script>
        var options = {
            valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'nro_guia', 'peso', 'estado' ]
        };
        var userList = new List('compras', options);
    </script>

    <script>
        /* show / hide order details */
        $(".detalle").click(function() {
          $(this).closest("tr").next().toggle('fast');
          if($(this).text() == '[ + ]')
            $(this).text('[ - ]');
          else
            $(this).text('[ + ]');
        });


    </script>
    <script type="text/javascript">
      $(function () {
        setTimeout(function () {
          $(".dataTables_filter").hide()
        },1500)

        // var today = new Date();
        // var dd = today.getDate();
        // var mm = today.getMonth()+1; //January is 0!
        //
        // var yyyy = today.getFullYear();
        // if(dd<10){dd='0'+dd}
        // if(mm<10){mm='0'+mm}
        // today = yyyy+'-'+mm+'-'+dd;
        //
        // $("#fecha_table").attr('value',today);
        // $("#proveedor_table").change(function () {
        //   bandeja.ajax.reload()
        // });
        //
        // $("#empleado_table").change(function () {
        //   bandeja.ajax.reload()
        // });
        //
        // $("#fecha_table").change(function () {
        //   bandeja.ajax.reload();
        // });


        $("#buscar-tabla").click(function () {
          bandeja.ajax.reload();
          return false;
        })

        $("#buscar-tabla-stocks").click(function () {
          stocks.ajax.reload();
          return false;
        });

        $("#buscar-tabla-telas").click(function () {
          telas.ajax.reload();
          return false;
        })

        $("#buscar-tabla-produccion").click(function () {
          produccion.ajax.reload();
          return false;
        })

        $("#buscar-tabla-planeamiento").click(function () {
          planeamientos.ajax.reload();
          return false;
        })

        stocks = $("#stocks").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{route('reportes.resumen')}}',
            data:function(d){
              return $.extend( {}, d, {
                "accesorio":$("#accesorio_stock").val(),
                "insumo" : $("#insumo_stock").val(),
              });
            },
            dataSrc: function (json) {
              var stocks = json.data,
              return_data = [];
              for (var i = 0,stock; stock = stocks[i]; i++) {
                var data = {};
                data.lote = stock.lote;
                data.mp   = stock.insumo? stock.insumo.nombre_generico : stock.accesorio.nombre;
                data.cantidad = stock.cantidad;
                data.peso_neto = stock.peso_neto;

                return_data.push(data);
              }
              return return_data;
            }
          },
          "columns": [
            { "data": "lote", name:"lote" },
            { "data": "mp",name:"insumo_id"},
            { "data": "cantidad",name:"cantidad"},
            { "data": "peso_neto",name:"peso_neto"},

          ],
          "fnDrawCallback":function (oSettings) {
              $(".delete-detalle-planeamientos").click(function(){
                var detalle_id = $(this).attr('data-detalle-id');
                $.ajax({
                  url:'{{route('planeamientos.index')}}'+detalle_id,
                  type:'DELETE',
                  success:function () {
                    bandeja.ajax.reload();
                  }
                });
                return false;
              });

          },
        });

        produccion = $("#produccion").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{route('reportes.produccion')}}',
            data:function(d){
              return $.extend( {}, d, {
                "proveedor": $('#proveedor_p').val(),
                "empleado":$("#colaborador_p").val(),
                "fecha" : $("#fecha_p").val(),
                "turno" : $("#turno_p").val(),
                "maquina":$("#maquina_p").val(),
                "fecha" : $("#fecha_p").val()
              });
            },
            dataSrc: function (json) {
              var planeamientos = json.data,
              return_data = [];
              for (var i = 0,planeamiento; planeamiento = planeamientos[i]; i++) {
                var data = {};
                debugger;
                data.fecha      = planeamiento.fecha;
                data.proveedor  = planeamiento.proveedor.nombre_comercial;
                data.empleado   = planeamiento.empleado.nombres + " " + planeamiento.empleado.apellidos;
                data.turno      = planeamiento.turno;
                data.maquina    = planeamiento.maquina.nombre;
                data.producto   = planeamiento.producto.nombre_generico;

                for (var j = 0,detalle; detalle = planeamiento.detalles[j]; j++) {
                  data.mp         = detalle.insumo? detalle.insumo.nombre_generico:detalle.accesorio.nombre;
                  data.Kg         = detalle.kg;
                  data.cantidad   = detalle.cantidad;

                  return_data.push(jQuery.extend(true, {}, data));
                }
              }
              console.log(return_data);
              return return_data;
            }
          },
          "columns": [
            { "data": "fecha", name:"fecha" },
            { "data": "proveedor", name:"proveedor.nombre_comercial" },
            { "data": "empleado",name:"detalle_planeamientos.empleado.nombre_comercial" },
            { "data": "turno", name:"detalle_planeamientos.turno" },
            { "data": "maquina", name:"detalle_planeamientos.maquina.nombre" },
            { "data": "producto",name:"producto.nombre_generico"},
            { "data": "mp",name:"insumo.nombre_generico"},
            { "data": "Kg",name:"detalle_planeamientos.Kg"},
            { "data": "cantidad",name:"rollos"},

          ],
          "fnDrawCallback":function (oSettings) {
              $(".delete-detalle-planeamientos").click(function(){
                var detalle_id = $(this).attr('data-detalle-id');
                $.ajax({
                  url:'{{route('planeamientos.index')}}'+detalle_id,
                  type:'DELETE',
                  success:function () {
                    bandeja.ajax.reload();
                  }
                });
                return false;
              });

          },
        });
        function deletePlaneamientoDetalle() {

        }
      })
    </script>
@stop
