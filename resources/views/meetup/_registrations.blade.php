<div class="text-2xl mt-5">
    {{ trans_choice('meetup.show.registration.title', $meetup->is_manually_added ? $meetupUserRegistrations->count() : count($meetup->animexx_data['user_registrations'])) }}
</div>

@if ($meetup->is_manually_added)
    <div>
        @foreach ($meetupUserRegistrations as $meetupUserRegistration)
            <div class="py-1">
                <div>
                    @if ($meetupUserRegistration->user->trashed())
                        <span class="italic text-muted">@lang('common.deleted_user')</span>
                    @else
                        <div class="flex items-center">
                            <div class="avatar-sm mr-2">
                                @if ($meetupUserRegistration->user->is_member && $meetupUserRegistration->user->hasMedia())
                                    <img src="{{ $meetupUserRegistration->user->getLatestAvatarUrl('thumb-30') }}" alt="Avatar" class="rounded-full"/>
                                @else
                                    <svg class="fill-current text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><!-- Font Awesome Free 5.15.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) --><path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z"/></svg>
                                @endif
                            </div>

                            {{ html()->a(route('users.show', $meetupUserRegistration->user), $meetupUserRegistration->user->name)->class('link') }}
                        </div>
                    @endif
                </div>

                @if ($meetupUserRegistration->comment)
                    <div class="text-sm text-muted mt-1">
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
            <div class="py-1">
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
