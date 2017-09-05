@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit TiposAbono {{ $tiposabono->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($tiposabono, [
                            'method' => 'PATCH',
                            'url' => ['/tiposabono/tipos-abono', $tiposabono->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('tipos-abono.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection