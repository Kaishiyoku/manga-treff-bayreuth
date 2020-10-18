<div class="text-2xl mt-5">
    {{ trans_choice('meetup.show.registration.title', $meetup->is_manually_added ? $meetupUserRegistrations->count() : count($meetup->animexx_data['user_registrations'])) }}
</div>

@if ($meetup->is_manually_added)
    <div>
        @foreach ($meetupUserRegistrations as $meetupUserRegistration)
            <div class="py-2">
                <div>
                    {{ $meetupUserRegistration->user->name }}
                </div>

                @if ($meetupUserRegistration->comment)
                    <div class="text-sm text-muted">
                        <span class="">{{ $meetupUserRegistration->comment }}</span>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @include('meetup._create_registration')

    @include('meetup._edit_registration')
@else
    <div>
        @foreach ($meetup->animexx_data['user_registrations'] as $animexxMeetupRegistration)
            <div class="py-2">
                <a href="{{ getAnimexxUserProfileUrlFor($animexxMeetupRegistration['id']) }}" class="link">
                    {{ $animexxMeetupRegistration['name'] }}

                    @include('shared._external_icon')
                </a>
            </div>
        @endforeach
    </div>

    <div class="alert alert-info mt-5">
        <p>
            @lang('meetup.show.registration.registration_via_animexx_only'):
        </p>

        <p>
            <a href="{{ $meetup->getUrl() }}" class="link">
                {{ $meetup->getUrl() }}
                @include('shared._external_icon')
            </a>
        </p>
    </div>
@endif
