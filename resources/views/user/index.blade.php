@extends('layouts.app')

@section('content')
    <h1>@lang('user.index.title')</h1>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach ($users->chunk(ceil($users->count() / 4)) as $userChunk)
            <div>
                @foreach ($userChunk as $user)
                    <div class="mb-1">
                        {{ Html::linkRoute('users.show', $user->name, $user, ['class' => 'link']) }}
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
