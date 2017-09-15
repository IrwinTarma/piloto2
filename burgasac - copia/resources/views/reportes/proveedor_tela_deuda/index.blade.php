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
        @include('reportes/proveedor_tela_deuda/filtro')
      </div>
      <div>
        <table class="table table-striped table-bordered dt-responsive nowrap" id="table-reporte"  cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>F. Registro</th>
              <th>Producto</th>
              <th>Proveedor</th>
              <th>Color</th>
              <th>Peso (Kg)</th>
              <th>Total</th>                              
            </tr>
          </thead>
        </table>
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
<script type="text/javascript">
  url = "proveedor_tela_deuda";
</script>
{{ Html::script('js/reportes.js') }}
{{ Html::script('js/reportes/proveedor_deuda_tela.js') }}
<script type="text/javascript">
  Reporte.buscar();
  $(".btn-search").click(function() {
    Reporte.buscar();
  });
</script>
@endpush
