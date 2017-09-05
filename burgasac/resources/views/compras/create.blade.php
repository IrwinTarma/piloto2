@extends('backend.layouts.appv2')

@section('after-styles')
    <style type="text/css">
        .block_nro_comprobante{display: none;}
    </style>
    <link rel="stylesheet" href="{{ asset("plugins/sweetalert/sweetalert.min.css") }}">
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nueva Compra</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/compra/compras', 'class' => 'form-horizontal', 'files' => true, 'id' => 'compra-form']) !!}

                        @include ('compras.form')

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('compra/compras') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar Compra', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
    <script type="text/javascript">
        var insumos = <?php echo json_encode($insumos); ?>;
        var titulos_insumos = <?php echo json_encode($titulos_insumo); ?>;
        var i = 1;
    </script>
@stop
@push('scripts')
{{ Html::script('plugins/sweetalert/sweetalert.min.js') }}
{{ Html::script('js/utils.js') }}
{{ Html::script('js/procesos/compra.js') }}
@endpush