@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Proveedores {{ $proveedor->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($proveedor, [
                            'method' => 'PATCH',
                            'url' => ['/proveedor/proveedores', $proveedor->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('proveedores.form', ['submitButtonText' => 'Actualizar'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{ Html::script('js/master/proveedor.js') }}
<script type="text/javascript">
    $(".tipo").each(function(){
        if ($(this).is(":checked")) {
            if ($(this).val() == 4) {
                $(".contenedor-colores").css("display", "inline-block");
                $(".color").removeAttr("disabled");
            }
        }
    });
</script>
@endpush