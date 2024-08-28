@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<p style="color:#06d6a0"> Linguatech</p>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
