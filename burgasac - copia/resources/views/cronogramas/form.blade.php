<div class="form-group {{ $errors->has('factura') ? 'has-error' : ''}}">
    {!! Form::label('', 'Crédito', ['class' => 'fillable col-md-4 control-label']) !!}
    <div class="col-md-1">
        {{ Form::radio('tipo_de_pago', 1, true, ['class' => 'radio_credito']) }}
        {!! $errors->first('tipo_de_pago', '<p class="help-block">:message</p>') !!}
    </div>
    
    {!! Form::label('', 'Contado', ['class' => 'fillable col-md-2 control-label']) !!}
    <div class="col-md-1">
        {{ Form::radio('tipo_de_pago', 0, false, ['class' => 'radio_contado']) }}
        {!! $errors->first('tipo_de_pago', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="hideable form-group {{ $errors->has('bancos') ? 'has-error' : ''}}">
    {!! Form::label('banco_id', 'Entidades Bancarias', ['class' => 'fillable col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select name="banco_id" id="banco_id" class="fillable form-control">
            <option></option>
            <?php foreach ($bancos as $banco) : ?>
                <option value="<?php echo $banco->id ?>"><?php echo $banco->nombre ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="hideable form-group {{ $errors->has('tipos_pago') ? 'has-error' : ''}}">
    {!! Form::label('tipopago_id', 'Forma de Pago', ['class' => 'fillable col-md-4 control-label']) !!}
    <div class="col-md-6">
        <select name="tipopago_id" id="tipopago_id" class="fillable form-control">
            <option></option>
            <?php foreach ($tipos_pago as $tipo_pago) : ?>
                <option value="<?php echo $tipo_pago->id ?>"><?php echo $tipo_pago->nombre ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="hideable form-group {{ $errors->has('cuotas') ? 'has-error' : ''}}">
    {!! Form::label('cuotas', 'Cuotas', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('cuotas', null, ['class' => 'onlynumbers form-control']) !!}
        {!! $errors->first('cuotas', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('monto') ? 'has-error' : ''}}">
    {!! Form::label('monto', 'Monto', ['class' => 'col-md-4 onlynumbers control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('monto', null, ['class' => 'form-control']) !!}
        {!! $errors->first('monto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('monto') ? 'has-error' : ''}}">
    {!! Form::label('fecha', 'Fecha', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('fecha', date('Y-m-d'), ['class' => 'form-control']) !!}
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('observaciones') ? 'has-error' : ''}}">
    {!! Form::label('observaciones', 'Observaciones', ['class' => 'fillable col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('observaciones', null, ['class' => 'fillable']) !!}
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<input type="hidden" name="compra_id" id="compra_id" class="form-control" value="{{ $compra_id }}">

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-primary']) !!}
    </div>
</div>