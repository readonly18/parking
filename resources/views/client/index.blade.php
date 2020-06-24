@extends('layouts.app')
@section('content')
<h3>Клиенты</h3>
<div class="btn-toolbar" role="toolbar">
  <div class="btn-group mr-2" role="group">
    <a class="btn btn-info " href="clients" role="button">Новый клиент</a>
  </div>
  <div class="btn-group mr-2" role="group">
    <a class="btn btn-info " href="autos" role="button">Новый автомобиль</a>
  </div>
</div>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ФИО</th>
      <th scope="col">Авто</th>
      <th scope="col">Номер</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
@foreach ($clientsAutos as $clientAuto)
    <tr>
        <td> {{ $clientAuto->name }} </td>
        <td> {{ $clientAuto->model }} </td>
        <td> {{ $clientAuto->plate_number }} </td>
        <td> <a type="button" class="btn btn-primary" id="update-{{ $clientAuto->id }}" href="autos/{{ $clientAuto->id }}">Изменить</a> </td>
        <td> <a type="button" class="btn btn-danger" id="delete-{{ $clientAuto->id }}" href="autos/delete/{{ $clientAuto->id }}">Удалить</a> </td>
    </tr>
@endforeach
  </tbody>
</table>
{{ $clientsAutos->links() }}
@endsection
