@if (auth()->check() && auth()->user()->hasVerifiedEmail() && $meetup->canUsersRegister() && $ownMeetupRegistration)
    <div class="text-xl mt-5 mb-2">
        <button class="link" data-hc-control="meetup-update-form">
            @lang('meetup.show.registration.edit.title')
        </button>
    </div>

    <div data-hc-content="meetup-update-form" class="{{ classNames(['is-active' => $errors->count() > 0]) }}">
        {{ Form::open(['route' => ['meetups.update_registration', $ownMeetupRegistration], 'method' => 'put', 'role' => 'form']) }}
            <div class="mb-4">
                {{ Form::textarea('comment', old('comment', $ownMeetupRegistration->comment), ['class' => 'input' . ($errors->has('comment') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.comment'), 'rows' => 5]) }}

                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            {{ Form::button(__('common.update'), ['type' => 'submit', 'class' => 'btn btn-black']) }}
        {{ Form::close() }}

        {{ Form::open(['route' => ['meetups.toggle_registration', $meetup], 'method' => 'put', 'role' => 'form', 'class' => 'mt-5']) }}
            {{ Form::button(__('meetup.show.registration.unregister'), ['type' => 'submit', 'class' => 'btn btn-danger', 'data-confirm' => __('meetup.show.registration.edit.unregister_confirm')]) }}
        {{ Form::close() }}
    </div>
@endif
