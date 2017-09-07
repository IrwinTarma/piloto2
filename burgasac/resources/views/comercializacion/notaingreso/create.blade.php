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
                <div class="panel-heading">NOTA DE INGRESO</div>
                <div class="panel-body">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Fecha</label>
                                    <input id="fecha_t" type="text" class="form-control" name="fecha_t" value="{{ $fecha }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Control Interno</label>
                                    <input id="control_t" type="text" class="form-control" name="control_t" readonly value="{{ $bandeja->id }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Proveedor</label>
                                    <input id="proveedor_t" type="text" class="form-control" name="proveedor_t" readonly value="{{ $bandeja->razon_social }}">
                                </div>

                                <div class="col-md-5">
                                    <label for="">Producto</label>
                                    <input id="producto_t" type="text" class="form-control" name="producto_t" readonly value="{{ $bandeja->nombre_generico }}">
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-2">
                                    <label for="">Lote</label>
                                    <input id="lote_t" type="text" class="form-control" name="lote_t" readonly value="{{ $bandeja->nro_lote }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="">MP</label>
                                    <input id="mp_t" type="text" class="form-control" name="mp_t" readonly value="">
                                </div>

                                <div class="col-md-2">
                                    <label for="">Peso</label>
                                    <input id="peso_t" type="text" class="form-control" name="peso_t" readonly value="{{ $bandeja->cantidad }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Rollos</label>
                                    <input id="rollos_t" type="text" class="form-control" name="rollos_t" readonly value="{{ $bandeja->rollos }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="">Color</label>
                                    <input id="color_t" type="text" class="form-control" name="color_t" readonly value="{{ $bandeja->nombre }}">
                                </div>                        
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Tienda</label>                            
                                    <select class="form-control" name="tienda" id="tienda">                                                                              
                                        @foreach ($tienda as $key => $tiendalocal)
                                            <option value="{{$tiendalocal->tienda_id}}">{{$tiendalocal->desc_tienda}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Partida</label>
                                    <input id="partida" type="text" class="form-control" name="partida" autofocus="autofocus">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Peso</label>
                                    <input id="peso" type="text" class="form-control" name="peso" >
                                </div>

                                <div class="col-md-2">
                                    <label for="">Rollos</label>
                                    <input id="rollo" type="text" class="form-control" name="rollo" >
                                </div>
                                <div class="col-md-2" style="text-align:right;">
                                    <br>
                                    <div  id="add" class="btn btn-primary">agregar</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <table id="bandeja-produccion" name="bandeja-produccion" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <th>
                                            Item
                                        </th>
                                        <th>
                                            Fecha
                                        </th>
                                        <th>
                                            Producto
                                        </th>
                                        <th>
                                            Tienda
                                        </th>
                                        <th>
                                            Partida
                                        </th>
                                        <th>
                                            Color
                                        </th>
                                        <th>
                                            Peso
                                        </th>
                                        <th>
                                            Rollos
                                        </th>
                                        <th>
                                            Print
                                        </th>                                       
                                        <th>
                                            X
                                        </th>
                                        
                                        </thead>
                                        <tbody style="text-align: center;">
                                            <tr id="fila_0">
                                                <td>
                                                    Item
                                                </td>
                                                <td>                                                
                                                    Fecha
                                                </td>
                                                <td>
                                                    Producto
                                                </td>
                                                <td>
                                                    Tienda
                                                </td>
                                                <td>
                                                    Partida
                                                </td>
                                                <td>
                                                    Color
                                                </td>
                                                <td>
                                                    Peso
                                                </td>
                                                <td>
                                                    Rollos
                                                </td>
                                                <td>
                                                    Print
                                                </td>                                           
                                                <td>
                                                    <div id="del" class="btn btn-link" onclick="$('#fila_0').remove()">X</div>
                                                </td>
                                            </tr>
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

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        /**
         * Funcion para añadir una nueva columna en la tabla
         */

         var indice_tabla=0;

        $("#add").click(function(){
            // Obtenemos el numero de filas (td) que tiene la primera columna
            // (tr) del id "tabla"

            var datos_fila=[
            $("#fecha_t").val(),
            $("#producto_t").val(),
            $("#tienda").val(),
            $("#partida").val(),
            $("#color_t").val(),
            $("#peso").val(),
            $("#rollo").val()];
            

            var tds=7;//$("#bandeja-produccion tr:first td").length;
            
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#bandeja-produccion tr").length;
            indice_tabla++;
            var nuevaFila="<tr id=fila_"+indice_tabla+">";
            nuevaFila+="<td>"+indice_tabla+"</td>";
            for(var i=0;i<tds;i++){
                // añadimos las columnas
                nuevaFila+="<td>"+datos_fila[i]+"</td>";
            }
            nuevaFila+="<td>"+'<input type="checkbox" id="cbox2" value="">'+"</td>";
            // Añadimos una columna con el numero total de columnas.
            // Añadimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta añadida
            nuevaFila+='<td><div class="btn btn-link" onclick=$("#fila_'+indice_tabla+'").remove() >X</div>';//+(trs+1)+" columnas";
            nuevaFila+="</tr>";
            $("#bandeja-produccion").append(nuevaFila);
        });
 
        /**
         * Funcion para eliminar la ultima columna de la tabla.
         * Si unicamente queda una columna, esta no sera eliminada
         */
        $("#del").click(function(){
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#bandeja-produccion tr").length;
            if(trs>1)
            {
                // Eliminamos la ultima columna
                $("#bandeja-produccion tr:last").remove();
            }
        });
    });
    </script>
@endpush('scripts')