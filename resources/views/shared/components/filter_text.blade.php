@php
$applied_attributes = array_merge($attributes, ['placeholder' => $label, 'class' => 'form-control form-control-sm filter']);
@endphp

{!! Form::text("filter[$name]", !empty($filter[$name]) ? $filter[$name] : '', $applied_attributes) !!}