@extends('layouts.app')
@section('main')
    <h1>Daftar Pengguna</h1>
    @if (auth()->user()->role === 'admin')
        <div class="dropdown">
            <!-- The dropdown button -->
            <button class="dropdown-button" onclick="toggleDropdown()">Export Data <i class="ti ti-file-text"></i></button>

            <!-- The dropdown content -->
            <div class="dropdown-content" id="myDropdown">
                <a href="{{ url('pdf/export-user/') }}">PDF</a>
                <a href="{{ url('excel/export-user/') }}">Excel</a>
                {{-- <a href="#">Something else here</a> --}}
            </div>
        </div>
        {{-- <a class="btn btn-info my-3" href="">Export Book Data to pdf</a> --}}
    @endif
    <a href="/dashboard/users/create" class="btn btn-info">Tambah User</a>
    <!--  Row 1 -->
    <div class="row py-5">
        {{-- <h1>{{ auth()->user()->rombel_id }}</h1> --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('successEdit'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {!! session('successEdit') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('successDelete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('successDelete') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (auth()->user()->role === 'member')
            <h1>You dont have access wir</h1>
        @else
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle table-hover display" id="myTable">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Pengguna</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Nama Lengkap</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Role</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $user->username }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $user->name }}
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $user->email }}
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <span
                                        @if ($user->role === 'admin') class="badge bg-primary rounded-3 fw-semibold" @else class="badge bg-black rounded-3 fw-semibold" @endif>
                                        @if ($user->role === 'admin')
                                            Admin
                                        @else
                                            Member
                                        @endif
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    {{-- detail --}}
                                    <a href="/dashboard/users/{{ $user->id }}" class="btn btn-info m-1">Detail <i
                                            class="ti ti-arrow-right"></i></a>
                                    {{-- update --}}
                                    <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-warning m-1">Ubah
                                        Role
                                        <i class="ti ti-edit"></i></a>
                                    {{-- delete --}}
                                    <form action="/dashboard/users/{{ $user->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger m-1" type="submit"
                                            onclick="return confirm('Apakah kamu yakin ingin menghapus buku ini?')">Kick <i
                                                class="ti ti-circle-x"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada Pengguna
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
