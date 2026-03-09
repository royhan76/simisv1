@extends('master')

@section('content')

<div class="container">
    <h2>Dashboard Wali Santri</h2>
    <p>Selamat datang {{ auth()->user()->name }}</p>
</div>

@endsection
