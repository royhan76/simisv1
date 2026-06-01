@props([
'label' => '',
'name' => '',
'class' => '',
'placeholder' => ''
])

<div class="form-group mb-3">

@if($label)
<label>{{ $label }}</label>
@endif

<select
name="{{ $name }}"
class="form-control {{ $class }}"
style="width:100%"
data-placeholder="{{ $placeholder }}"
{{ $attributes }}
>
</select>

</div>
