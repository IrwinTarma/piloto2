<div class="row">
    <div class="col-md-5">
        <h2>Datos Generales</h2>
        <div class="form-group {{ $errors->has('nombre_comercial') ? 'has-error' : ''}}">
            {!! Form::label('nombre_comercial', 'Nombre Comercial', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('nombre_comercial', null, ['class' => 'form-control']) !!}
                {!! $errors->first('nombre_comercial', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('razon_social') ? 'has-error' : ''}}">
            {!! Form::label('razon_social', 'Razon Social', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('razon_social', null, ['class' => 'form-control']) !!}
                {!! $errors->first('razon_social', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('ruc') ? 'has-error' : ''}}">
            {!! Form::label('ruc', 'Ruc', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('ruc', null, ['class' => 'form-control']) !!}
                {!! $errors->first('ruc', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
            {!! Form::label('direccion', 'Direccion', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('direccion_secundaria') ? 'has-error' : ''}}">
            {!! Form::label('direccion_secundaria', 'Direccion Secundaria', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('direccion_secundaria', null, ['class' => 'form-control']) !!}
                {!! $errors->first('direccion_secundaria', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
            {!! Form::label('telefono', 'Telefono', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
            {!! Form::label('telefono', 'Telefono', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('ciudad') ? 'has-error' : ''}}">
            {!! Form::label('ciudad', 'Ciudad', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('ciudad', ['Lima', ' Arequipa', ' Cusco'], null, ['class' => 'form-control']) !!}
                {!! $errors->first('ciudad', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('observaciones') ? 'has-error' : ''}}">
            {!! Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
                {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="col-md-7">
         @if(count($tipo) > 0)
            <div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
                <h2>Tipo de Proveedor</h2>
                <div class="col-md-12">
                    @foreach($tipo as $key => $value)
                    <div class="row">
                        <div class="col-md-12">
                        @if (isset($seleccionado[$key]))
                            {!! Form::checkbox('tipo[]', $key, true, ["class" => "tipo"]) !!}
                            {!! Form::label('tipo', $value) !!}
                        @else
                            {!! Form::checkbox('tipo[]', $key, false, ["class" => "tipo"]) !!}
                            {!! Form::label('tipo', $value) !!}
                        @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            {!! Form::hidden('tipo[]', 0) !!}
        @endif

        @if (count($color) > 0)
            <div class="form-group contenedor-colores {{ $errors->has('color') ? 'has-error' : ''}}" style="display: none;">
                <h2>Colores</h2>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td style="width: 20px;"></td>
                                <td style="width: 50px;">Color</td>
                                <td style="width: 100px;">Codigo</td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($color as $key => $value)
                            <tr>
                                @if (isset($seleccionadocolor[$value["id"]]))
                                    <td>{!! Form::checkbox('color[]', $value["id"], true, ["class" => "color"]) !!}</td>
                                    <td>{!! Form::label('color', $value["nombre"]) !!}</td>
                                    <td><input type="text" name="codigo[]" placeholder="Codigo" class="form-control codigo-color" value="{{$seleccionadocolor[$value['id']]['codigo']}}"></td>
                                @else
                                    <td>{!! Form::checkbox('color[]', $value["id"], false, ["class" => "color"]) !!}</td>
                                    <td>{!! Form::label('color', $value["nombre"]) !!}</td>
                                    <td><input type="text" name="codigo[]" placeholder="Codigo" class="form-control codigo-color" disabled=""></td>
                                @endif
                            </tr>
                            
                    
                        @endforeach
                        </tbody>
                    </table>
                
                </div>
            </div>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-2 pull-rigth">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>