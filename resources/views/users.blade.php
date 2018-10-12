@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach($users as $user)
                <div class="card">
                    <a href="{{ route('user.show', ['id' => $user->id]) }}">
                        <div class="card-header">{{ $user->profile->firstname }} {{ $user->profile->lastname }}</div>
                    </a>

                    <div class="card-body">
                        <h6>Возраст: {{ $user->profile->age }}</h6>
                        <h6>Почта: {{ $user->email }}</h6>
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
