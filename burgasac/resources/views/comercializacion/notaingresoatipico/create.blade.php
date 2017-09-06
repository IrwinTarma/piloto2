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
                <div class="panel-heading">NOTA DE INGRESO ATIPICO</div>
                <div class="panel-body">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Fecha</label>
                                    <input id="fecha" type="text" class="form-control" name="fecha" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Proveedor</label>
                                    <input id="proveedor" type="text" class="form-control" name="proveedor">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Producto</label>
                                    <input id="producto" type="text" class="form-control" name="producto">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Tienda</label>
                                    <select class="form-control" name="tienda" id="tienda">
                                        <option value="">Todos</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row">   
                                
                                <div class="col-md-2">
                                    <label for="">Peso</label>
                                    <input id="peso" type="text" class="form-control" name="peso" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">Rollos</label>
                                    <input id="rollos" type="text" class="form-control" name="rollos" >
                                </div>
                                <div class="col-md-2">
                                    <label for="">Color</label>
                                    <input id="color" type="text" class="form-control" name="color">
                                </div>
                                <div class="col-md-6" style="text-align:right;">
                                    <br>
                                    <a href="#"  id="buscar-tabla" class="btn btn-primary">agregar</a>
                                </div>
                 
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <table id="bandeja-produccion" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <th>
                                            Item
                                        </th>
                                        <th>
                                            Fecha
                                        </th>
                                        <th>
                                            Producto
                                        </th>
                                        <th>
                                            Tienda
                                        </th>
                                        <th>
                                            Partida
                                        </th>
                                        <th>
                                            Color
                                        </th>
                                        <th>
                                            Peso
                                        </th>
                                        <th>
                                            Rollos
                                        </th>
                                        <th>
                                            Print
                                        </th>
                                        <th>
                                            Color
                                        </th>
                                        <th>
                                            X
                                        </th>
                                        
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

@endsection

