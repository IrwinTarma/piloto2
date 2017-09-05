@extends('backend.layouts.app')

@section('after-styles')
    <style type="text/css">
        #select_accesorio{display: none;}
    </style>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Planeamiento {{ "PLA". leadZero($planeamiento->id) }}</div>
                    <div class="panel-body">

                        <!--
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        -->

                        {!! Form::model($planeamiento, [
                            'method' => 'PATCH',
                            'url' => ['/planeamientos/planeamientos', $planeamiento->id],
                            'class' => 'form-horizontal',
                            'id' => 'planeamiento-form',
                            'files' => true
                        ]) !!}


                        <div class="row">
                            <div class="col-md-4">
                              @foreach ($planeamiento->detalles as $i => $detalle)
                                {!! Form::label('fecha', 'Fecha de Registro :   ', ['class' => 'fillable control-label']) !!}
                                <input type="hidden" name="detalles[{{$i}}][fecha]" value="{{date('Y-m-d', strtotime($detalle->fecha))}}">
                                    {{date('Y-m-d', strtotime($detalle->fecha))}}
                                <!-- {!! Form::date(strtotime($detalle->fecha), date('Y-m-d'), ['class' => 'form-control','required'=> '']) !!} -->
                                @endforeach
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::label('proveedor', 'Proveedor', ['class' => 'fillable control-label']) !!}
                                <select class="form-control" name="proveedor" required disabled="">
                                  @foreach ($proveedores as $key => $proveedor)
                                    @if (isset($planeamiento))
                                      <option value="{{$proveedor->id}}" {{$proveedor->id == $planeamiento->proveedor_id? 'selected':''}}>{{$proveedor->nombre_comercial}}</option>
                                    @else
                                      <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('empleado', 'Tejedor', ['class' => 'fillable control-label']) !!}
                                <select class="form-control" name="empleado" required disabled="">
                                  @foreach ($empleados as $key => $empleado)
                                    @if (isset($planeamiento))
                                      <option value="{{$empleado->id}}" {{$empleado->id == $planeamiento->empleado_id}} >{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @else
                                      <option value="{{$empleado->id}}">{{$empleado->nombres}} {{$empleado->apellidos}}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('turno', 'Turno', ['class' => 'fillable control-label']) !!}
                                <select class="form-control" name="turno" required disabled="">
                                  <option value="Mañana">Mañana</option>
                                  <option value="Tarde">Tarde</option>
                                  <option value="Noche">Noche</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::label('maquina', 'Maquina', ['class' => 'fillable control-label']) !!}
                                <select name="maquina" id="proveedor" class="form-control"  required disabled="">
                                    <option></option>
                                    @foreach ($maquinas as $key => $maquina)
                                      @if (isset($planeamiento))
                                        <option value="{{$maquina->id}}" {{$maquina->id == $planeamiento->maquina_id? 'selected':''}} >{{$maquina->nombre}}</option>
                                      @else
                                        <option value="{{$maquina->id}}">{{$maquina->nombre}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                  {!! Form::label('producto_prod', 'Producto a prod.', ['class' => 'fillable control-label']) !!}

                                <select name="producto" id="select_insumo" class="fillable form-control" required disabled="">
                                  <option value=""></option>
                                  @foreach ($productos as $key => $producto)
                                    @if (isset($planeamiento))
                                      <option value="{{$producto->id}}" {{$producto->id == $planeamiento->producto_id? 'selected':''}} >{{$producto->nombre_generico}}</option>
                                    @else
                                      <option value="{{$producto->id}}">{{$producto->nombre_generico}}</option>
                                    @endif
                                  @endforeach
                                </select>
                            </div>

                        </div>
                        <h3>Accesorios</h3>
                        <div class="row">
                            @foreach ($planeamiento->detalles as $i => $detalle)
                              <input type="hidden" name="currentAccesorio" value={{$detalle->accesorio_id}}>
                            @endforeach

                            <div class="col-md-4">
                              {!! Form::label('accesorio', 'Accesorio', ['class' => 'fillable control-label']) !!}

                              <select name="accesorio" id="select_titulo" class="form-control" disabled="">
                                @foreach ($accesorios as $key => $accesorio)
                                  <option value="{{$accesorio->id}}">{{$accesorio->nombre}}</option>
                                @endforeach
                              </select>
                            </div>


                            <div class="col-md-4">
                                {!! Form::label('cantidad', 'Cantidad', ['class' => 'fillable control-label']) !!}
                                {!! Form::number('cantidad', null, ['class' => 'onlynumbers fillable form-control', 'disabled'=>'disabled']) !!}
                            </div>
                        </div>
                        <h3>Materia Prima</h3>
                        <div class="row">

                            <div class="col-md-4">
                              {!! Form::label('lote', 'Lote', ['class' => 'fillable control-label']) !!}
                              <select name="lote_insumo" id="select_titulo" class="form-control" disabled="">
                                <option></option>
                                @foreach ($lotes_insumo as $key => $lote)
                                  @if(isset($planeamiento))
                                      @foreach ($planeamiento->detalles as $i => $detalle)
                                    <!-- <input class="form-control" type="number" name="detalles[{{$i}}][lote_insumo]" value="{{$detalle->lote_insumo}}"> -->
                                        <option value="{{$lote->lote}}" {{$lote->lote == $detalle->lote_insumo? 'selected':''}} >{{$lote->lote}}</option>
                                      @endforeach
                                  @else
                                    <option value="{{$lote->lote}}">{{$lote->lote}}</option>
                                  @endif
                                @endforeach
                              </select>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('insumo', 'Materia prima', ['class' => 'fillable control-label']) !!}
                                <select class="form-control" name="insumo" disabled="">
                                  <option value=""></option>

                                  @foreach ($insumos as $key => $insumo)
                                    <option value="{{$insumo->id}}" {{$insumo->id == $detalle->insumo_id? 'selected':''}} >{{$insumo->nombre_generico}}</option>
                                  @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                {!! Form::label('lote', 'Titulo', ['class' => 'fillable control-label']) !!}
                                <select name="titulo" id="select_titulo" class="form-control" disabled="">
                                  <option value=""></option>
                                  @foreach ($titulos as $key => $titulo)
                                    <option value="{{$titulo->id}}" {{$titulo->id == $detalle->titulo_id? 'selected':''}} >{{$titulo->nombre}}</option>
                                  @endforeach
                                </select>
                            </div>

                        </div>
                        <!-- <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <a id="add_to_grid" class="btn btn-primary" href="#">Agregar al Detalle</a>
                            </div>
                        </div> -->



                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
    <script>
    var currentStock;
    function getCurrentStock() {
      console.log('ajax');
      var accesorio = $("[name='accesorio']").val();
      console.log(accesorio);
      var proveedor = $("[name='proveedor']").val();
      console.log(proveedor);

      $.ajax({
        url: '{{url('insumo')}}' + '/' + accesorio + '/proveedor/' + proveedor + '/stock',
        success:function (stock) {
          console.log('accs');
          currentStock = stock;
          console.log(currentStock);
        }
      });
    }

        $(function() {
          $('[name="accesorio"]').val($('[name="currentAccesorio"]').val());
          getCurrentStock();
          $.ajax({
            url: '{{url('compras/accesorios')}}' + '/'+$("[name='accesorio']").val() + '/lotes',
            success:function (lotes) {
              $("[name='lote_accesorio']").empty();
              for (var i = 0; i < lotes.length; i++) {
                $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
              }
            }
          })
            /* TAB FOCUS */
            $('#select_materia_prima').focus();

            /* make enter key act like tab key */
            $('input').keypress(function(e) {
                if (e.which == 13) {
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    e.preventDefault();
                }
            });

            $('input#cantidad_paquetes').keypress(function (e) {
               if (e.which == 13) {
                    $('#add_to_grid').click();
                    $('#select_materia_prima').focus();
                    e.preventDefault();
                }
            });

            $("[name='accesorio']").change(function () {
              var id = $(this).val();
              $.ajax({
                url: '{{url('compras/accesorios')}}' + '/'+id + '/lotes',
                success:function (lotes) {
                  $("[name='lote_accesorio']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            });

            $("[name='insumo']").change(function () {
              var id = $(this).val();
              $.ajax({
                url: '{{url('compras/insumos')}}' + '/'+id+'/lotes',
                success:function (lotes) {
                  $("[name='lote_insumo']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            });


            /* VALIDATIONS */
            $(".onlynumbers").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl/cmd+A
                    (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: Ctrl/cmd+C
                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: Ctrl/cmd+X
                    (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            /* FUNCIONALITY */
            /* On selected value: insumo or accesorio */
            $('#select_materia_prima').change(function () {
                if ( $(this).val() == 'materia_prima' ){
                    $('#select_accesorio').hide();
                    $('#select_insumo').show();
                }
                else{
                    $('#select_accesorio').show();
                    $('#select_insumo').hide();
                }
            });

            $("[name='cantidad']").keydown(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(currentStock)) return $(this).val(currentStock);
           }).keyup(function () {
             var lastVal = $(this).val();
             if(Number($(this).val())>Number(currentStock)) return $(this).val(currentStock);
           });

           $("[name='accesorio']").change(function () {
             var id = $(this).val();
             $("[name='lote_accesorio']").trigger("change");
             $.ajax({
                 url: '{{url('compras/accesorios')}}' + '/' + id + '/lotes',
                 success:function (lotes) {
                   $("[name='lote_accesorio']").empty();
                   for (var i = 0; i < lotes.length; i++) {
                     $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
                   }
                   getCurrentStock();
                 }
             })

           });

           $("[name='lote_insumo']").change(function () {
              var id = $(this).val();
              $.ajax({
               url: '{{url('compras/lote')}}' + '/'+id+'/detalles-insumo',

               success:function (detalles) {
                 $("[name='titulo']").empty();
                 $("[name='insumo']").empty();
                 for (var i = 0; i < detalles.length; i++) {
                   $("[name='titulo']").append('<option value="' + detalles[i].titulo_id   +'" >' + detalles[i].nombre_titulo +'</option>');
                   $("[name='insumo']").append('<option value="' + detalles[i].insumo_id   +'" >' + detalles[i].nombre_insumo +'</option>');
                 }
               }
               });
           })


            /* On selected value, update var accesorio */
            $('#select_insumo').change(function () {
                $('#select_accesorio').val('');
            });
            /* On selected value, update var insumo */
            $('#select_accesorio').change(function () {
                $('#select_insumo').val('');
            });

            /* planeamiento action */
            var i = <?php echo count($planeamiento->detalles)  ?>;

            <?php
            /* guardando lotes de grilla detalles para evitar duplicados */
            if ( count($planeamiento->detalles) > 0){
                $array_nro_lotes = [];
                foreach ($planeamiento->detalles as $detalle) :
                    array_push($array_nro_lotes, "'" . $detalle->nro_lote . "'");
                endforeach;
                $array_nro_lotes = implode(",", $array_nro_lotes);
                echo 'var lotes_in_details = [' . $array_nro_lotes . '];';
            }
            ?>

            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#compra-form select#proveedor').attr('disabled', true);
            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#add_to_grid').click(function () {

                plan = function () {
                var a = [];
                $("#planeamientos_grid tbody tr").not(":first").each(function () {
                  debugger;
                  var turno = $(this).find(".turno").find("input").val();
                  var maquina = $(this).find(".maquina").find("select").length? $(this).find(".maquina").find("select").val(): $(this).find(".maquina").find("input").val();
                  a.push(turno+maquina);
                  });
                  return a;
                };



                var fecha_registro = $("[name='fecha']").val(),
                    proveedor = $("[name='proveedor']").val(),
                    empleado = $("[name='empleado']").val(),
                    turno = $("[name='turno']").val(),
                    maquina = $("[name='maquina']").val(),
                    producto = $("[name='producto']").val(),
                    lote_accesorio = $("[name='lote_accesorio']").val(),
                    accesorio = $("[name='accesorio']").val(),
                    cantidad = $("[name='cantidad']").val(),
                    lote_insumo = $("[name='lote_insumo']").val(),
                    insumo  = $("[name='insumo']").val(),
                    titulo  = $("[name='titulo']").val();


                if (fecha_registro!='' && proveedor != '' && empleado != '' && turno != '' && maquina != '' && producto != '' && lote_accesorio != '' && accesorio != '' && cantidad != '' && lote_insumo != '' && insumo != '' && titulo != '')
                {
                  var cod = turno+maquina;
                  console.log(plan());
                  if(plan().indexOf(cod)>=0) return alert('Ya existe un trabajador con esa maquina y turno');

                    $('#planeamientos_grid tbody tr:last').after('<tr>\
                        <td>' + add_hidden_button(i, 'fecha', fecha_registro) + fecha_registro + '</td>\
                        <td>' +  add_hidden_button(i, 'lote_insumo', lote_insumo) + $("[name='lote_insumo']").val() + '</td>\
                        <td>' +  add_hidden_button(i, 'insumo', insumo) + $("[name='insumo']").find("[value='"+ insumo +"']").html() + '</td>\
                        <td>' + add_hidden_button(i, 'titulo', titulo) + $("[name='titulo']").find("[value='"+ titulo +"']").html() + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + (insumo != ''? add_hidden_button(i, 'insumo_id', insumo) : add_hidden_button(i, 'accesorio_id', accesorio))
                        + '</td></tr>'
                    );
                }
                else
                {
                    alert('Para agregar al detalle complete los campos requeridos:\
                        \n- Fecha Registro\
                        \n- Número de Lote\
                        \n- Producto\
                        \n- Marca\
                        \n- Titulo\
                        \n- Peso Bruto\
                        \n- Peso Tara\
                        \n- Cantidad de Caja/Bolsas')
                }

                return false;
            });

            /* actualizar peso_neto */
            $('#compras_grid tbody tr td.show_peso_bruto input').on('keyup', function() {
                show_peso_bruto = $(this).val();
                show_peso_tara = $(this).parent().parent().find('td.show_peso_tara input').val();
                show_peso_neto = show_peso_bruto - show_peso_tara;
                $(this).parent().parent().find('td.show_peso_neto').html(show_peso_neto);
            });

            $('#compras_grid tbody tr td.show_peso_tara input').on('keyup', function() {
                show_peso_tara = $(this).val();
                show_peso_bruto = $(this).parent().parent().find('td.show_peso_bruto input').val();
                show_peso_neto = show_peso_bruto - show_peso_tara;
                show_peso_neto = parseFloat(Math.round( show_peso_neto * 100) / 100).toFixed(2);
                $(this).parent().parent().find('td.show_peso_neto').html(show_peso_neto);
            });

            /* eliminar tr */
            $('body').on('click', 'a.eliminar', function () {
                $(this).parent().parent().remove();
            });

        });
    </script>
@stop
