@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New TiposPago</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/tipospago/tipos-pago', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('tipos-pago.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection