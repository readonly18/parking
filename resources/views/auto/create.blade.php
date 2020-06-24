@extends('layouts.app')
@section('content')
<h3>Новый пациент</h3>
<form action = "autos" method = "POST" enctype="multipart/form-data">
    @csrf
    <button type="submit" class="btn btn-info">Создать</button>
    <hr>
    <select class="form-control{{ $errors->has('phone') ? ' has-error' : '' }}" name="phone" required>
        @foreach ($clientsPhones as $phone)
            <option>{{ $phone }}</option>
        @endforeach
        @if ($errors->has('phone'))
            <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </select>
    <small id="phoneHelp" class="form-text text-muted">номер врача (79021234567)</small>
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
    <small id="plateHelp" class="form-text text-muted">16 символов</small>
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
