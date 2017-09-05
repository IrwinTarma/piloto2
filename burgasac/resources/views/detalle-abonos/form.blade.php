<div class="form-group {{ $errors->has('compra') ? 'has-error' : ''}}">
    {!! Form::label('compra', 'Compra', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('compra', null, ['class' => 'form-control']) !!}
        {!! $errors->first('compra', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('observaciones') ? 'has-error' : ''}}">
    {!! Form::label('observaciones', 'Observaciones', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('observaciones', null, ['class' => 'form-control']) !!}
        {!! $errors->first('observaciones', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>