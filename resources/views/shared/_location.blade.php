@if ($location->default)
    <span class="italic">@lang('common.unknown')</span>
@else
    {{ $location->country }},
    {{ $location->state_name }},
    {{ $location->postal_code }} {{ $location->city }}
@endif
