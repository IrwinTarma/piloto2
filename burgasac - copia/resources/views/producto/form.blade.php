<div class="form-group {{ $errors->has('nombre_generico') ? 'has-error' : ''}}">
    {!! Form::label('nombre_generico', 'Nombre Generico', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_generico', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_generico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nombre_especifico') ? 'has-error' : ''}}">
    {!! Form::label('nombre_especifico', 'Nombre Especifico', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre_especifico', null, ['class' => 'form-control']) !!}
        {!! $errors->first('nombre_especifico', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('material') ? 'has-error' : ''}}">
    {!! Form::label('material', 'Material', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('material', null, ['class' => 'form-control']) !!}
        {!! $errors->first('material', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<hr>

<h3>Agregar componentes de Materias Primas</h3>

{!! Form::label('insumo', 'Insumo', ['class' => 'col-md-4 control-label']) !!}
<div class="col-md-3">
    <select name="select_insumo" id="select_insumo" class="form-control" {{isset($esRecepcionado)? ( $esRecepcionado? 'readonly':'' ):''  }}>
        <option></option>
        @foreach($insumos as $insumo)
            <option data-titulo="{{$insumo->titulo}}" data-titulo_id="{{$insumo->titulo_id}}" value="{{$insumo->id}}"> {{$insumo->nombre_insumo}}</option>
        @endforeach
    </select>
</div>

<div class="col-md-3">
    <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="(valor decimal)">
    <br>
</div>

<a id="add_insumo_to_grid" class="btn btn-info">Agregar Insumo</a>
<?php
    $i = 0;
?>
<div class="row">
    <div class="col-md-12">
        <table id="materia_prima_grid" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Materia Prima</th>
                    <th>Titulo</th>
                    <th>Cantidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (isset($indicadores))
                  @foreach ($indicadores as $key => $indicador)
                    <tr>
                      <td>
                        <input type="hidden" name="detalles[{{$i}}][insumo_id]" value="{{$indicador->insumo->id}}">
                        {{$indicador->insumo->nombre_generico}}
                      </td>
                      <td>
                        @if(!is_null($indicador->titulo))
                        <input type="hidden" name="detalles[{{$i}}][titulo_id]" value="{{$indicador->titulo->id}}">
                        {{$indicador->titulo->nombre}}
                        @endif
                      </td>
                      <td class="cantidad">
                        <input type="number" step="any" name="detalles[{{$i}}][cantidad]" value="{{$indicador->valor}}">
                      </td>
                      <td>
                        <a class="eliminar" style="cursor:pointer" data-cantidad = "{{$insumo->cantidad}}">
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
                <tr>

                </tr>
            </tbody>
        </table>

    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar Tela', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
