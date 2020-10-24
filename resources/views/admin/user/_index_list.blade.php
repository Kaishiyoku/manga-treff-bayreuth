@foreach ($users->get() as $user)
    <div class="card mb-5">
        <div class="text-xl p-3 {{ classNames(['text-white bg-red-500' => !$user->hasVerifiedEmail()]) }}">
            {{ $user->name }}
        </div>

        <div class="p-3">
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.is_admin'):</div>
                <div>{{ formatBoolean($user->is_admin) }}</div>
            </div>
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.created_at'):</div>
                <div>{{ $user->created_at->format(__('date.datetime')) }}</div>
            </div>
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.updated_at')</div>
                <div>{{ $user->updated_at->format(__('date.datetime')) }}</div>
            </div>
            <div class="flex">
                <div class="w-2/5">@lang('validation.attributes.email_verified_at')</div>
                <div>
                    @if ($user->hasVerifiedEmail())
                        {{ $user->email_verified_at->format(__('date.datetime')) }}
                    @else
                        /
                    @endif
                </div>
            </div>

            <div class="mt-5">
                @include('shared._delete_link', ['route' => route('admin.users.destroy', $user)])
                {{ html()->a(route('admin.users.edit', $user), __('common.edit'))->class('btn btn-sm btn-black') }}
            </div>
        </div>
    </div>
@endforeach
