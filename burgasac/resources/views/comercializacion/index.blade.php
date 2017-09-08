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
                        
                        <form action="{{ route('comercializacion.index') }}" method="GET">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="GET">

                            <div class="col-md-1">
                                <label for="">Fecha</label>
                                <input id="fecha" type="text" class="form-control" name="fecha" value="{{ $datosant->fecha }}">
                            </div>
                            <div class="col-md-2">
                                <label for="">Control Interno</label>
                                <input id="control" type="text" class="form-control" name="control" value="{{ $datosant->control }}">
                            </div>
                            <div class="col-md-2">
                                <label for="">Proveedor</label>
                                <select id="proveedor" class="form-control" name="proveedor">
                                    <option value="">Todos</option>
                                    @foreach ($proveedores as $key => $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="">Producto</label>
                                <select class="form-control" name="producto" id="producto">
                                    <option value="">Todos</option>
                                    @foreach ($productos as $key => $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label for="">Estado</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="0">Abierto</option>
                                    <option value="1">Cerrado</option>
                                </select>
                            </div>
                            <div class="col-md-1" style="text-align:center;">
                                <br>
                                <button type="submit" class=" signbuttons btn btn-primary">Buscar</button>                            
                            </div>
                            <div class="col-md-2" style="text-align:center;">
                                <br>
                                <a href="{{ route('notaingresoatipico.create') }}" id="buscar-tabla" class="btn btn-primary">Nuevo Ingreso</a>
                            </div>

                        </form>
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
                                <tbody style="text-align: center;">
                                @foreach($bandeja as $band)
                                    <tr>
                                        <td>
                                            {{ $band->created_at }}
                                        </td>
                                        <td>
                                            {{ $band->id }}
                                        </td>
                                        <td>
                                            {{ $band->razon_social }}
                                        </td>
                                        <td>
                                            {{ $band->nombre_generico }}
                                        </td>
                                        <td>
                                            {{ $band->cantidad }}
                                        </td>
                                        <td>
                                            {{ $band->rollos }}
                                        </td>
                                        <td>
                                            {{ $band->nombre }}
                                        </td>
                                        <td>
                                            {{ ($band->estado==0)?"Abierto":"Cerrado" }}
                                        </td>
                                        <td>
                                            @if($band->estado==0)
                                                <a href="{{ route('notaingreso.create',$band->id) }}" class="btn btn-link">Crear / Editar</a> | 
                                            @else
                                                <a href="javascript:alert('El detalle está cerrado.')" class="btn btn-link" style="color:#67696b;">Crear / Editar</a> | 
                                            @endif
                                            <a href="{{ route('notaingreso.show',$band->id) }}" class="btn btn-link">Ver</a> | 
                                            <a href="javascript:cerrar('{{ $band->id }}')" class="btn btn-link">cerrar</a>
                                            <form action="{{ route('comercializacion.update',$band->id) }}" method="POST" id="postcerrar_{{ $band->id }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="_method" value="PUT">
                                                <!--button class="btn btn-link">cerrar</button-->
                                            </form>
                                             <!--| 
                                            <a href="{{ route('notaingreso.create',$band->id) }}" class="btn btn-link">X</a-->
                                            
                                        </td>                                    
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $bandeja->render() !!}
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
        /*$(function () {
            
            $("#buscar-tabla").click(function () {
                bandeja.ajax.reload();
                return false;
            })

            bandeja = $("#bandeja-produccion").DataTable(
            {
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
        })*/
    </script>
@stop
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#proveedor").val("{{ $datosant->proveedor }}");
            $("#producto").val("{{ $datosant->producto }}");
            $("#estado").val("{{ $datosant->estado }}");
        });
        $("#fecha").datepicker({ format: 'yyyy-mm-dd'})
            .on("show", function(e) {
                return false;
            }).on("hide", function(e) {
            return false;
        }).on("clearDate", function(e) {
            return false;
        });

        function cerrar(id) 
        {
            if (window.confirm("¿Está seguro que desea cerrar el registro, si lo hace no podrá abrirlo nuevamente?")) 
            {
                $("#postcerrar_"+id).submit();
            }
        }
    </script>

@endpush