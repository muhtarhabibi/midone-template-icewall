@php
$class_attributes = $attributes['class'] ?? '';
unset($attributes['class']);
$container_class = $attributes['container_class'] ?? '';
unset($attributes['container_class']);
$tags = isset($attributes['tags']) ? true : false;
unset($attributes['tags']);
@endphp

<div class="form-group {{ $container_class }}">
    {!! Form::label($name, $label . (isset($attributes['required']) ? ' *' : '')) !!}
    {!! Form::select($name, $options, $value, 
        array_merge([   
            'class' => 'form-control form-control-sm ' . ($tags ? 'select2-tags ' : 'select2 ') . $class_attributes . ($errors->has($name) ? ' is-invalid' : ''),
        ], $attributes));
    !!}
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>