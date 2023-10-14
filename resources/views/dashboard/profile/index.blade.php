@extends('layouts.app')
@section('main')
    <div class="card">
        @if (session()->has('successEdit'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {!! session('successEdit') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <img src="@if (auth()->user()->prof_pic > 0) {{ asset('storage/' . auth()->user()->prof_pic) }}
                    @else {{ asset('assets/images/profile/no-pp.png') }} @endif"
                        width="250" height="250" class="rounded-circle" disabled>
                </div>

                <div class="col-lg-4">
                    <div class="mb-4">
                        <label for="full_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ auth()->user()->name }}" disabled>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ auth()->user()->email }}" disabled>
                    </div>
                    <a href="/dashboard/profile/edit" class="btn btn-primary m-1">Edit Profile</a>
                    <a href="/dashboard" class="btn btn-outline-warning m-1">Kembali</a>
                </div>
                <div class="col-lg-4">
                    <div class="mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ auth()->user()->username }}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
