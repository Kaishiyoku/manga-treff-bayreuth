<div class="card">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>@lang('validation.attributes.name')</th>
                <th>@lang('validation.attributes.is_admin')</th>
                <th>@lang('validation.attributes.created_at')</th>
                <th>@lang('validation.attributes.updated_at')</th>
                <th>@lang('validation.attributes.email_verified_at')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users->get() as $user)
                <tr class="{{ classNames('border-l-8', ['border-transparent' => $user->hasVerifiedEmail(), 'border-red-500' => !$user->hasVerifiedEmail()]) }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ formatBoolean($user->is_admin) }}</td>
                    <td>{{ $user->created_at->format(__('date.datetime')) }}</td>
                    <td>{{ $user->updated_at->format(__('date.datetime')) }}</td>
                    <td>
                        @if ($user->hasVerifiedEmail())
                            {{ $user->email_verified_at->format(__('date.datetime')) }}
                        @else
                            /
                        @endif
                    </td>
                    <td>
                        @if ($user->id !== auth()->user()->id && !$user->is_admin)
                            @include('shared._delete_link', ['route' => ['admin.users.destroy', $user->id]])
                        @endif

                        {{ Html::linkRoute('admin.users.edit', __('common.edit'), $user, ['class' => 'btn btn-sm btn-black']) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
