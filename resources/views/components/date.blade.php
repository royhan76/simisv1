@props([
'label' => '',
'name' => '',
'value' => ''
])

<div class="form-group mb-3">

@if($label)
<label>{{ $label }}</label>
@endif

<input
type="text"
name="{{ $name }}"
value="{{ old($name,$value) }}"
class="form-control tanggal"
autocomplete="off"
{{ $attributes }}
>

</div>
