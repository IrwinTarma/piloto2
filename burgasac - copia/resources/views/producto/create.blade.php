@extends('backend.layouts.appv2')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Producto</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/producto/productos', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('producto.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
@stop
@push('scripts')
{{ Html::script('js/master/producto.js') }}
@endpush