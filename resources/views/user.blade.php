@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                {{--<div class="card">--}}
                    {{--<div class="card-header">{{ $user->profile->firstname }} {{ $user->profile->lastname }}</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form>--}}
                            {{--<title>Возраст</title>--}}
                            {{--<input type="text" value="{{ $user->profile->age }}">--}}
                        {{--</form>--}}
                        {{--<h6>Возраст: {{ $user->profile->age }}</h6>--}}
                        {{--<h6>Почта: {{ $user->email }}</h6>--}}
                        {{--<h6>Зарегестрирован: {{ $user->created_at->format('d.m.y') }}</h6>--}}
                        {{--<h6>Контактные данные:</h6>--}}
                        {{--@foreach($user->contacts as $contact)--}}
                            {{--<li>{{ $contact->type->title }} : {{ $contact->info }}</li>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}


                    <form type="POST">
                        <div class="form-group">
                            <label>Почта</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->profile->firstname }}">
                        </div>
                        <div class="form-group">
                            <label>Фамилия</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $user->profile->lastname }}">
                        </div>
                        <div class="form-group">
                            <label>Возраст</label>
                            <input type="text" class="form-control" id="age" name="age" value="{{ $user->profile->age }}">
                        </div>
                        <div class="form-group">
                            <label>Зарегестрирован</label>
                            <input type="text" class="form-control" id="register_date" name="register_date" value="{{ $user->created_at->format('d.m.y') }}">
                        </div>
                        <br>

                        <div class="form-group">
                            <label> <h3>Контактные данные</h3></label>
                            @foreach($user->contacts as $contact)
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{ $contact->type->title }}</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" id="contact_{{ $contact->type->code }}" name="contact_{{ $contact->type->code }}" value="{{ $contact->info }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">Обновить</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                {{--</div>--}}
        </div>
    </div>
</div>
@endsection
