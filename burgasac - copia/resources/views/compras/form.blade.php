<div class="row">
    <div class="col-md-4">
        {!! Form::label('fecha', 'Fecha', ['class' => 'control-label']) !!}
        @if(isset($esRecepcionado))
            @if($esRecepcionado)
                {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control','readonly', 'id' => 'fecha']) !!}
            @else
                {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control', 'id' => 'fecha']) !!}
            @endif
        @else
            {!! Form::text('fecha', date('Y-m-d'), ['class' => 'form-control', 'id' => 'fecha']) !!}
        @endif
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="col-md-4">
        {!! Form::label('procedencia', 'Procedencia', ['class' => 'control-label']) !!}
        <select name="procedencia_id" id="select_procedencia" class="form-control" {{isset($esRecepcionado)? ( $esRecepcionado? 'readonly':'' ):''  }}>
            <option></option>
            @foreach($procedencias as $procedencia)
                @if (isset($compra))
                  <option value="{{$procedencia->id}}" {{$procedencia->id==$compra->procedencia_id? 'selected':''}} > {{$procedencia->nombre}}</option>
                @else
                  <option value="{{$procedencia->id}}"> {{$procedencia->nombre}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <br>
        {!! Form::label('con_factura', 'Con Factura', ['class' => 'control-label']) !!}
        {!! Form::checkbox('con_factura', true, false) !!}
        {!! $errors->first('con_factura', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="row">

    <div class="col-md-4">
        {!! Form::label('proveedor', 'Proveedor', ['class' => 'control-label']) !!}
        <select name="proveedor" id="proveedor" class="form-control {{isset($esRecepcionado)? ( $esRecepcionado? 'readonly':'' ):''  }}" {{isset($compra)? 'disabled=disabled' :''  }}>
            <option></option>
            @foreach ($proveedores as $key => $proveedor)
              @if (isset($compra))
                <option value="{{$proveedor->id}}" {{$proveedor->id==$compra->proveedor_id? 'selected':''}}>{{$proveedor->nombre_comercial}}</option>
              @else
                <option value="{{$proveedor->id}}">{{$proveedor->nombre_comercial}}</option>
              @endif
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <div class="block_nro_guia">
            {!! Form::label('nro_guia', 'Numero de Guia', ['class' => 'control-label']) !!}
            {!! Form::text('nro_guia', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <div class="block_nro_comprobante">
            {!! Form::label('nro_comprobante', 'Nro Factura', ['class' => 'control-label']) !!}
            {!! Form::text('nro_comprobante', null, ['class' => 'form-control']) !!}

                {!! $errors->first('nro_comprobante', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

<hr>

<div role="tabpanel">
    <!-- Nav tabs -->
    <ul id="optdetallecompra" class="nav nav-tabs" role="tablist">
        <li id="liaccesorios" role="presentation" class="active">
            <a href="#tab_accesorios" aria-controls="tab_accesorios" role="tab" data-toggle="tab">Accesorios</a>
        </li>
        <li id="limateriaprima" role="presentation">
            <a href="#tab_insumo" aria-controls="tab_insumo" role="tab" data-toggle="tab">Materia Prima</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab_accesorios">

            <div class="row">

                <div class="col-md-4">
                    {!! Form::label('accesorio', 'Accesorio', ['class' => 'control-label']) !!}

                    <select id="select_accesorio" class="form-control">
                        <option></option>
                        <?php foreach ($accesorios as $accesorio) : ?>
                            <option value="<?php echo $accesorio->id ?>"><?php echo $accesorio->nombre ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col-md-4">
                    {!! Form::label('titulo_acesorio', 'Titulo Accesorio', ['class' => 'control-label']) !!}
                    <select id="select_titulo_accesorio" class="form-control">
                        <option></option>
                        <?php foreach ($titulos_accesorio as $titulo_accesorio) : ?>
                            <option value="<?php echo $titulo_accesorio->id ?>"><?php echo $titulo_accesorio->nombre ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                

                <div class="col-md-4">
                    {!! Form::label('cantidad_accesorio', 'Cantidad (unid.)', ['class' => 'control-label']) !!}
                    {!! Form::text('cantidad', null, ['class' => 'onlynumbers fillable form-control']) !!}
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                </div>

                <div class="col-md-4">
                  @if(isset($esRecepcionado))
                      @if(!$esRecepcionado)
                        <br><a id="add_accesorio_to_grid" class="btn btn-primary" href="#">Agrega Accesorio</a>
                      @endif
                  @else
                    <br><a id="add_accesorio_to_grid" class="btn btn-primary" href="#">Agrega Accesorio</a>
                  @endif
                </div>

            </div>
            <?php
                $i = 0;
            ?>
            <div class="row">
                <div class="col-md-12">

                    <h3>Detalle de Accesorios</h3>
                    <table id="compras_grid_accesorio" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Accesorio</th>
                                <th>Cantidad</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($compra))
                              @foreach ($compra->accesorios as $key => $accesorio)
                                <tr>
                                  <td>
                                    <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$accesorio->titulo_id}}">
                                    {{$accesorio->titulo->nombre}}
                                  </td>
                                  <td>
                                    <input type="hidden" name="detalles[{{$i}}][accesorio_id]" value="{{$accesorio->accesorio_id}}">
                                    <span class="accesorio hide">{{$accesorio->accesorio_id}}</span>
                                    Accesorio: {{$accesorio->accesorio->nombre}}
                                  </td>
                                  <td>
                                    @if (isset($esRecepcionado))
                                      @if ($esRecepcionado)
                                        <input type="number" name="detalles[{{$i}}][cantidad]" value="{{$accesorio->cantidad}}">

                                      @else
                                        <input type="hidden" name="detalles[{{$i}}][cantidad]" value="{{$accesorio->cantidad}}">
                                        {{$accesorio->cantidad}}
                                      @endif
                                    @else
                                      <input type="hidden" name="detalles[{{$i}}][cantidad]" value="{{$accesorio->cantidad}}">
                                      {{$accesorio->cantidad}}
                                    @endif
                                  </td>
                                  <td>
                                    <a class="eliminar" style="cursor:pointer">
                                      <i class="fa fa-remove"></i></a>
                                    </a>

                                  </td>
                                </tr>
                                <?php $i++; ?>
                              @endforeach
                            @else
                              <tr>

                              </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="tab_insumo">

            <div class="row">
                <div class="col-md-4">
                    {!! Form::label('nro_lote', 'Lote', ['class' => 'control-label']) !!}
                    {!! Form::text('nro_lote', null, ['class' => 'fillable form-control']) !!}
                </div>

                <div class="col-md-4">
                    {!! Form::label('insumo', 'Materia Prima', ['class' => 'control-label']) !!}

                    <select id="select_insumo" class="form-control">
                        <option></option>
                        <?php foreach ($insumos as $insumo) : ?>
                            <option data-titulo_id="{{$insumo->titulo_id}}" value="{{$insumo->id}}"><?php echo $insumo->nombre_insumo ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-4">
                    {!! Form::label('titulo_insumo', 'Titulo Insumo', ['class' => 'control-label']) !!}
                    <select id="select_titulo_insumo" class="form-control">
                        <option></option>
                        <?php foreach ($titulos_insumo as $titulo_insumo) : ?>
                            <option value="<?php echo $titulo_insumo->id ?>"><?php echo $titulo_insumo->nombre ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    {!! Form::label('peso_bruto', 'Peso Bruto', ['class' => 'control-label']) !!}
                    {!! Form::text('peso_bruto', null, ['class' => 'onlynumbers fillable form-control']) !!}
                </div>

                <div class="col-md-4">
                    {!! Form::label('peso_tara', 'Peso Tara', ['class' => 'control-label']) !!}
                    {!! Form::text('peso_tara', null, ['class' => 'onlynumbers fillable form-control']) !!}
                </div>

                <div class="col-md-4">
                    {!! Form::label('cantidad_insumo', 'Caja / Bolsas', ['class' => 'control-label']) !!}
                    {!! Form::text('cantidad_insumo', null, ['class' => 'onlynumbers fillable form-control']) !!}
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                </div>

                <div class="col-md-4">
                  @if(isset($esRecepcionado))
                      @if(!$esRecepcionado)
                        <br><a id="add_insumo_to_grid" class="btn btn-primary" href="#">Agregar Materia Prima</a>
                      @endif
                  @else
                    <br><a id="add_insumo_to_grid" class="btn btn-primary" href="#">Agregar Materia Prima</a>
                  @endif

                </div>

            </div>

            <div class="row">
                <div class="col-md-12">

                    <h3>Detalle de Materia Primas</h3>
                    <table id="compras_grid_insumo" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Lote</th>
                                <th>Materia Prima</th>
                                <th>Titulo</th>
                                <th>P. Bruto</th>
                                <th>P.Tara</th>
                                  @if (!isset($compra))
                                    <th>P.Neto</th>
                                  @endif
                                <th>Cantidad</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                          @if (isset($compra))
                            @foreach ($compra->insumos as $key => $insumo)
                            <tr>


                              <td>
                                  <input type="hidden" name="detalles[{{$i}}][nro_lote]" value="{{$insumo->nro_lote}}">
                                {{$insumo->nro_lote}}
                              </td>
                              <td>
                                <input type="hidden" name="detalles[{{$i}}][insumo_id]" value="{{$insumo->insumo->id}}">
                                Insumo: {{$insumo->insumo->nombre_generico}}
                              </td>
                              <td>
                                  <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$insumo->titulo_id}}">
                                {{$insumo->titulo->nombre}}
                              </td>
                              <td>
                                @if (isset($esRecepcionado))
                                  @if ($esRecepcionado)
                                    <input type="number" step="any" name="detalles[{{$i}}][peso_bruto]" value="{{$insumo->peso_bruto}}">
                                  @else
                                    <input type="hidden" name="detalles[{{$i}}][peso_bruto]" value="{{$insumo->peso_bruto}}">
                                    {{$insumo->peso_bruto}}
                                  @endif
                                @else
                                  <input type="hidden" name="detalles[{{$i}}][peso_bruto]" value="{{$insumo->peso_bruto}}">
                                  {{$insumo->peso_bruto}}
                                @endif

                              </td>
                              <td>
                                  @if (isset($esRecepcionado))
                                    @if ($esRecepcionado)
                                      <input type="number" step="any" name="detalles[{{$i}}][peso_tara]" value="{{$insumo->peso_tara}}">
                                    @else
                                      <input type="hidden" name="detalles[{{$i}}][peso_tara]" value="{{$insumo->peso_tara}}">
                                      {{$insumo->peso_tara}}
                                    @endif
                                  @else
                                    <input type="hidden" name="detalles[{{$i}}][peso_tara]" value="{{$insumo->peso_tara}}">
                                    {{$insumo->peso_tara}}
                                  @endif
                              </td>
                              @if (!isset($compra))
                                <td>
                                  @if (isset($esRecepcionado))
                                    @if ($esRecepcionado)
                                      <input type="number" step="any" name="detalles[{{$i}}][peso_neto]" value="{{$insumo->peso_bruto - $insumo->peso_tara}}">
                                    @else
                                      <input type="hidden" name="detalles[{{$i}}][peso_neto]" value="{{$insumo->peso_bruto - $insumo->peso_tara}}">
                                      {{$insumo->peso_bruto - $insumo->peso_tara}}
                                    @endif
                                  @else
                                    <input type="hidden" name="detalles[{{$i}}][peso_neto]" value="{{$insumo->peso_bruto - $insumo->peso_tara}}">
                                    {{$insumo->peso_bruto - $insumo->peso_tara}}
                                  @endif
                                </td>
                              @endif
                              <td>
                                @if (isset($esRecepcionado))
                                  @if ($esRecepcionado)

                                    <input type="number" name="detalles[{{$i}}][cantidad]" value="{{$insumo->cantidad}}">
                                  @else
                                    <input type="hidden" name="detalles[{{$i}}][cantidad]" value="{{$insumo->cantidad}}">
                                    {{$insumo->cantidad}}
                                  @endif
                                @else
                                  <input type="hidden" name="detalles[{{$i}}][cantidad]" value="{{$insumo->cantidad}}">
                                  {{$insumo->cantidad}}
                                @endif

                                  {{-- <input type="number" name="detalles[{{$i}}][cantidad]" value="{{$insumo->cantidad}}">
                                {{$insumo->cantidad}} --}}
                              </td>
                              <td>
                                <a class="eliminar" style="cursor:pointer">
                                  <i class="fa fa-remove"></i></a>
                                </a>
                              </td>
                              <?php $i++; ?>
                              </tr>
                            @endforeach
                          @else
                            <tr>

                            </tr>
                          @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
