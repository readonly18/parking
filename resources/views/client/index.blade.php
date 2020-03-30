@extends('layouts.app')
@section('content')
<div id="app">
    <transition name = "slide">
        <router-view></router-view>
    </transition>
</div>
@endsection
