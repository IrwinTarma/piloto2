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
                    <div class="panel-heading">DESPACHO A TINTORERIA</div>
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

                        {!! Form::model([], [
                            'method' => 'POST',
                            'url' => '/despacho-tintoreria/despacho-tintoreria',
                            'class' => 'form-horizontal',
                            'id' => 'planeamiento-form'
                        ]) !!}

                        @include ('tintoreria.form', ['submitButtonText' => 'Actualizar'])

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('planeamiento/planeamientos') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar despacho de tintoreria', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
    <script>
        $(function() {
          $.ajax({
            url:'{{url("compras/accesorios")}}'+'/'+$("[name='accesorio']").val() + '/lotes',
            success:function (lotes) {
              $("[name='lote_accesorio']").empty();
              for (var i = 0; i < lotes.length; i++) {
                $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
              }
            }
          });

            /* planeamiento action */

            $('#compra-form select#proveedor').attr('disabled', true);
        });
    </script>
@stop
@push('scripts')
{{ Html::script('js/procesos/despacho_tintoreria.js') }}
@endpush
