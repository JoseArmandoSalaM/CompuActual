<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('NombreEquipo') }}
            {{ Form::text('NombreEquipo', $equipo->NombreEquipo, ['class' => 'form-control' . ($errors->has('NombreEquipo') ? ' is-invalid' : ''), 'placeholder' => 'Nombreequipo']) }}
            {!! $errors->first('NombreEquipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CaracteristicasReales') }}
            {{ Form::text('CaracteristicasReales', $equipo->CaracteristicasReales, ['class' => 'form-control' . ($errors->has('CaracteristicasReales') ? ' is-invalid' : ''), 'placeholder' => 'Caracteristicasreales']) }}
            {!! $errors->first('CaracteristicasReales', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CaracteristicasPosibles') }}
            {{ Form::text('CaracteristicasPosibles', $equipo->CaracteristicasPosibles, ['class' => 'form-control' . ($errors->has('CaracteristicasPosibles') ? ' is-invalid' : ''), 'placeholder' => 'Caracteristicasposibles']) }}
            {!! $errors->first('CaracteristicasPosibles', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>