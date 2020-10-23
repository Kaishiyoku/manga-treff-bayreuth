@if (auth()->check() && auth()->user()->hasVerifiedEmail() && $meetup->canUsersRegister() && $ownMeetupRegistration)
    <div class="text-xl mt-5 mb-2">
        <button class="link" data-hc-control="meetup-update-form">
            @lang('meetup.show.registration.edit.title')
        </button>
    </div>

    <div data-hc-content="meetup-update-form" class="{{ classNames(['is-active' => $errors->count() > 0]) }}">
        {{ html()->form('put', route('meetups.update_registration', $ownMeetupRegistration))->open() }}
            <div class="mb-4">
                {{ html()->textarea('comment', old('comment', $ownMeetupRegistration->comment))->attributes(['class' => 'input' . ($errors->has('comment') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.comment'), 'rows' => 5]) }}

                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            {{ html()->button(__('common.update'), 'submit')->class('btn btn-black') }}
        {{ html()->form()->close() }}

        {{ html()->form('put', route('meetups.toggle_registration', $meetup))->class('mt-5')->open() }}
            {{ html()->button(__('meetup.show.registration.unregister'), 'submit')->attributes(['class' => 'btn btn-danger', 'data-confirm' => __('meetup.show.registration.edit.unregister_confirm')]) }}
        {{ html()->form()->close() }}
    </div>
@endif
