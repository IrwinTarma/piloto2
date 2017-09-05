@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Proveedor</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/proveedor/proveedores', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('proveedores.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{ Html::script('js/master/proveedor.js') }}
@endpush