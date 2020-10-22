@if($roles)
@php
$r_options = $roles['all'];
$r_selected = $roles['selected'];
@endphp
@endif
@foreach ($r_options as $option)
<option value="{{ $option['id']}}" {{ in_array($option['id'], $r_selected) ? 'selected' : ''}}>
    {{$option['name']}}</option>
@endforeach
@php
@endphp
