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



        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recepcion de materia prima</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-4">
                      <label for="">Fecha</label>
                      <input id="fecha_table" type="date" class="form-control" name="name" value="">
                    </div>
                    <div class="col-md-4">
                      <label for="">Proveedor</label>
                      <select id="proveedor_table" class="form-control" name="">
                        <option value=""></option>
                        @foreach ($proveedores as $key => $proveedor)
                          <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label  for="">Nro. Guia</label>
                      <input type="text" name="name" value="" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Lote</label>
                        <input type="text" name="name" value="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Materia prima</label>
                        <select class="form-control" name="insumo">
                          @foreach ($insumos as $key => $insumo)
                            <option value="{{$insumo->id}}">{{$insumo->nombre_generico}}</option>
                          @endforeach
                        </select>
                      </div>

                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Titulo</label>
                        <select class="form-control" name="lote">
                          @foreach ($titulos as $key => $titulo)
                            <option value="{{$titulo->id}}">{{$titulo->nombre}}</option>
                          @endforeach
                        </select>
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">P. Bruto</label>
                        <input type="text" name="name" value="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Peso Tara</label>
                        <input type="text" name="name" value="" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">N° Paquetes</label>
                        <input type="text" name="name" value="" class="form-control">
                      </div>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-offset-8">
                    <a href="#" class="btn btn-primary">Agregar</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <br>
                    <table id="bandeja-produccion" class="table table-striped table-bordered table-hover">
                      <thead>
                        <th>
                          Fecha
                        </th>
                        <th>
                            Proveedor
                        </th>
                        <th>
                          Lote
                        </th>
                        <th>
                          Materia Prima
                        </th>
                        <th>
                          Titulo
                        </th>
                        <th>
                          P. Bruto
                        </th>
                        <th>
                          P. Tara
                        </th>
                        <th>
                          P. Neto
                        </th>
                        <th>
                          Eliminar
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

        $("[name='insumo']").change(function () {
          var id = $(this).val();
          $.ajax({
            url:'/compras/insumos/'+id+'/lotes',
            success:function (lotes) {
              $("[name='lote_insumo']").empty();
              for (var i = 0; i < lotes.length; i++) {
                $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
              }
            }
          })
        })

        $("#buscar-tabla").click(function () {
          bandeja.ajax.reload();
          return false;
        })

        bandeja = $("#bandeja-produccion").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{route('compras.mp')}}',
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

              var compras = json.data,
              return_data = [];
              for (var i = 0,compra; compra = compras[i]; i++) {
                var data = {};
                data.fecha      = compra.fecha;
                data.proveedor  = compra.proveedor.nombre_comercial;
                for (var j = 0,detalle; detalle = compra.detalles[j]; j++) {
                  data.insumo     = detalle.insumo? detalle.insumo.nombre_generico:'';
                  data.titulo     = detalle.titulo.nombre;
                  data.lote       = detalle.nro_lote;
                  data.peso_bruto = detalle.peso_bruto;
                  data.peso_tara  = detalle.peso_tara;
                  data.peso_neto  = Number(detalle.peso_bruto) - Number(detalle.peso_tara) ;
                  data.actions = '<a href="#" class="btn btn-danger btn-xs delete-detalle-planeamientos" data-id="' + data.id +'" data-detalle-id="'+ detalle.id + '"   title="Editar Compra"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
                  return_data.push(jQuery.extend(true, {}, data));
                }
              }
              return return_data;
            }
          },
          "columns": [
            { "data": "fecha", name:"fecha" },
            { "data": "proveedor", name:"proveedor.nombre_comercial" },
            { "data": "lote", name:"detalles_compras.nro_lote" },
            { "data": "insumo", name:"insumo.nombre_generico" },
            { "data": "titulo", name:"titulo.nombre" },
            { "data": "peso_bruto", name:"detalles_compras.peso_bruto" },
            { "data": "peso_tara", name:"detalles_compras.peso_tara" },
            { "data": "peso_neto"},
            { "data" : "actions",orderable: false, searchable: false}
          ],
          "fnDrawCallback":function (oSettings) {
              $(".delete-detalle-planeamientos").click(function(){
                var detalle_id = $(this).attr('data-detalle-id');
                $.ajax({
                  url:'/detalleplaneamientos/detalleplaneamientos/'+detalle_id,
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
