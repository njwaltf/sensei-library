@extends('layouts.app')
@section('main')
    <h1>
        Daftar Denda</h1>
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
        @if (session()->has('successUpload'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! session('successUpload') !!}
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
                                            <h6 class="fw-semibold mb-0">Judul Buku</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Peminjaman</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Dikembalikan</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Pembayaran</h6>
                                        </th>
                                        @if (auth()->user()->role === 'admin')
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Peminjam</h6>
                                            </th>
                                        @endif
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (auth()->user()->role === 'member')
                                        @forelse ($forfeits as $forfeit)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $forfeit->book->title }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $forfeit->status }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ date('d-m-Y', strtotime($forfeit->booking->book_at)) }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ date('d-m-Y', strtotime($forfeit->booking->return_date)) }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        @if ($forfeit->status === 'Belum Dibayar')
                                                            -
                                                        @elseif($forfeit->status === 'Menunggu')
                                                            -
                                                        @elseif ($forfeit->status === 'Dibayar')
                                                            {{ date('d-m-Y', strtotime($forfeit->pay_date)) }}
                                                        @endif
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{-- update --}}
                                                    <a href="/dashboard/forfeits/{{ $forfeit->id }}/edit"
                                                        class="btn btn-success m-1">Bayar
                                                        <i class="ti ti-arrow-right"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    Belum ada Denda
                                                </td>
                                            </tr>
                                        @endforelse
                                    @else
                                        @forelse ($all_forfeits as $forfeit)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $forfeit->book->title }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $forfeit->status }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ date('d-m-Y', strtotime($forfeit->booking->book_at)) }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        {{ date('d-m-Y', strtotime($forfeit->booking->return_date)) }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $forfeit->user->name }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">
                                                        @if ($forfeit->status === 'Belum Dibayar')
                                                            -
                                                        @elseif($forfeit->status === 'Menunggu')
                                                            -
                                                        @elseif ($forfeit->status === 'Dibayar')
                                                            {{ date('d-m-Y', strtotime($forfeit->pay_date)) }}
                                                        @endif
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{-- detail --}}
                                                    <a href="/dashboard/forfeits/{{ $forfeit->id }}"
                                                        class="btn btn-info m-1">Detail <i
                                                            class="ti ti-arrow-right"></i></a>
                                                    {{-- update --}}
                                                    <a href="/dashboard/forfeits/{{ $forfeit->id }}/edit"
                                                        class="btn btn-success m-1">Proses Pembayaran
                                                        <i class="ti ti-settings"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    Belum ada Denda
                                                </td>
                                            </tr>
                                        @endforelse
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
