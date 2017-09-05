@extends('backend.layouts.appv2')

@section('after-styles')
    <style type="text/css">
        #select_accesorio{display: none;}
    </style>
@stop

@section('content')


        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo planeamiento</div>
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

                        {!! Form::open(['url' => '/planeamientos/planeamientos', 'class' => 'form-horizontal', 'files' => true, 'id' => 'planeamiento-form']) !!}

                        @include ('planeamientos.form')


                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('planeamientos/planeamientos') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar planeamiento', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
@stop
@push("scripts")
{{ Html::script('js/procesos/planeamiento.js') }}
<script>
    var currentStock;
    Planeamiento.getCurrentStock();
    var plan = function () {
      var a = [];
      $("#compras_grid tbody tr").not(":first").each(function () {
        debugger;
        var turno = $(this).find(".turno").find("input").val();
        var maquina =  $(this).find(".maquina").find("input").val();
        var lote_insumo = $($(this).find(".insumo").find("input").get(0)).val();
        var lote_accesorio = $($(this).find(".accesorio").find("input").get(1)).val();
        a.push(turno+maquina+lote_insumo+lote_accesorio);
      });
      return a;
    };
        $(function() {
            /* TAB FOCUS */
            $('#select_materia_prima').focus();
            $('[name="accesorio"]').val('');






            /*$("[name='lote_accesorio']").change(function () {
              var insumo = 1;
              var proveedor = $("[name='proveedor']").val();
              var lote = $(this).val();
              $.ajax({
                url: '{{url('insumo')}}' + '/' + insumo + '/proveedor/' + proveedor + '/lote/' + lote + '/stock',
                success:function (stock) {
                  currentStock = stock;
               }
              });
            });*/

            $("[name='lote_accesorio']").change(function () {
               var id = $(this).val();
               $.ajax({
                url: '{{url('compras/lote')}}' + '/'+id+'/detalles-accesorio',

                success:function (detalles) {
                  $("#select_titulo_insumo").empty();
                  $("[name='cantidad']").empty();
                  for (var i = 0; i < detalles.length; i++) {
                    $("[name='accesorio']").append('<option value="' + detalles[i].accesorio_id   +'" >' + detalles[i].nombre_accesorio +'</option>');
                    $("[name='cantidad']").val(detalles[i].cantidad);
                  }
                }
                });
            })

            /*$("[name='insumo']").change(function () {
              var id = $(this).val();
               $("[name='lote_insumo']").trigger("change");
              $.ajax({
                //url:'/compras/insumos/'+id+'/lotes',
                url: '{{url('compras/insumos')}}' + '/' + id + '/lotes',
                success:function (lotes) {
                  $("[name='lote_insumo']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            })*/

        });
    </script>
@endpush("script")