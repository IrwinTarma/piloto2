@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cargo {{ $cargo->id }}</div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $cargo->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $cargo->nombre }} </td></tr>
                                    <tr><th> Estado </th><td> {{ $cargo->estado }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection