@extends('layouts.app')

@section('content')
    <h1>@lang('user.member.title')</h1>

    <div>
        @foreach ($userMembers as $userMember)
            <div class="mb-1">
                {{ Html::linkRoute('users.show', $userMember->name, $userMember, ['class' => 'link']) }}
            </div>
        @endforeach
    </div>
@endsection
