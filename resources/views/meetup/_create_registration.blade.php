@if (auth()->check() && $meetup->canUsersRegister() && !$ownMeetupRegistration)
    <div class="text-xl mt-5 mb-2">
        @if (auth()->user()->hasVerifiedEmail())
            <button class="link" data-hc-control="meetup-registration-form">
                @lang('meetup.show.registration.create.title')
            </button>
        @else
            @lang('meetup.show.registration.create.title')
        @endif
    </div>

    @if (auth()->user()->hasVerifiedEmail())
        {{ html()->form('put', route('meetups.toggle_registration', $meetup))->attributes(['data-hc-content' => 'meetup-registration-form', 'class' => classNames(['is-active' => $errors->count() > 0])])->open() }}
            <div class="mb-4">
                {{ html()->textarea('comment', old('comment'))->attributes(['class' => 'input' . ($errors->has('comment') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.comment'), 'rows' => 5]) }}

                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            {{ html()->button(__('meetup.show.registration.register'), 'submit')->class('btn btn-primary') }}
        {{ html()->form()->close() }}
    @else
        <div class="alert alert-info">
            @lang('meetup.show.registration.email_not_verified')

            @include('auth._verify_resend')
        </div>
    @endif
@endif
