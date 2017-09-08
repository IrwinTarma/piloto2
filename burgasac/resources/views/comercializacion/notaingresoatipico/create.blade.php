@extends('backend.layouts.appv2')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">NOTA DE INGRESO ATIPICO</div>
                <div class="panel-body">

                <form action="{{ route('notaingresoatipico.store') }}" method="POST" onkeypress="return anular(event)">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="codint" id="codint" value="{{ $id }}">
                    <input type="hidden" name="conta" id="conta" value="">
                    <input type="hidden" name="eliminados" id="eliminados" value="">
                    <input type="hidden" name="actualizar" id="actualizar" value="">
                    <input type="hidden" name="cad_actt" id="cad_actt" value="">
                    <input type="hidden" name="parti_eli" id="parti_eli" value="">
                    <input type="hidden" name="ultimo_reg" id="ultimo_reg" value="{{ $conn }}">


                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Fecha</label>
                                    <input id="fecha_t" type="text" class="form-control" name="fecha_t" value="{{ $fecha }}" readonly>
                                </div>                                
                                <div class="col-md-5">
                                    <label for="">Proveedor</label>
                                    <select id="proveedor" class="form-control" name="proveedor">                                        
                                        @foreach ($proveedor as $key => $proveedor_)
                                            <option value="{{$proveedor_->id}}">{{$proveedor_->nombre_comercial}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>

                                <div class="col-md-5">
                                    <label for="">Producto</label>
                                    <select id="producto" class="form-control" name="producto">                                        
                                        @foreach ($producto as $key => $producto_)
                                            <option value="{{$producto_->id}}">{{$producto_->nombre_generico}}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-2">
                                    <label for="">Tienda</label>
                                    <select id="tienda" class="form-control" name="tienda">                                        
                                        @foreach ($tienda as $key => $tienda_)
                                            <option value="{{$tienda_->tienda_id}}">{{$tienda_->desc_tienda}}</option>
                                        @endforeach
                                    </select>                                                                        
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="">Color</label>
                                    <select id="color" class="form-control" name="color">                                        
                                        @foreach ($color as $key => $color_)
                                            <option value="{{$color_->id_color}}">{{$color_->nombre}}</option>
                                        @endforeach
                                    </select>                                          
                                </div>   

                                <div class="col-md-2">
                                    <label for="">Partida</label>
                                    <input id="partida_t" type="text" class="form-control" name="partida_t" value="{{ $cad }}" placeholder="Partida" onkeypress="return tabular(event,this)" tabindex="1" disabled>
                                </div>

                                <div class="col-md-2">
                                    <label for="">Peso</label>
                                    <input id="peso_t" type="text" class="form-control" name="peso_t" value="" placeholder="Peso" onkeypress="return tabular(event,this)" tabindex="2" autofocus="autofocus">
                                </div>
                                <div class="col-md-2">
                                    <label for="">Rollos</label>
                                    <input id="rollos_t" type="text" class="form-control" name="rollos_t" value="" placeholder="Rollos" tabindex="3">
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
                                                X
                                            </th>
                                            
                                        
                                        </thead>
                                        <tbody style="text-align: center;">
                                            
                                            
                                        </tbody>
                                    </table>
                                    {!! $bandejatabla->render() !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">                                    
                                    <button class="btn btn-success">Guardar</button>
                                    <a href="{{ route('comercializacion.index')}}" class="btn btn-primary">Volver</a>         
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

        $('#rollos_t').numeric();
        $('#peso_t').numeric(",");
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
                nuevaFila+="<td>"+'<input type="hidden" name="cod_ndi_'+indice_tabla+'" id="cod_ndi_'+indice_tabla+'" value="0">'+indice_tabla+"</td>";
                
                nuevaFila+="<td>"+'<input type="hidden" name="fec_'+indice_tabla+'" id="fec_'+indice_tabla+'" value="'+$("#fecha_t").val()+'">'+$("#fecha_t").val()+"</td>";
                nuevaFila+="<td>"+'<input type="hidden" name="pro_'+indice_tabla+'" id="pro_'+indice_tabla+'" value="'+$("#producto").val()+'"><p id="Lpro_'+indice_tabla+'">'+$("#producto option:selected").html()+"</p></td>";
                nuevaFila+="<td>"+'<input type="hidden" name="tie_'+indice_tabla+'" id="tie_'+indice_tabla+'" value="'+$("#tienda").val()+'"><p id="Ltie_'+indice_tabla+'">'+$("#tienda option:selected").html()+"</p></td>";
                nuevaFila+="<td>"+'<input type="hidden" name="par_'+indice_tabla+'" id="par_'+indice_tabla+'" value="'+$("#partida_t").val()+'"><p id="Lpar_'+indice_tabla+'">'+$("#partida_t").val()+"</p></td>";
                nuevaFila+="<td>"+'<input type="hidden" name="col_'+indice_tabla+'" id="col_'+indice_tabla+'" value="'+$("#color").val()+'"><p id="Lcol_'+indice_tabla+'">'+$("#color option:selected").html()+"</td>";
                nuevaFila+="<td>"+'<input type="hidden" name="pes_'+indice_tabla+'" id="pes_'+indice_tabla+'" value="'+$("#peso_t").val()+'"><p id="Lpes_'+indice_tabla+'">'+$("#peso_t").val()+"</p></td>";
                nuevaFila+="<td>"+'<input type="hidden" name="roll_'+indice_tabla+'" id="roll_'+indice_tabla+'" value="'+$("#rollos_t").val()+'"><p id="Lroll_'+indice_tabla+'">'+$("#rollos_t").val()+"</p></td>";

                nuevaFila+="<td>"+'<input type="checkbox" id="cbox_'+indice_tabla+'" value="">'+"</td>";
                // Añadimos una columna con el numero total de columnas.
                // Añadimos uno al total, ya que cuando cargamos los valores para la
                // columna, todavia no esta añadida
                nuevaFila+='<td><div class="btn btn-link" onclick="delTabla('+indice_tabla+')" >X</div>';
                //nuevaFila+='<td><div class="btn btn-link" onclick="editar('+indice_tabla+')" >E</div>';
                nuevaFila+="</tr>";
                $("#bandeja-produccion").append(nuevaFila);

                var canti=$("#ultimo_reg").val();
                $("#ultimo_reg").val(++canti);
                //alert($("#ultimo_reg").val().length);
                var cad="PA";
                for(i=$("#ultimo_reg").val().length;i<11;i++)
                {
                    cad+="0"
                }
                cad+=$("#ultimo_reg").val();

                $("#partida_t").val(cad);
            }   

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
            addtabla("{{ $tab_bandeja->dNotInga_id }}","{{ $tab_bandeja->fecha }}","{{ $tab_bandeja->id }}","{{ $tab_bandeja->nombre_especifico }}","{{ $tab_bandeja->tienda_id }}","{{ $tab_bandeja->desc_tienda }}","{{ $tab_bandeja->partida }}","{{ $tab_bandeja->id_color }}","{{ $tab_bandeja->nombre }}","{{ $tab_bandeja->peso_cant }}","{{ $tab_bandeja->rollo }}","{{ $tab_bandeja->impreso }}");
        @endforeach

    });

    $(document).bind('keydown',function(e){
        if ( e.which == 27 ) 
        {
            cancelar();
        };
    });


    $("#rollos_t").bind('keydown',function(e){
        if ( e.which == 13 ) 
        {
            $('#add').click();
        };
    });            
    

        function addtabla(cod,fec,procod,prod,tiecod,tie,par,colid,col,pes,roll,imp)
        {        
            indice_tabla++;
            $("#conta").val(indice_tabla);
            var nuevaFila="<tr id=fila_"+indice_tabla+">";
            nuevaFila+="<td>"+'<input type="hidden" name="cod_ndi_'+indice_tabla+'" id="cod_ndi_'+indice_tabla+'" value="'+cod+'">'+indice_tabla+"</td>";
            
            nuevaFila+="<td>"+'<input type="hidden" name="fec_'+indice_tabla+'" id="fec_'+indice_tabla+'" value="'+fec+'">'+fec+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="pro_'+indice_tabla+'" id="pro_'+indice_tabla+'" value="'+procod+'"><p id="Lpro_'+indice_tabla+'">'+prod+"</p></td>";
            nuevaFila+="<td>"+'<input type="hidden" name="tie_'+indice_tabla+'" id="tie_'+indice_tabla+'" value="'+tiecod+'"><p id="Ltie_'+indice_tabla+'">'+tie+"</p></td>";
            nuevaFila+="<td>"+'<input type="hidden" name="par_'+indice_tabla+'" id="par_'+indice_tabla+'" value="'+par+'"><p id="Lpar_'+indice_tabla+'">'+par+"</p></td>";
            nuevaFila+="<td>"+'<input type="hidden" name="col_'+indice_tabla+'" id="col_'+indice_tabla+'" value="'+colid+'"><p id="Lcol_'+indice_tabla+'">'+col+"</td>";
            nuevaFila+="<td>"+'<input type="hidden" name="pes_'+indice_tabla+'" id="pes_'+indice_tabla+'" value="'+pes+'"><p id="Lpes_'+indice_tabla+'">'+pes+"</p></td>";
            nuevaFila+="<td>"+'<input type="hidden" name="roll_'+indice_tabla+'" id="roll_'+indice_tabla+'" value="'+roll+'"><p id="Lroll_'+indice_tabla+'">'+roll+"</p></td>";

            nuevaFila+="<td>"+'<input type="checkbox" id="cbox_'+indice_tabla+'" value="" '+((imp==1)?"checked":"")+'>'+"</td>";
            // Añadimos una columna con el numero total de columnas.
            // Añadimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta añadida
            nuevaFila+='<td><div class="btn btn-link" id="cdel_'+indice_tabla+'"  onclick="delTabla('+indice_tabla+')" >X</div>';
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
                

                if($("#par_"+id).val()!="")
                {
                    var datos2=$("#parti_eli").val()+","+$("#par_"+id).val();
                    $("#parti_eli").val(datos2);
                }

                $("#fila_"+id).remove();
            }            
        }

        /*function editar(id)
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
        }

        function actualiza()
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
            
            //si hay agregar al input .... el código

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
        }
        */
         function anular(e) {
              tecla = (document.all) ? e.keyCode : e.which;
              return (tecla != 13);
         }
         function validacion()
         {
            //var par_=$.trim($("#partida_t").val());
            var pes_=$.trim($("#peso_t").val());
            var rol_=$.trim($("#rollos_t").val());
            var key_error=false;
            
            /*if(par_=="")
            {
                $("#partida_t").css("border","2px solid #f00");                
                key_error=true;
            }
            else
                $("#partida_t").css("border","1px solid #d2d6de");
            */
            if(pes_=="")
            {
                $("#peso_t").css("border","2px solid #f00");                
                key_error=true;
            }
            else
                $("#peso_t").css("border","1px solid #d2d6de");

            if(rol_=="")
            {
                $("#rollos_t").css("border","2px solid #f00");
                key_error=true;
            }
            else
                $("#rollos_t").css("border","1px solid #d2d6de");

            return (key_error)?1:0;
         }


    </script>
    <script>
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
   </script>
@endpush('scripts')