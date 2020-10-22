@if ($permissions)
@php
$p_options = $permissions['all'];
$p_selected = [];
if ($permissions['selected']) {
$p_selected = array_values($permissions['selected']);
}
@endphp
@endif
@foreach ($p_options as $option)
<option value="{{ $option['id']}}" {{ in_array($option['id'], $p_selected) ? 'selected' : ''}}>
    {{$option['name']}}</option>
@endforeach
</select>
