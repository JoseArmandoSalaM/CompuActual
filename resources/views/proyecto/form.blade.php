<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('folio') }}
            {{ Form::text('folio', $proyecto->folio, ['class' => 'form-control' . ($errors->has('folio') ? ' is-invalid' : ''), 'placeholder' => 'Folio']) }}
            {!! $errors->first('folio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CostoFinal') }}
            {{ Form::text('CostoFinal', $proyecto->CostoFinal, ['class' => 'form-control' . ($errors->has('CostoFinal') ? ' is-invalid' : ''), 'placeholder' => 'Costofinal']) }}
            {!! $errors->first('CostoFinal', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CostoAprox') }}
            {{ Form::text('CostoAprox', $proyecto->CostoAprox, ['class' => 'form-control' . ($errors->has('CostoAprox') ? ' is-invalid' : ''), 'placeholder' => 'Costoaprox']) }}
            {!! $errors->first('CostoAprox', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FechaRecibido') }}
            {{ Form::text('FechaRecibido', $proyecto->FechaRecibido, ['class' => 'form-control' . ($errors->has('FechaRecibido') ? ' is-invalid' : ''), 'placeholder' => 'Fecharecibido']) }}
            {!! $errors->first('FechaRecibido', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FechaEntregado') }}
            {{ Form::text('FechaEntregado', $proyecto->FechaEntregado, ['class' => 'form-control' . ($errors->has('FechaEntregado') ? ' is-invalid' : ''), 'placeholder' => 'Fechaentregado']) }}
            {!! $errors->first('FechaEntregado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('DineroAcuenta') }}
            {{ Form::text('DineroAcuenta', $proyecto->DineroAcuenta, ['class' => 'form-control' . ($errors->has('DineroAcuenta') ? ' is-invalid' : ''), 'placeholder' => 'Dineroacuenta']) }}
            {!! $errors->first('DineroAcuenta', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>