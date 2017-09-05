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
                <div class="panel-heading">RECEPCIÓN DE TELA TEÑIDA</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Fecha</label>
                            <input id="fecha_table" type="text" class="form-control" name="fecha" >
                        </div>
                        <div class="col-md-2">
                            <label for="">Control Interno</label>
                            <input id="control_table" type="text" class="form-control" name="control" >
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
                            <label for="">Producto</label>
                            <select class="form-control" name="producto" id="producto_table">
                                <option value="">Todos</option>
                                @foreach ($productos as $key => $producto)
                                    <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Estado</label>
                            <select class="form-control" name="estado" id="estado_table">
                                <option value="1">Abierto</option>
                                <option value="2">Cerrado</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for=""> </label>
                            <a href="#"  id="buscar-tabla" class="btn btn-primary">Buscar</a>
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
                                    # Control Interno
                                </th>
                                <th>
                                    Proveedor
                                </th>
                                <th>
                                    Producto
                                </th>
                                <th>
                                    Materia Prima
                                </th>
                                <th>
                                    Lote
                                </th>
                                <th>
                                    Peso
                                </th>
                                <th>
                                    Rollos
                                </th>
                                <th>
                                    Color
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Nota de Ingreso
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
                    url:'{{url('comercializacion/comercializacion')}}',
                    data:function(d){
                        return $.extend( {}, d, {
                            "proveedor": $('#proveedor_table').val(),
                            "producto":$("#producto_table").val(),
                            "fecha" : $("#fecha_table").val(),
                            "control" : $("#control_table").val(),
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
                            data.id = planeamiento.despachotintoreria.id;
                            data.fecha      = planeamiento.despachotintoreria.fecha;
                            data.proveedor  = planeamiento.proveedor.nombre_comercial;
                            data.producto   = planeamiento.producto.nombre_generico;
                            data.materia     = "materia";//planeamiento.estado==0? "Planificado":"Producido";
                            data.nrolote   = planeamiento.nro_lote;
                            data.peso    = planeamiento.cantidad
                            data.rollos      = planeamiento.rollos;
                            data.color      = planeamiento.color.nombre;
                            data.estados      = "Abierto";
                            data.actions = '<a href="{{url('planeamientos/planeamientos')}}' + '/' + planeamiento.id  +'/liquidacion" class="btn btn-primary btn-xs" title="Crear Despacho"><span class="glyphicon glyphicon-calendar" aria-hidden="true"/></a>';
                            data.actions += '<a href="{{url('planeamientos/planeamientos')}}' + '/' + planeamiento.id  +'/liquidacion" class="btn btn-primary btn-xs" title="Ver Despacho"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>';
                            data.actions += '<a href="#" class="btn btn-danger btn-xs delete-detalle-planeamientos" data-id="' + planeamiento.id + '"   title="Editar Despacho"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>';
                            data.actions += '<a href="{{url('planeamientos/planeamientos')}}' + '/' + planeamiento.id  +'/liquidacion" class="btn btn-primary btn-xs" title="Cerrar Despacho"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';

                            //   if(planeamiento.estado != 0)
                            //    data.actions += '<a href="#" class="btn btn-danger btn-xs delete-detalle-planeamientos" data-id="' + planeamiento.id + '"   title="Editar Compra"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>';
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
                    { "data": "fecha", name:"planeamiento.despachotintoreria.fecha",orderable: false },
                    { "data": "id", name:"id" },
                    { "data": "proveedor", name:"proveedor.nombre_comercial" },
                    { "data": "producto",name:"producto.nombre_generico"},
                    { "data" : "materia",name:"materia"},
                    { "data": "nrolote",name:"detalle_planeamientos.empleado.nombre_comercial" },
                    { "data": "peso", name:"detalle_planeamientos.maquina.nombre" },
                    { "data": "rollos", name:"detalle_planeamientos.turno" },
                    { "data" : "color",name:"color"},
                    { "data" : "estados",name:"estados"},

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