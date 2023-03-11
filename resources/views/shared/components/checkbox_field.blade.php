<div class="form-group">
    <div class="form-check">
        {!! Form::checkbox($name, 'on', $value, ['data-bootstrap-switch' => true]) !!}
        <label class="form-check-label"> {{ $label }}</label>
    </div>
</div>