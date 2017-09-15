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
                <div class="panel-heading">Reporte General de Tela en Tintoreria</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <form class="" action="{{route('reportes.resumen_descargar')}}" method="get">
                          <div class="col-md-2">
                            <label for="">Accesorio</label>
                            <select id="accesorio_stock" class="form-control" name="accesorio">
                              <option value="">Todos</option>
                              @foreach ($accesorios as $key => $accesorio)
                                <option value="{{$accesorio->id}}">{{$accesorio->nombre}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Insumos</label>
                            <select id="insumo_stock" class="form-control" name="insumo">
                              <option value="">Todos</option>
                              @foreach ($insumos as $key => $insumo)
                                <option value="{{$insumo->id}}">{{$insumo->nombre_generico}}</option>
                              @endforeach
                            </select>

                          </div>
                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <a href="#" id="buscar-tabla-stocks" class="btn btn-primary">Buscar</a>
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
                          
                          <th>
                            Producto Terminado
                          </th>
                          <th>Color</th>
                          <th>
                            Peso Neto
                          </th>
                          <th>
                            Cantidad/Bolsas
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
            url:'{{route('reportes.despacho_tintoreria')}}',
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
                data.peso = tela.peso;
                data.proveedor = tela.proveedor;
                data.color = tela.color;
                data.producto = tela.producto;

                return_data.push(data);
              }
              return return_data;
            }
          },
          "columns": [
            { "data": "producto", name:"producto" },
            { "data": "color", name:"color" },
             { "data": "peso",name:"peso"},
            { "data": "rollos",name:"rollos"},
           

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


       

      })
    </script>
@stop
