@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Почта</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $errors->has('email') ? old('email') : $user->email }}" readonly>
                    @foreach($errors->get('email') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $errors->has('firstname') ? old('firstname') : (!$user->profile ? '' : $user->profile->firstname) }}">
                    @foreach($errors->get('firstname') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Фамилия</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $errors->has('lastname') ? old('lastname') : (!$user->profile ? '' : $user->profile->lastname)}}">
                    @foreach($errors->get('lastname') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Возраст</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{ $errors->has('age') ? old('age') : (!$user->profile ? '' : $user->profile->age) }}">
                    @foreach($errors->get('age') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <div class="form-group">
                    <label>Зарегестрирован</label>
                    <input type="text" class="form-control has-error" id="register_date" name="register_date" value="{{ $user->created_at->format('d.m.Y') }}">
                    @foreach($errors->get('register_date') as $error)
                        <h6 class="text-danger">{{ $error }}</h6>
                    @endforeach
                </div>
                <br>

                <div class="form-group">
                    <label> <h3>Контактные данные</h3></label>
                        @foreach(\App\ContactType::all() as $contactType)
                            @php
                                $contact = $user->contacts()->where('contact_type_id', $contactType->id)->first();
                            @endphp
                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">{{ $contactType->title }}</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" id="contact_{{ $contactType->code }}" name="contact_{{ $contactType->code }}" value="{{ is_null($contact) ? '' : $contact->info }}">
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
                            <input class="form-check-input" type="checkbox" id="admin" name="admin" {{ $user->hasRole('admin') ? 'checked' : '' }} {{ !$userAuth->hasRole('admin') ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>

                @if ($userAuth->hasRole('admin'))
                    <button type="submit" class="btn btn-primary">Обновить</button>
                    <button type="button" class="btn btn-danger" id="delete" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}">Удалить</button>
                @endif
            </form>

        </div>
    </div>
</div>

<script>
    $(function() {
        var url = "{{ route('user.delete', ['id' => $user->id]) }}";
        var redirect = "{{ route('users.index') }}";

        $('#delete').on('click', function () {
            var user_id = $(this).data('id');
            var token = $(this).data('token');

            $.ajaxSetup({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    '_token': token,
                    '_method': 'delete',
                },
                success: function(result) {
                    window.location.replace(redirect)
                },
                error: function (error) {
                    alert('Ошибка удаления');
                }
            });

        });
    });

</script>
@endsection
