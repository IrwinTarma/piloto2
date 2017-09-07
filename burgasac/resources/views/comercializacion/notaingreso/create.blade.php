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

                <form action="{{ route('notaingreso.store') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="codint" id="codint" value="{{ $id }}">
                    <input type="hidden" name="conta" id="conta" value="">
                    <input type="hidden" name="eliminados" id="eliminados" value="">

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
                                <div class="col-md-2" style="text-align:center;">
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
                                            
                                            
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    
                                        <button class="btn btn-primary">Guardar</button>
                                    
                                </div>
                            </div>



                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">
var indice_tabla=0;
    $(document).ready(function(){
        /**
         * Funcion para añadir una nueva columna en la tabla
         */
        $("#add").click(function(){
            // Obtenemos el numero de filas (td) que tiene la primera columna

            // Obtenemos el total de columnas (tr) del id "tabla"            
            indice_tabla++;
            $("#conta").val(indice_tabla);
            var nuevaFila="<tr id=fila_"+indice_tabla+">";
            nuevaFila+="<td>"+'<input type="hidden" name="cod_ndi_'+indice_tabla+'" id="cod_ndi_'+indice_tabla+'" value="0">'+indice_tabla+"</td>";
            
            nuevaFila+="<td>"+'<input type="hidden" name="fec_'+indice_tabla+'" id="fec_'+indice_tabla+'" value="'+$("#fecha_t").val()+'">'+$("#fecha_t").val()+"</td>";
            nuevaFila+="<td>"+$("#producto_t").val()+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="tie_'+indice_tabla+'" id="tie_'+indice_tabla+'" value="'+$("#tienda").val()+'">'+$("#tienda").text()+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="par_'+indice_tabla+'" id="par_'+indice_tabla+'" value="'+$("#partida").val()+'">'+$("#partida").val()+"</td>";
            nuevaFila+="<td>"+$("#color_t").val()+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="pes_'+indice_tabla+'" id="pes_'+indice_tabla+'" value="'+$("#peso").val()+'">'+$("#peso").val()+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="roll_'+indice_tabla+'" id="roll_'+indice_tabla+'" value="'+$("#rollo").val()+'">'+$("#rollo").val()+"</td>";

            nuevaFila+="<td>"+'<input type="checkbox" id="cbox_'+indice_tabla+'" value="">'+"</td>";
            // Añadimos una columna con el numero total de columnas.
            // Añadimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta añadida
            nuevaFila+='<td><div class="btn btn-link" onclick="delTabla('+indice_tabla+')" >X</div>';
            nuevaFila+="</tr>";
            $("#bandeja-produccion").append(nuevaFila);
        });
 
        /**
         * Funcion para eliminar la ultima columna de la tabla.
         * Si unicamente queda una columna, esta no sera eliminada
         */
        /*$("#del").click(function(){
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#bandeja-produccion tr").length;
            if(trs>1)
            {
                // Eliminamos la ultima columna
                $("#bandeja-produccion tr:last").remove();
            }
        });*/

        @foreach($bandejatabla as $tab_bandeja) 
            addtabla("{{ $tab_bandeja->dNotIng_id }}","{{ $tab_bandeja->fecha }}","{{ $tab_bandeja->nombre_especifico }}","{{ $tab_bandeja->tienda_id }}","{{ $tab_bandeja->desc_tienda }}","{{ $tab_bandeja->partida }}","{{ $tab_bandeja->nombre }}","{{ $tab_bandeja->peso_cant }}","{{ $tab_bandeja->rollo }}","{{ $tab_bandeja->impreso }}");
        @endforeach

        
    });
        function addtabla(cod,fec,prod,tiecod,tie,par,col,pes,roll,imp)
        {
            indice_tabla++;
            $("#conta").val(indice_tabla);
            var nuevaFila="<tr id=fila_"+indice_tabla+">";
            nuevaFila+="<td>"+'<input type="hidden" name="cod_ndi_'+indice_tabla+'" id="cod_ndi_'+indice_tabla+'" value="'+cod+'">'+indice_tabla+"</td>";
            
            nuevaFila+="<td>"+'<input type="hidden" name="fec_'+indice_tabla+'" id="fec_'+indice_tabla+'" value="'+fec+'">'+fec+"</td>";
            nuevaFila+="<td>"+prod+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="tie_'+indice_tabla+'" id="tie_'+indice_tabla+'" value="'+tiecod+'">'+tie+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="par_'+indice_tabla+'" id="par_'+indice_tabla+'" value="'+par+'">'+par+"</td>";
            nuevaFila+="<td>"+col+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="pes_'+indice_tabla+'" id="pes_'+indice_tabla+'" value="'+pes+'">'+pes+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="roll_'+indice_tabla+'" id="roll_'+indice_tabla+'" value="'+roll+'">'+roll+"</td>";

            nuevaFila+="<td>"+'<input type="checkbox" id="cbox_'+indice_tabla+'" value="" '+((imp==1)?"checked":"")+'>'+"</td>";
            // Añadimos una columna con el numero total de columnas.
            // Añadimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta añadida
            nuevaFila+='<td><div class="btn btn-link" onclick="delTabla('+indice_tabla+')" >X</div>';
            nuevaFila+="</tr>";
            $("#bandeja-produccion").append(nuevaFila);
            return 1;            
        }

        function delTabla(id)
        {            
            datos= $("#eliminados").val()+","+$("#cod_ndi_"+id).val();
            $("#eliminados").val(datos);
            $("#fila_"+id).remove();
        }
    </script>
@endpush('scripts')