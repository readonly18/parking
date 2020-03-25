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
<tr v-for="clientAuto in clientsAutos.data">
    <td> @{{ clientAuto.name }} </td>
    <td> @{{ clientAuto.model }} </td>
    <td> @{{ clientAuto.plate_number }} </td>
    <td> <button type="button" class="btn btn-primary" id="update-@{{ clientAuto.id }}">Изменить</button> </td>
    <td> <button type="button" class="btn btn-danger" id="delete-@{{ clientAuto.id }}">Удалить</button> </td>
</tr>
  </tbody>
</table>
<vue-pagination :pagination = "clientsAutos"
                @paginate = "getPagination()"
                :offset = "15">
</vue-pagination>
@endsection
