@extends('backend.layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Nuevo Cronograma</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['action' => 'Cronograma\\CronogramasController@store', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('cronogramas.form')

                        {!! Form::close() !!}

                        
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo de Pago</th>
                                        <th>Banco</th>
                                        <th>Forma de Pago</th>
                                        <th> Cuotas </th>
                                        <th>Fecha</th>
                                        <th> Monto </th>
                                        <th> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cronogramas as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tipo_de_pago? 'Crédito' : 'Contado' }}</td>
                                        <td>{{ $item->banco['nombre'] }}</td>
                                        <td>{{ $item->tipopago['nombre'] }}</td>
                                        <td>{{ $item->cuotas }}</td>
                                        <td>{{ date('Y-m-d', strtotime($item->fecha)) }}</td>
                                        <td>{{ $item->monto }}</td>
                                        <td>
                                            <!--
                                            <a href="{{ url('/cronograma/cronogramas/' . $item->id) }}" class="btn btn-success btn-xs" title="View Cronograma"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/cronograma/cronogramas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Cronograma"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            -->
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/cronograma/cronogramas', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Cronograma" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Cronograma',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('after-scripts')
    <script>
        $(function() {
            $(".onlynumbers").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl/cmd+A
                    (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: Ctrl/cmd+C
                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: Ctrl/cmd+X
                    (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
        });

        $('input.radio_contado').click(function (e) {
            $('select#banco_id').prop('disabled', true);
            $('select#tipopago_id').prop('disabled', true);
            $('input#cuotas').prop('disabled', true);
            $('.hideable').toggle();
        })

        $('input.radio_credito').click(function (e) {
            $('select#banco_id').prop('disabled', false);
            $('select#tipopago_id').prop('disabled', false);
            $('input#cuotas').prop('disabled', false);
            $('.hideable').toggle();
        })
    </script>
@stop