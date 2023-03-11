@php
$class_attributes = $attributes['class'] ?? '';
unset($attributes['class']);
$container_class = $attributes['container_class'] ?? '';
unset($attributes['container_class']);
@endphp

<div class="form-group {{ $container_class }}">
    {!! Form::label($name, $label . (isset($attributes['required']) ? ' *' : '')) !!}
    {!! Form::textarea($name, $value, array_merge([   
            'class' => 'form-control form-control-sm ' . $class_attributes . ' ' . ($errors->has($name) ? 'is-invalid' : '') , 
            'rows' => 2
        ], $attributes));
    !!}
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>