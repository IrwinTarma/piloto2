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
                <div class="panel-heading">Planeamientos</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <form class="" action="{{route('reportes.planeamientos_descargar')}}" method="get">
                          <div class="col-md-2">
                            <label for="">Fecha</label>
                            <input type="date" id="fecha_pl" class="form-control" name="fecha" value="">
                          </div>
                          <div class="col-md-2">
                            <label for="">Proveedor</label>
                            <select class="form-control" name="proveedor" id="proveedor_pl">
                              <option value="">Todos</option>
                              @foreach ($proveedores as $key => $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Colaborador</label>
                            <select class="form-control" name="empleado" id="colaborador_pl">
                              <option value="">Todos</option>
                              @foreach ($empleados as $key => $empleado)
                                <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Turno</label>
                            <select class="form-control" name="turno" id="turno_pl">
                              <option value="">Todos</option>
                              <option value="Mañana">Mañana</option>
                              <option value="Tarde">Tarde</option>
                              <option value="Noche">Noche</option>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Maquina</label>
                            <select class="form-control" name="maquina" id="maquina_pl">
                              <option value="">Todos</option>
                              @foreach ($maquinas as $key => $maquina)
                                <option value="{{$maquina->id}}">{{$maquina->nombre}}</option>
                              @endforeach
                            </select>
                          </div>


                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <a href="#" id="buscar-tabla-planeamiento" class="btn btn-primary">Buscar</a>
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
                    <table id="planeamientos" class="table table-striped table-bordered table-hover">
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
                            Maquina
                          </th>
                          <th>
                            Turno
                          </th>
                          <th>
                            Producto
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

        planeamientos = $("#planeamientos").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{route('reportes.planeamientos')}}',
            data:function(d){
              return $.extend( {}, d, {
                "proveedor": $('#proveedor_pl').val(),
                "empleado":$("#empleado_pl").val(),
                "fecha" : $("#fecha_pl").val(),
                "turno" : $("#turno_pl").val(),
                "producto": $("#producto_pl").val(),
                "maquina":$("#maquina_pl").val()
              });
            },
            dataSrc: function (json) {
              var planeamientos = json.data,
              return_data = [];
              console.log(planeamientos);
              for (var i = 0,planeamiento; planeamiento = planeamientos[i]; i++) {
                console.log(planeamiento);
                var data = {};
                data.fecha = planeamiento.fecha;
                data.proveedor = planeamiento.proveedor.nombre_comercial;
                data.empleado = planeamiento.empleado.nombres + " " + planeamiento.empleado.apellidos;
                data.maquina = planeamiento.maquina.nombre;
                data.turno = planeamiento.turno;
                data.producto = planeamiento.producto.nombre_generico;

                return_data.push(data);
              }
              return return_data;
            }
          },
          "columns": [
            { "data": "fecha", name:"" },
            { "data": "proveedor",name:""},
            { "data": "empleado",name:""},
            { "data": "maquina",name:""},
            { "data": "turno",name:""},
            { "data": "producto",name:""},
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
