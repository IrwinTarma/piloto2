@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Color {{ $obj->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($obj, [
                            'method' => 'PATCH',
                            'url' => ['/proveedor_color_producto', $obj->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('master.proveedor_color_producto.form', ['submitButtonText' => 'Actualizar'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{ Html::script('js/master/proveedor_color_producto.js') }}

<script type="text/javascript">
    var obj = <?php  echo json_encode($obj);?>;
    colorseleccionado = obj.color_id;
    proveedorseleccionado = obj.proveedor_id;
    ProveedorColorProducto.colorPorProveedor(proveedorseleccionado);
    setTimeout(function(){
        $("#color").val(colorseleccionado);
    }, 200);
</script>
@endpush