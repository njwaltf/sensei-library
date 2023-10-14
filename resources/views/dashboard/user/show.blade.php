@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/users"><i class="ti ti-arrow-left"></i></a> Detail Pengguna</h2>
        </div>
    </div>
    <div class="row">
        @if ($user->prof_pic)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">{{ $user->name }}</h5>
                    </div>
                    <div class="card-body">
                        <img src="@if ($user->prof_pic > 0) {{ asset('storage/' . $user->prof_pic) }}
                        @else {{ asset('images/profile/user-1.jpg') }} @endif"
                            width="250" height="250" class="rounded-circle">
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title fw-semibold m-1">Informasi Lanjutan</h5>
                </div>
                <div class="card-body p-3">
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Bergabung</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Nama Pengguna</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1">{{ $user->username }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Alamat Email</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Role</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <span
                                @if ($user->role === 'admin') class="badge bg-primary rounded-3 fw-semibold" @else class="badge bg-black rounded-3 fw-semibold" @endif>
                                @if ($user->role === 'admin')
                                    Admin
                                @else
                                    Member
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
