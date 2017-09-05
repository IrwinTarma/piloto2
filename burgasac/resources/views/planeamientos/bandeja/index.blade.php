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
                <div class="panel-heading">Bandeja de planeamiento de produccion</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-2">
                      <label for="">Fecha</label>
                      <input id="fecha_table" type="text" class="form-control" name="fecha" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="col-md-2">
                      <label for="">Proveedor</label>
                      <select id="proveedor_table" class="form-control" name="">
                        <option value=""></option>
                        @foreach ($proveedores as $key => $proveedor)
                          <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label for="">Tejedor</label>
                      <select id="empleado_table" class="form-control" name="">
                        <option value=""></option>
                        @foreach ($empleados as $key => $empleado)
                          <option value="{{$empleado->id}}">{{$empleado->nombres}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label  for="">Turno</label>
                      <select id="turno_table" class="form-control" name="">
                        <option value=""></option>
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noche">Noche</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label for="">Estado</label>
                    <select id="estado_table" class="form-control" name="">
                      <option value=""></option>
                        <option value="1">Planificado</option>
                        <option value="2">Producido</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <label for="">Opción</label>
                      <a href="#"  id="buscar-tabla" class="btn btn-primary">Buscar  | Descargar</a>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-12">
                    <br>
                    <table id="bandeja-produccion" class="table table-striped table-bordered table-hover">
                      <thead>
                        <th>
                          Planeamiento ID
                        </th>
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
                        <th>
                          Estado
                        </th>
                        <th>
                          Opc.
                        </th>
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

        bandeja = $("#bandeja-produccion").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{url('planeamientos/planeamientos')}}',
            data:function(d){
              return $.extend( {}, d, {
                "proveedor": $('#proveedor_table').val(),
                "empleado":$("#empleado_table").val(),
                "fecha" : $("#fecha_table").val(),
                "turno" : $("#turno_table").val(),
                "estado" : $("#estado_table").val()
              });
            },
            dataSrc: function (json) {

              var planeamientos = json.data;
              console.log(planeamientos);
              return_data = [];
              for (var i = 0,planeamiento; planeamiento = planeamientos[i]; i++) {
                var data = {};
                data.id = planeamiento.id;
                data.fecha      = planeamiento.fecha;
                data.proveedor  = planeamiento.proveedor.nombre_comercial;
                data.producto   = planeamiento.producto.nombre_generico;
                data.estado = planeamiento.estado==0? "Planificado":"Producido";
                data.empleado   = planeamiento.empleado.nombres + " " + planeamiento.empleado.apellidos;
                data.maquina    = planeamiento.maquina.nombre;
                data.turno      = planeamiento.turno;
                data.actions = '<a href="{{url('planeamientos/planeamientos')}}' + '/' + planeamiento.id  +'/liquidacion" class="btn btn-primary btn-xs" title="Ingreso de Produccion"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"/></a>';
                if(planeamiento.estado != 0)      data.actions += '<a href="#" class="btn btn-danger btn-xs delete-detalle-planeamientos" data-id="' + planeamiento.id + '"   title="Editar Compra"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
                // for (var j = 0,detalle; detalle = planeamiento.detalles[j]; j++) {
                //   //data.actions = '<a href="{{url('detalleplaneamientos/detalleplaneamientos')}}' + '/' + detalle.id  +'" class="btn btn-primary btn-xs" title="Editar Compra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>';
                //
                //
                // }
                return_data.push(jQuery.extend(true, {}, data));
              }
              return return_data;
            }
          },
          "columns": [
            { "data": "id", name:"id" },
            { "data": "fecha", name:"fecha" },
            { "data": "proveedor", name:"proveedor.nombre_comercial" },
            { "data": "empleado",name:"detalle_planeamientos.empleado.nombre_comercial" },
            { "data": "turno", name:"detalle_planeamientos.turno" },
            { "data": "maquina", name:"detalle_planeamientos.maquina.nombre" },
            { "data": "producto",name:"producto.nombre_generico"},
            { "data" : "estado",name:"estado"},
            { "data" : "actions",orderable: false, searchable: false}
          ],
          "fnDrawCallback":function (oSettings) {
              $(".delete-detalle-planeamientos").click(function(){
                var detalle_id = $(this).attr('data-id');
                $.ajax({
                  url: '{{url('produccion')}}' + '/'+detalle_id + '/eliminacion',
                  type:'GET',
                  success:function () {
                    bandeja.ajax.reload();
                  }
                });
                return false;
              });

          },
        });
      })
    </script>
@stop
@push('scripts')
<script type="text/javascript">
    $("#fecha_table").datepicker({ format: 'yyyy-mm-dd'})
        .on("show", function(e) {
            return false;
        }).on("hide", function(e) {
            return false;
        }).on("clearDate", function(e) {
            return false;
    });
</script>
@endpush