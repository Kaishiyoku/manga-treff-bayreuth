@foreach ($users->get() as $user)
    <div class="card mb-5">
        <div class="text-xl p-3">
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

            <div class="mt-5">
                @include('shared._delete_link', ['route' => ['admin.users.destroy', $user->id]])
                {{ Html::linkRoute('admin.users.edit', __('common.edit'), $user, ['class' => 'btn btn-sm btn-black']) }}
            </div>
        </div>
    </div>
@endforeach
