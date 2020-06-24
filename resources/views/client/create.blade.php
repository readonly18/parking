@extends('layouts.app')
@section('content')
<h3>Новый врач</h3>
<form action = "clients" method = "POST" enctype="multipart/form-data">
    @csrf
    <button type="submit" class="btn btn-info">Создать</button>
    <hr>
    <div class="client">
        <div class="input-group input-group-sm mb-3{{ $errors->has('surname') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Фамилия</span>
            </div>
            <input type="text" name = "surname" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('surname'))
                <span class="help-block">
                <strong>{{ $errors->first('surname') }}</strong>
                </span>
            @endif
        </div>
        <small id="surnameHelp" class="form-text text-muted">минимум 3 символа</small>
        <div class="input-group input-group-sm mb-3{{ $errors->has('name') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Имя</span>
            </div>
            <input type="text" name = "name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <small id="nameHelp" class="form-text text-muted">минимум 3 символа</small>
        <div class="input-group input-group-sm mb-3{{ $errors->has('patronymic') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Отчество</span>
            </div>
            <input type="text" name = "patronymic" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('patronymic'))
                <span class="help-block">
                <strong>{{ $errors->first('patronymic') }}</strong>
                </span>
            @endif
        </div>
        <small id="patronymicHelp" class="form-text text-muted">минимум 3 символа</small>
        <div class="input-group mb-3{{ $errors->has('gender') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <label class="input-group-text" for="gender">Пол</label>
            </div>
            <select class="custom-select" name="gender" required>
                <option value="male">Мужской</option>
                <option value="female">Женский</option>
            </select>
            @if ($errors->has('gender'))
                <span class="help-block">
                <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group input-group-sm mb-3{{ $errors->has('phone') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Телефон</span>
            </div>
            <input type="text" name = "phone" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('phone'))
                <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
        <small id="phoneHelp" class="form-text text-muted">только цифры</small>
        <div class="input-group input-group-sm mb-3{{ $errors->has('address') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Специальность</span>
            </div>
            <input type="text" name = "address" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            @if ($errors->has('address'))
                <span class="help-block">
                <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <h3>Пациент</h3>
    <hr>
    <div class="automobile">
        <div class="input-group input-group-sm mb-3{{ $errors->has('brand') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Фамилия </span>
            </div>
            <input type="text" name = "brand" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('brand'))
                <span class="help-block">
                <strong>{{ $errors->first('brand') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group input-group-sm mb-3{{ $errors->has('model') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Имя </span>
            </div>
            <input type="text" name = "model" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('model'))
                <span class="help-block">
                <strong>{{ $errors->first('model') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group input-group-sm mb-3{{ $errors->has('color') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Отчество </span>
            </div>
            <input type="text" name = "color" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            @if ($errors->has('color'))
                <span class="help-block">
                <strong>{{ $errors->first('color') }}</strong>
                </span>
            @endif
        </div>
        <div class="input-group input-group-sm mb-3{{ $errors->has('plate_number') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Полис</span>
            </div>
            <input type="text" name = "plate_number" class="form-control" aria-describedby="plateHelp" required>
            @if ($errors->has('plate_number'))
                <span class="help-block">
                <strong>{{ $errors->first('plate_number') }}</strong>
                </span>
            @endif
        </div>
        <small id="plateHelp" class="form-text text-muted">16 цифр</small>
        <div class="input-group mb-3{{ $errors->has('parking_status') ? ' has-error' : '' }}">
            <div class="input-group-prepend">
                <label class="input-group-text" for="parking_status">Первичный осмотр</label>
            </div>
            <select class="custom-select" name="parking_status" required>
                <option value="1">Да</option>
                <option value="0">Нет</option>
            </select>
            @if ($errors->has('parking_status'))
                <span class="help-block">
                <strong>{{ $errors->first('parking_status') }}</strong>
                </span>
            @endif
        </div>
</form>
@endsection
