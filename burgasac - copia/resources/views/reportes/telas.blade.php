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
                <div class="panel-heading">Stock General de Tela Producida</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <form class="" action="{{route('reportes.resumen_telas_descargar')}}" method="get">
                          <div class="col-md-2">
                            <label for="">Productos</label>
                            <select id="producto_tela" class="form-control" name="producto">
                              <option value="">Todos</option>
                              @foreach ($productos as $key => $producto)
                                <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <a href="#" id="buscar-tabla-telas" class="btn btn-primary">Buscar</a>
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
                    <table id="resumen_tela" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>Proveedor</th>
                          <th>
                            Producto
                          </th>
                          <th>Lote</th>
                          <th>
                            Rollos
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

        telas = $("#resumen_tela").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'{{route('reportes.telas')}}',
            data:function(d){
              return $.extend( {}, d, {
                "producto":$("#producto_tela").val(),
              });
            },
            dataSrc: function (json) {
              var telas = json.data,
              return_data = [];
              for (var i = 0,tela; tela = telas[i]; i++) {
                var data = {};
                data.producto = tela.producto.nombre_generico;
                data.rollos   = tela.rollos;
                data.peso_neto = tela.cantidad;
                data.proveedor = tela.proveedor;
                data.nro_lote = tela.nro_lote;

                return_data.push(data);
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
            { "data": "producto", name:"producto_id" },
            { "data": "nro_lote", name:"nro_lote" },
            { "data": "rollos",name:"rollos"},
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

        function deletePlaneamientoDetalle() {

        }
      })
    </script>
@stop
