@extends('layouts.app')
@section('main')
    <h1>Daftar Peminjaman</h1>
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
        <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle table-hover display" id="myTable">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">No</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Nama</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Deskripsi</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (auth()->user()->role === 'admin')
                                        @forelse ($types as $type)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $type->name }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ Str::limit($type->desc, 70, '...') }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{-- detail --}}
                                                    <a href="/dashboard/types/{{ $type->id }}"
                                                        class="btn btn-info m-1">Detail <i
                                                            class="ti ti-arrow-right"></i></a>
                                                    <a class="btn btn-warning m-1"
                                                        href="/dashboard/types/{{ $type->id }}/edit">Edit
                                                        <i class="ti ti-settings"></i></a>
                                                    <form action="/dashboard/types/{{ $type->id }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger m-1" type="submit"
                                                            onclick="return confirm('Apakah kamu yakin ingin menghapus ini?')">Hapus
                                                            <i class="ti ti-circle-x"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Belum ada genre buku
                                                </td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <h3>you don't have access</h3>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
