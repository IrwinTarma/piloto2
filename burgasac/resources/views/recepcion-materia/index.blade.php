@extends('backend.layouts.appv2')

@section('after-styles')
    <style>
    .dropdown{padding: 0;}
    .dropdown .dropdown-menu{border: 1px solid #999}
    .detallescompra{
        display: none;
        background-color: #ececec;
    }
    </style>
@stop

@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">Recepcion de materia</div>
              <div class="panel-body">

                  <a href="{{ url('/recepcion-mp/recepcion-mp/create') }}" class="btn btn-primary btn-xs" title="Nueva Compra"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                  <br/>
                  <br/>

                  <div id="compras">
                      <div class="row">
                          <div class="col-md-4 pull-right">
                              <input class="search form-control" placeholder="Filtrar Resultados" />
                          </div>
                      </div>

                      <table class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th></th>
                                  <th>Id</th>
                                  <th> U. Fecha Actualizacion </th>
                                  <th>Codigo</th>
                                  <th>Guía</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody class="list">
                          @foreach($recepciones as $item)
                              <tr>
                                  <td><span class="btn btn-info detalle">[ + ]</span></td>
                                  <td>{{ $item->id}}</td>
                                  <td class="updated_at">{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                                  <td class="codigo">{{ leadZero($item->codigo) }}</td>
                                  <td class="nro_guia">{{ $item->nro_guia }}</td>
                                  <td>

                                      {!! Form::open([
                                          'method'=>'DELETE',
                                          'url' => ['/recepcion-mp/recepcion-mp', $item->id],
                                          'style' => 'display:inline'
                                      ]) !!}

                                      {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Deshabilitar Compra" />', array(
                                                  'type' => 'submit',
                                                  'class' => 'btn btn-danger btn-xs',
                                                  'title' => 'Deshabilitar Recepcion',
                                                  'onclick'=>'return confirm("Confirmar?")'
                                          )) !!}
                                      {!! Form::close() !!}
                                  </td>
                              </tr>

                              <tr class="detallescompra">
                                  <td colspan="9">
                                      <table class="table table-striped table-bordered table-hover">
                                          <thead>
                                              <th>F. Registro</th>
                                              <th>Lote</th>
                                              <th>Producto</th>
                                              <th>P. Bruto</th>
                                              <th>P.Tara</th>
                                              <th>P.Neto</th>
                                          </thead>
                                      <?php foreach ($item->detalles as $detalle) : ?>
                                          <tr colspan="9">
                                              <td><?php echo $detalle->fecha ?></td>
                                              <td><?php echo $detalle->nro_lote ?></td>
                                              <td><?php echo $detalle->insumo_id? 'Insumo: ' . $detalle->insumo['nombre_generico'] : 'Accesorio: ' . $detalle->accesorio['nombre'] ?></td>
                                              <td><?php echo $detalle->peso_bruto ?></td>
                                              <td><?php echo $detalle->peso_tara ?></td>
                                              <td><?php echo $detalle->peso_bruto - $detalle->peso_tara ?></td>
                                          </tr>
                                      <?php endforeach ?>
                                      </table>
                                  </td>
                              </tr>

                          @endforeach
                          </tbody>
                      </table>
                      <div class="pagination-wrapper"> {!! $recepciones->render() !!} </div>
                  </div><!-- /#compras -->
              </div>
          </div>
      </div>
  </div>

@endsection

@section('after-scripts')
    {{ Html::script('plugins/listjs/list.min.js') }}
    <script type="text/javascript">
      $(function () {
        // var today = new Date();
        // var dd = today.getDate();
        // var mm = today.getMonth()+1; //January is 0!
        //
        // var yyyy = today.getFullYear();
        // if(dd<10){dd='0'+dd}
        // if(mm<10){mm='0'+mm}
        // today = yyyy+'-'+mm+'-'+dd;
        //
        // $("#fecha_table").attr('value',today);
        // $("#proveedor_table").change(function () {
        //   bandeja.ajax.reload()
        // });
        //
        // $("#empleado_table").change(function () {
        //   bandeja.ajax.reload()
        // });
        //
        // $("#fecha_table").change(function () {
        //   bandeja.ajax.reload();
        // });

        $("#buscar-tabla").click(function () {
          bandeja.ajax.reload();
          return false;
        })

        bandeja = null;

        function deletePlaneamientoDetalle() {

        }
      })
    </script>


@stop
@push('scripts')
{{ Html::script('js/procesos/recepcion-materia-prima.js') }}
@endpush