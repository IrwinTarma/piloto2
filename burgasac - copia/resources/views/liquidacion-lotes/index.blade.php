@extends('backend.layouts.appv2')

@section('after-styles')
<link href="{{ asset("css/datepicker.css") }}" rel="stylesheet">
<link href="{{ asset("css/sweetalert2.min.css") }}" rel="stylesheet">
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
                <div class="panel-heading">Liquidacion de Lotes</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">
                      <label for="">Fecha</label>
                      <input id="fecha_table" type="date" class="form-control" name="fecha" value="">
                    </div>
                    <div class="col-md-3">
                      <label for="">Proveedor</label>
                      <select id="proveedor_table" class="form-control" name="">
                        <option value=""></option>
                        @foreach ($proveedores as $key => $proveedor)
                          <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label  for="">Lote</label>
                      <select id="turno_table" class="form-control" name="">
                        <option value=""></option>
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noche">Noche</option>
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label for="">Opción</label>
                      <br>
                       <a href="#"  id="buscar-tabla" class="btn btn-primary">Buscar </a>
                    </div>
                  </div>
                  <br>
                <div class="row">
                  <div class="col-sm-2 col-sm-push-10">
                    <button class="btn btn-primary " id="liquidar-btn">Liquidar</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <br>
                    <table id="bandeja-produccion" class="table table-striped table-bordered table-hover">
                      <thead>
                      <th>Proveedor</th>
                        <th>
                          Lote
                        </th>
                        <th>
                          Materia Prima / Accesorio
                        </th>
                        <th>
                          Titulo
                        </th>
                        <!-- <th>
                          Caja / Bolsas
                        </th> -->
                        <th>
                          Peso (kg)
                        </th>
                        <th>
                          Liq.
                        </th>
                      </thead>
                      <tbody id="materia">
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
            valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'peso', 'estado' ]
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

        liquidacion_lotes = $("#bandeja-produccion").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{route('compras.liquidacion')}}',
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
              stocksF = []
              var compras = json.data,
              return_data = [];
              console.log(compras);
              for (var i = 0,compra; compra = compras[i]; i++) {
                var data = {};

                  data.lote       = compra.lote;
                  data.accesorio_id = compra.accesorio_id;
                  data.cantidad = compra.cantidad;
                  data.titulo = compra.titulo;
                  data.proveedor = compra.proveedor;
                  if (compra.insumo_id!=0) {
                    data.materia_prima = compra.insumo.nombre_generico;

                    data.actions = '<input name="liquidacion_mp" value="' + data.lote +'" data-cantidad = "'+ data.cantidad +'" type="checkbox"/>';
                  }
                  else {
                    data.materia_prima = compra.accesorio.nombre;
                    data.actions = '<input name="liquidacion_acc" value="' + data.accesorio_id +'" data-cantidad = "'+ data.cantidad +'" type="checkbox"/>';
                  }
                  data.peso  =  compra.peso_neto;

                  return_data.push(jQuery.extend(true, {}, data));
                }

              return return_data;
            }
          },
          "columns": [
            {"data": function ( row, type, val, meta ) {
               proveedor = "";
               console.log(row);
               if (typeof row.proveedor!=undefined && typeof row.proveedor!="undefined" && row.proveedor!=null) {
                  proveedor = row.proveedor.nombre_comercial;
               }
               //titulo = row.titulo.nombre;
               return proveedor;
            }, name: 'proveedor_id'},
            { "data": "lote", name:"lote" },
            { "data": "materia_prima", name:"materia_prima" },
            {"data": function ( row, type, val, meta ) {
               titulo = "";
               console.log(row);
               if (typeof row.titulo!=undefined && typeof row.titulo!="undefined" && row.titulo!=null) {
                  titulo = row.titulo.nombre;
               }
               //titulo = row.titulo.nombre;
               return titulo;
            }, name: 'titulo_id'},
            //{ "data": "cantidad"},
            { "data": "peso"},
            { "data" : "actions",orderable: false, searchable: false}
          ],
          "fnDrawCallback":function (oSettings) {
              // Promise.all(stocksF).then(function (stocks) {
              //   $("#materia tr").map(function (key) {
              //     $(this).find(".stock").html(stocks[key]);
              //   })
              // })

              $(".delete-detalle-planeamientos").click(function(){
                var detalle_id = $(this).attr('data-detalle-id');
                $.ajax({
                  //url:'/detalleplaneamientos/detalleplaneamientos/'+detalle_id,
                  url: '{{url('detalleplaneamientos/detalleplaneamientos')}}' + '/'+detalle_id,
                  type:'DELETE',
                  success:function () {
                    bandeja.ajax.reload();
                  }
                });
                return false;
              });

          },
        });



        $("#liquidar-btn").click(function () {
          if((!$("[name='liquidacion_mp']:checked").length) && (!$("[name='liquidacion_acc']:checked").length) ) return alert('Por favor seleccione uno o mas productos antes de continuar');
          var lotes = [];
          $("[name='liquidacion_mp']:checked").each(function () {

          lotes.push([this.value, $(this).attr('data-cantidad') ]);

          });
          var accesorios = [];
          $("[name='liquidacion_acc']:checked").each(function () {
            accesorios.push([this.value,$(this).attr('data-cantidad') ]);
          });
          console.log(lotes);
          console.log(accesorios);
          var data = {
            lotes : lotes,
            accesorios : accesorios
          };
          $.ajax({
            url:'{{route('compras.liquidar')}}',
            type:'POST',
            data:data,
            success: function () {
              Mensaje.confirmacion("Liquidacion Exitosa", "");
              liquidacion_lotes.ajax.reload();
            }
          })
        })

        function deletePlaneamientoDetalle() {

        }
      })
    </script>
@stop
@push('scripts')
{{ Html::script('plugins/sweetalert/sweetalert.min.js') }}
{{ Html::script('js/utils.js') }}
@endpush
