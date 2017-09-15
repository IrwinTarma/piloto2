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
    <div>
      <div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Stock General de Materia Prima</div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <form class="" action="{{route('reportes.resumen_descargar')}}" method="get">
                          <div class="col-md-2">
                            <label for="">Accesorio</label>
                            <select id="accesorio_stock" class="form-control" name="accesorio">
                              <option value="">Todos</option>
                              @foreach ($accesorios as $key => $accesorio)
                                <option value="{{$accesorio->id}}">{{$accesorio->nombre}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label for="">Insumos</label>
                            <select id="insumo_stock" class="form-control" name="insumo">
                              <option value="">Todos</option>
                              @foreach ($insumos as $key => $insumo)
                                <option value="{{$insumo->id}}">{{$insumo->nombre_generico}}</option>
                              @endforeach
                            </select>

                          </div>
                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <a href="#" id="buscar-tabla-stocks" class="btn btn-primary">Buscar</a>
                          </div>
                          <div class="col-md-2">
                            <label for="">Opción</label><br>
                            <button type="submit"  class="btn btn-primary">Descargar</a>
                          </div>
                        </form>

                      </div>
                    </div>
                    <div class="col-md-12">
                    <br>
                    <table id="stocks" class="table table-striped table-bordered table-hover">
                      <thead>
                        <tr>
                        <th>Proveedor</th>
                          <th>
                            Lote
                          </th>
                          <th>
                            Materia Prima/Accesorio
                          </th>
                          <th>Titulo</th>
                          <th>
                            P.Neto / Cant.
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>

@endsection

@section('after-scripts')
    {{ Html::script('plugins/listjs/list.min.js') }}
    <script>
        var options = {
            valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'nro_guia', 'peso', 'estado' ]
        };
        var userList = new List('compras', options);
    </script>

    <script>
        /* show / hide order details */
        $(".detalle").click(function() {
          $(this).closest("tr").next().toggle('fast');
          if($(this).text() == '[ + ]')
            $(this).text('[ - ]');
          else
            $(this).text('[ + ]');
        });


    </script>
@stop
@push('scripts')
{{ Html::script('js/reportes/stock_general.js') }}
@endpush