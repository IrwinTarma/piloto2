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
                <div class="panel-heading">Recepcion de materia prima</div>
                <div class="panel-body">

                  {!! Form::open(['url' => '/recepcion-mp/recepcion-mp', 'class' => '', 'files' => true, 'id' => 'planeamiento-form']) !!}

                      <div class="row">
                        <div class="col-md-4">
                          <label for="">Fecha</label>
                          <input id="fecha" type="text" class="form-control" name="fecha" value="{{date('Y-m-d')}}" />
                        </div>
                        <div class="col-md-4">
                          <label for="">Proveedor</label>
                          <select id="" class="form-control" name="proveedor">
                            <option value=""></option>
                            @foreach ($proveedores as $key => $proveedor)
                              <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label  for="">Nro. Guia</label>
                          <input type="text" name="nro_guia" value="" class="form-control">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Lote</label>
                            <input type="text" id="nro_lote" name="nro_lote" value="" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Materia prima</label>
                            <select id="select_insumo" class="form-control" name="insumo">
                              @foreach ($insumos as $key => $insumo)
                                <option data-titulo_id="{{$insumo->titulo_id}}" value="{{$insumo->id}}">{{$insumo->nombre_generico}} - {{$insumo->titulo}}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Titulo</label>
                            <select id="select_titulo" class="form-control" name="titulo">
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
                            <input type="text" id="peso_bruto" name="peso_bruto" value="" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Peso Tara</label>
                            <input type="text" id="peso_tara" name="peso_tara" value="" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">N° Paquetes</label>
                            <input type="text" name="cantidad_paquetes" id="cantidad_paquetes" value="" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <button class="btn btn-primary" id="add_to_grid" name="button">Agregar</button>
                        </div>
                      </div>


                <div class="row">
                  <div class="col-md-12">
                    <br>
                    <table id="recepcion_grid" class="table table-striped table-bordered table-hover">
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
                        <tr>

                        </tr>
                      </tbody>
                    </table>

                    <div class="form-group">
                        <div class="col-md-offset-4 col-md-4">

                            <a href="{{ url('compra/compras') }}" class="btn btn-warning">Cancelar</a>

                            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar planeamiento', ['class' => 'btn btn-primary']) !!}

                        </div>
                    </div>
                    {!! Form::close() !!}

                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>

@endsection

@section('after-scripts')
    {{ Html::script('plugins/listjs/list.min.js') }}
@stop
@push('scripts')
<script type="text/javascript">
  var RMP = {
    listar : function() {
        $("#bandeja-produccion").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'compras.mp',
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
                  data.actions = "";
                  data.actions += '<a href="#" class="btn btn-danger btn-xs delete-detalle-recepcion" data-id="' + data.id +'" data-detalle-id="'+ detalle.id + '"   title="Editar Compra"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>'
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
              $(".delete-detalle-recepcion").click(function(){
                var detalle_id = $(this).attr('data-id');
                $.ajax({
                  url:'/recepcion-mp/recepcion-mp/'+detalle_id,
                  type:'DELETE',
                  success:function () {
                    bandeja.ajax.reload();
                  }
                });
                return false;
              });

          },
        });
    }
};
var options = {
    valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'nro_guia', 'peso', 'estado' ]
};
var userList = new List('compras', options);

/* show / hide order details */
$(".detalle").click(function() {
    $(this).closest("tr").next().toggle('fast');
        if($(this).text() == '[ + ]')
            $(this).text('[ - ]');
        else
        $(this).text('[ + ]');
});

        $(function() {
            /* TAB FOCUS */
            /* Compra action */
            var i = 1;
            var lotes_in_details = function(){
              let lotes = [];
              $("#recepcion_grid tbody tr").map(function () {
                lotes.push($(this).find(".lotes").html());
              })
              return lotes;
            };

            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
        });
$(document).ready(function(){
    $("#fecha").datepicker({ format: 'yyyy-mm-dd'})
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
});
</script>
{{ Html::script('js/procesos/recepcion_materia_prima.js') }}
@endpush