@extends('layouts.app')

@section('content')
    <h1>@lang('user.member.title')</h1>

    <div class="card">
        @foreach ($userMembers as $userMember)
            {{ html()->a(route('users.show', $userMember))->class('flex items-center px-2 py-2 border-b border-gray-200 hover:bg-pink-200 hover:bg-opacity-75 transition-colors duration-200')->open() }}
                <div class="avatar-sm mr-2">
                    <img src="{{ $userMember->getLatestAvatarUrl('thumb-30') }}" alt="Avatar" class="rounded-full"/>
                </div>

                {{ $userMember->name }}
            {{ html()->a()->close() }}
        @endforeach
    </div>
@endsection
