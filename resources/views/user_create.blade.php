@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('user.create') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Почта</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @foreach($errors->get('email') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname') }}">
                    @foreach($errors->get('firstname') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                    @foreach($errors->get('lastname') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Возраст</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{ old('age') }}">
                    @foreach($errors->get('age') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Зарегестрирован</label>
                    <input type="date" class="form-control has-error" id="register_date" name="register_date" value="{{ old('register_date') }}">
                    @foreach($errors->get('register_date') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <br>

                <div class="form-group">
                    <label> <h3>Контактные данные</h3></label>
                    @foreach(\App\ContactType::all() as $contactType)
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">{{ $contactType->title }}</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="contact_{{ $contactType->code }}" name="contact_{{ $contactType->code }}" value="{{ old('contact_' . $contactType->code) }}">
                                @foreach($errors->get('contact_' . $contactType->code) as $error)
                                    <h6 class="text-danger">{{ $error }}</h6>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group row">
                    <div class="col-sm-2">Администратор</div>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="admin" name="admin">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Создать</button>
            </form>

        </div>
    </div>
</div>

@endsection
