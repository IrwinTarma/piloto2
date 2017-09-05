@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Color</div>
                    <div class="panel-body">

                        <a href="{{ url('/color/create') }}" class="btn btn-primary btn-xs" title="Add New TiposPago"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="table-color">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Nombre </th><th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($colores) > 0)
                                @foreach($colores as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>
                                            <a href="{{ url('/color/' . $item->id) }}" class="btn btn-success btn-xs" title="View TiposPago"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/color/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit TiposPago"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{ Html::script('js/master/color.js') }}
@endpush