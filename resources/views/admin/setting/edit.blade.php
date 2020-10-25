@extends('admin.app')

@section('content')
    <h1>@lang('setting.admin.edit.title')</h1>

    {{ html()->form('put', route('admin.settings.update'))->open() }}
        @foreach ($settings as $setting)
            <div class="mb-4">
                {{ html()->label(__('setting.names.' . $setting->name->value), $setting->name->value)->class('label') }}

                @if ($setting->value_type->is(\App\Enums\SettingValueType::StringText()))
                    {{ html()->textarea($setting->name->value, old($setting->name->value, $setting->value))->attributes(['class' => 'input', 'placeholder' => __('setting.names.' . $setting->name->value), 'rows' => 10]) }}
                @endif
            </div>
        @endforeach

        {{ html()->button(__('common.update'), 'submit')->class('btn btn-primary') }}
    {{ html()->form()->close() }}
@endsection
