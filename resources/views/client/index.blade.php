@extends('layouts.app')
@section('content')
<h3>Клиенты</h3>
<div class="btn-toolbar" role="toolbar">
  <div class="btn-group mr-2" role="group">
    <a class="btn btn-info " href="/clients" role="button">Новый клиент</a>
  </div>
  <div class="btn-group mr-2" role="group">
    <a class="btn btn-info " href="/autos" role="button">Новый автомобиль</a>
  </div>
</div>
<br>
<clients-autos-table></clients-autos-table>
@endsection
