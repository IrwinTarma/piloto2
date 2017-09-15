@extends('backend.layouts.appv2')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">NOTA DE INGRESO</div>
                <div class="panel-body">

                <form action="{{ route('notaingreso.store') }}" method="POST" onkeypress="return anular(event)">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="codint" id="codint" value="{{ $id }}">
                    <input type="hidden" name="conta" id="conta" value="">
                    <input type="hidden" name="eliminados" id="eliminados" value="">
                    <input type="hidden" name="actualizar" id="actualizar" value="">
                    <input type="hidden" name="cad_actt" id="cad_actt" value="">

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
                        <div class="panel-body" id="dina_control" name="dina_control">
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
                                    <input id="partida" type="text" class="form-control" name="partida" placeholder="# partida" maxlength="15" autofocus="autofocus" tabindex="1">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Peso</label>
                                    <input id="peso" type="text" class="form-control" name="peso" placeholder="peso o cantidad" maxlength="6" tabindex="2">
                                </div>

                                <div class="col-md-2">
                                    <label for="">Rollos</label>
                                    <input id="rollo" type="text" class="form-control" name="rollo" placeholder="rollos" maxlength="9" tabindex="3" value="1">
                                </div>
                                <div class="col-md-2" style="text-align:center;">
                                    <br>
                                    <div  id="add" class="btn btn-primary" tabindex="4">agregar</div>
                                    <div  id="act" class="btn btn-primary" style="display:none;" onclick="actualiza()">actualizar</div>
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
                                                Acción
                                            </th>                                            
                                        
                                        </thead>
                                        <tbody style="text-align: center;">
                                            
                                            
                                        </tbody>
                                    </table>
                        
                                    <!--ul class="pagination">
                                        
                                        <li class="disabled"><span>«</span></li>

                                        <li class="active"><span>1</span></li>
                                        <li><a href="http://127.0.0.1:8001/comercializacion/notaingreso/show/1?page=2">2</a></li>
                                        
                                        <li><a href="http://127.0.0.1:8001/comercializacion/notaingreso/show/1?page=2" rel="next">»</a></li>
                                    </ul-->

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                        <button class="btn btn-success">Guardar</button>
                                        <a href="{{ route('comercializacion.index')}}" class="btn btn-primary">Bandeja</a>
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
var key_enter=true;
    $(document).ready(function(){
        
        $('#rollo').keyup(function (){
          this.value = (this.value + '').replace(/[^0-9]/g, '');
        });
        $('#peso').numeric(",").numeric({decimalPlaces: 2});
        //$("#act").hide();
        /**
         * Funcion para añadir una nueva columna en la tabla
         */
        
            $("#add").click(function(){
            if(validacion()==0)
            {
                // Obtenemos el numero de filas (td) que tiene la primera columna

                // Obtenemos el total de columnas (tr) del id "tabla"            
                indice_tabla++;
                $("#conta").val(indice_tabla);
                var nuevaFila="<tr id=fila_"+indice_tabla+">";
                nuevaFila+="<td>"+'<input type="hidden" name="cod_ndi_'+indice_tabla+'" id="cod_ndi_'+indice_tabla+'" value="0">'+'<i class="fa fa-hand-o-right" aria-hidden="true"></i>'+"</td>";
                
                nuevaFila+="<td>"+'<input type="hidden" name="fec_'+indice_tabla+'" id="fec_'+indice_tabla+'" value="'+$("#fecha_t").val()+'">'+$("#fecha_t").val()+"</td>";
                nuevaFila+="<td>"+$("#producto_t").val()+"</td>";
                nuevaFila+="<td>"+'<input type="hidden" name="tie_'+indice_tabla+'" id="tie_'+indice_tabla+'" value="'+$("#tienda").val()+'"><p id="Ltie_'+indice_tabla+'">'+$("#tienda option:selected").html()+"</p></td>";
                nuevaFila+="<td>"+'<input type="hidden" name="par_'+indice_tabla+'" id="par_'+indice_tabla+'" value="'+$("#partida").val()+'"><p id="Lpar_'+indice_tabla+'">'+$("#partida").val()+"</p></td>";
                nuevaFila+="<td>"+$("#color_t").val()+"</td>";
                nuevaFila+="<td>"+'<input type="hidden" name="pes_'+indice_tabla+'" id="pes_'+indice_tabla+'" value="'+$("#peso").val()+'"><p id="Lpes_'+indice_tabla+'">'+$("#peso").val()+"</p></td>";
                nuevaFila+="<td>"+'<input type="hidden" name="roll_'+indice_tabla+'" id="roll_'+indice_tabla+'" value="'+$("#rollo").val()+'"><p id="Lroll_'+indice_tabla+'">'+$("#rollo").val()+"</p></td>";

                nuevaFila+="<td>"+'<input type="hidden" name="cb_'+indice_tabla+'" id="cb_'+indice_tabla+'" value=""><input type="checkbox" id="cbox_'+indice_tabla+'" name="cbox_'+indice_tabla+'">'+"</td>";
                // Añadimos una columna con el numero total de columnas.
                // Añadimos uno al total, ya que cuando cargamos los valores para la
                // columna, todavia no esta añadida
                nuevaFila+='<td><div class="btn btn-link" onclick="delTabla('+indice_tabla+')" >'+'<a class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"></i></a>'+'</div>';
                //nuevaFila+='<td><div class="btn btn-link" onclick="editar('+indice_tabla+')" >E</div>';

                nuevaFila+="</tr>";
                $("#bandeja-produccion").append(nuevaFila);
                
                $("#peso").val("");
                $("#rollo").val("1");
                $( "#peso" ).focus();

                $("#partida").attr('disabled','disabled');
            }   

            });
        
        @foreach($bandejatabla as $tab_bandeja) 
            addtabla("{{ $tab_bandeja->dNotIng_id }}","{{ $tab_bandeja->fecha }}","{{ $tab_bandeja->nombre_especifico }}","{{ $tab_bandeja->tienda_id }}","{{ $tab_bandeja->desc_tienda }}","{{ $tab_bandeja->partida }}","{{ $tab_bandeja->nombre }}","{{ $tab_bandeja->peso_cant }}","{{ $tab_bandeja->rollo }}","{{ $tab_bandeja->impreso }}","{{ $tab_bandeja->cod_barras }}");
        @endforeach

    });

    $(document).bind('keydown',function(e){
        if ( e.which == 27 ) 
        {
            cancelar();
        };
    });

     $("#partida").bind('keydown',function(e){
        if ( e.which == 13 ) 
        {
            $("#peso").focus();
        };
    });

    $("#peso").bind('keydown',function(e){
        if ( e.which == 13 ) 
        {
            $("#rollo").focus();
        };
    });


    $("#rollo").bind('keydown',function(e){
        if ( e.which == 13 && key_enter ) 
        {
            $('#add').click();
        };
    });            
    

        function addtabla(cod,fec,prod,tiecod,tie,par,col,pes,roll,imp,cb)
        {        
            indice_tabla++;
            $("#conta").val(indice_tabla);
            var nuevaFila="<tr id=fila_"+indice_tabla+">";
            nuevaFila+="<td>"+'<input type="hidden" name="cod_ndi_'+indice_tabla+'" id="cod_ndi_'+indice_tabla+'" value="'+cod+'">'+cod+"</td>";
            
            nuevaFila+="<td>"+'<input type="hidden" name="fec_'+indice_tabla+'" id="fec_'+indice_tabla+'" value="'+fec+'">'+fec+"</td>";
            nuevaFila+="<td>"+prod+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="tie_'+indice_tabla+'" id="tie_'+indice_tabla+'" value="'+tiecod+'"><p id="Ltie_'+indice_tabla+'">'+tie+"</p></td>";
            nuevaFila+="<td>"+'<input type="hidden" name="par_'+indice_tabla+'" id="par_'+indice_tabla+'" value="'+par+'"><p id="Lpar_'+indice_tabla+'">'+par+"</p></td>";
            nuevaFila+="<td>"+col+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="pes_'+indice_tabla+'" id="pes_'+indice_tabla+'" value="'+pes+'"><p id="Lpes_'+indice_tabla+'">'+pes+"</p></td>";
            nuevaFila+="<td>"+'<input type="hidden" name="roll_'+indice_tabla+'" id="roll_'+indice_tabla+'" value="'+roll+'"><p id="Lroll_'+indice_tabla+'">'+roll+"</p></td>";

            nuevaFila+="<td>"+'<input type="hidden" name="cb_'+indice_tabla+'" id="cb_'+indice_tabla+'" value="'+cb+'"><input type="checkbox" id="cbox_'+indice_tabla+'" name="cbox_'+indice_tabla+'" '+"checked"+'>'+"</td>";
            // Añadimos una columna con el numero total de columnas.
            // Añadimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta añadida
            nuevaFila+='<td><div class="btn btn-link" id="cdel_'+indice_tabla+'"  onclick="delTabla('+indice_tabla+')" >'+'<a class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"></i></a>'+'</div>';
            //nuevaFila+='<td><div class="btn btn-link" id="cedi_'+indice_tabla+'" onclick="editar('+indice_tabla+')" >E</div>';
            nuevaFila+="</tr>";
            $("#bandeja-produccion").append(nuevaFila);
            return 1;            
        
        }

        function delTabla(id)
        {     
            
            if(confirm('Nota: El registro se retirará momentaneamente, pero el cambio no se hará efecto hasta que usted guarde los cambios.'))
            {
                var datos= $("#eliminados").val()+","+$("#cod_ndi_"+id).val();
                $("#eliminados").val(datos);
                $("#fila_"+id).remove();
            }            
        }

        function editar(id)
        {
            $("#dina_control").css( "box-shadow","rgba(0, 0, 0, 0.75) 0px 4px 47px -5px"); 

            $("#tienda").val($("#tie_"+id).val());
            $("#partida").val($("#par_"+id).val());
            $("#peso").val($("#pes_"+id).val());
            $("#rollo").val($("#roll_"+id).val());

            $("#partida").attr('disabled','disabled');
            $("#cdel_"+id).hide();
            $("#cedi_"+id).hide();

            $("#actualizar").val(id);

            $("#act").show();
            $("#add").hide();   

            $( "#peso" ).focus();
            key_enter=false;
        }

        function actualiza()
        {
            if(validacion()==0)
            {
                var id=$("#actualizar").val();
                $("#tie_"+id).val($("#tienda").val());
                $("#par_"+id).val($("#partida").val());
                $("#pes_"+id).val($("#peso").val());
                $("#roll_"+id).val($("#rollo").val());            
                
                $("#Ltie_"+id).text($("#tienda option:selected").html());
                $("#Lpar_"+id).text($("#partida").val());
                $("#Lpes_"+id).text($("#peso").val());
                $("#Lroll_"+id).text($("#rollo").val());

                $("#partida").removeAttr('disabled');
                $("#cdel_"+id).show();
                $("#cedi_"+id).show();

                $("#dina_control").css( "box-shadow","none"); 

                $("#tienda").val("1");
                $("#partida").val("");
                $("#peso").val("");
                $("#rollo").val("");

                $("#act").hide();
                $("#add").show();

                //verificar si hay  cambios 
                if($("#tie_"+id).val()!=$("#tienda").val() || $("#pes_"+id).val()!=$("#peso").val() || $("#roll_"+id).val()!=$("#rollo").val())
                {                
                    var datos= $("#cad_actt").val()+","+$("#cod_ndi_"+id).val();
                    $("#cad_actt").val(datos);
                }

                $( "#partida" ).focus();
                key_enter=true;
                //si hay agregar al input .... el código
            }

        }
        function cancelar()
        {
            var id=$("#actualizar").val();
            $("#partida").removeAttr('disabled');
            $("#cdel_"+id).show();
            $("#cedi_"+id).show();

            $("#dina_control").css( "box-shadow","none"); 

            $("#tienda").val("1");
            $("#partida").val("");
            $("#peso").val("");
            $("#rollo").val("");

            $("#act").hide();
            $("#add").show();

            $( "#partida" ).focus();
            key_enter=true;
        }

         function anular(e) {
              tecla = (document.all) ? e.keyCode : e.which;
              return (tecla != 13);
         }
         function validacion()
         {
            var par_=$.trim($("#partida").val());
            var pes_=$.trim($("#peso").val());
            var rol_=$.trim($("#rollo").val());
            var key_error=false;
            
            if(par_=="")
            {
                $("#partida").css("border","2px solid #f00");                
                key_error=true;
            }
            else
                $("#partida").css("border","1px solid #d2d6de");

            if(pes_=="")
            {
                $("#peso").css("border","2px solid #f00");                
                key_error=true;
            }
            else
                $("#peso").css("border","1px solid #d2d6de");

            if(rol_=="")
            {
                $("#rollo").css("border","2px solid #f00");
                key_error=true;
            }
            else
                $("#rollo").css("border","1px solid #d2d6de");

            return (key_error)?1:0;
         }


    </script>
    <!--script>
       function tabular(e,obj) {
         tecla=(document.all) ? e.keyCode : e.which;
         if(tecla!=13) return;
         frm=obj.form;
         for(i=0;i<frm.elements.length;i++)
           if(frm.elements[i]==obj) {
             if (i==frm.elements.length-1) i=-1;
             break }
         frm.elements[i+1].focus();
         return false;
       }

       if(!("autofocus" in document.createElement("input")))
           document.getElementById("uno").focus();
   </script-->
@endpush('scripts')