@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach($users as $user)
                <div class="card">

                    <div class="card-header">#{{ $user->id }}
                        <a href="{{ route('user.show', ['id' => $user->id]) }}">{{ $user->email }}</a>
                    </div>

                    <div class="card-body">
                        <h6>Никнейм: {{ $user->name }}</h6>
                        <h6>Имя: {{ !$user->profile ?: $user->profile->firstname }}</h6>
                        <h6>Фамилия: {{ !$user->profile ?: $user->profile->lastname }}</h6>
                        <h6>Возраст: {{ !$user->profile ?: $user->profile->age }}</h6>
                        <h6>Зарегестрирован: {{ $user->created_at->format('d.m.y') }}</h6>
                        <h6>Контактные данные:</h6>
                        @foreach($user->contacts as $contact)
                            <li>{{ $contact->type->title }} : {{ $contact->info }}</li>
                        @endforeach
                    </div>
                </div>
                <br>
            @endforeach

            @if($userAuth->hasRole('admin'))
                {{ $users->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
