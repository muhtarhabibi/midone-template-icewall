@php
$class_attributes = $attributes['class'] ?? '';
unset($attributes['class']);
$container_class = $attributes['container_class'] ?? '';
unset($attributes['container_class']);
@endphp

<div class="form-group {{ $container_class }}">
    {!! Form::label($name, $label . (isset($attributes['required']) ? ' *' : '')) !!}
    {{-- {!! Form::select($name, $options, $value, 
        array_merge([   
            'class' => 'form-control select2 ' . $class_attributes . ($errors->has($name) ? ' is-invalid' : ''),
        ], $attributes));
    !!} --}}
    <select name="{{ $name }}" class="form-control form-control-sm select2-remote {{ $class_attributes }} {{ $errors->has($name) ? ' is-invalid' : '' }}" 
        data-source="{{ $source }}" 
        {!! isset($attributes['placeholder']) ? 'data-placeholder="' . $attributes['placeholder'] . '"' : null !!}>
        {!! $value ? '<option value="' . $value[0] . '" selected="selected">' . $value[1] . '</option>' : null !!}
    </select>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
