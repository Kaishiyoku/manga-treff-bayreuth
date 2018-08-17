@if ($location->default)
    <em>@lang('common.unknown')</em>
@else
    {{ $location->country }},
    {{ $location->state_name }},
    {{ $location->postal_code }} {{ $location->city }}
@endif