@props([
'label' => '',
'name' => '',
'value' => '',
'type' => 'text',
'required' => false,
'readonly' => false
])

<div class="form-group mb-3">

@if($label)
<label>{{ $label }}</label>
@endif

<input
type="{{ $type }}"
name="{{ $name }}"
value="{{ old($name,$value) }}"
class="form-control"

@if($required) required @endif
@if($readonly) readonly @endif

{{ $attributes }}
>

</div>
