@extends('layouts.app')
@section('main')
    <div class="card">
        <div class="card-body">
            @if (auth()->user()->role === 'member')
                <h5 class="card-title fw-semibold mb-4">Selamat Datang {{ auth()->user()->name }}</h5>
            @else
                <h5 class="card-title fw-semibold mb-4">Selamat Datang Admin</h5>
            @endif
            <p class="mb-0">This is a sample page </p>
        </div>
    </div>
@endsection
