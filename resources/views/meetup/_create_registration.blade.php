@if (auth()->check() && $meetup->isUpcoming() && !$ownMeetupRegistration)
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
        {{ Form::open(['route' => ['meetups.toggle_registration', $meetup], 'method' => 'put', 'role' => 'form', 'data-hc-content' => 'meetup-registration-form', 'class' => classNames(['is-active' => $errors->count() > 0])]) }}
            <div class="mb-4">
                {{ Form::textarea('comment', old('comment'), ['class' => 'input' . ($errors->has('comment') ? ' has-error' : ''), 'placeholder' => __('validation.attributes.comment'), 'rows' => 5]) }}

                @if ($errors->has('comment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comment') }}
                    </div>
                @endif
            </div>

            {{ Form::button(__('meetup.show.registration.register'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {{ Form::close() }}
    @else
        <div class="alert alert-info">
            @lang('meetup.show.registration.email_not_verified')

            @include('auth._verify_resend')
        </div>
    @endif
@endif
