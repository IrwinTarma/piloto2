@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Color</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/proveedor_color_producto', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('master.proveedor_color_producto.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{ Html::script('js/master/proveedor_color_producto.js') }}
@endpush