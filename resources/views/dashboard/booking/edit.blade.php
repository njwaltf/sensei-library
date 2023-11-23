@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/bookings"><i class="ti ti-arrow-left"></i></a> Detail Peminjaman</h2>
        </div>
    </div>
    <div class="row">
        @if ($booking->book->image)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">{{ $booking->book->title }}</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $booking->book->image) }}" height="440" class="m-2">
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
                            <strong class="m-1">Peminjam</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $booking->user->name }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Peminjaman</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ date('d-m-Y', strtotime($booking->book_at)) }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Harus Kembali</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1" @if ($booking->expired_date != 0) style="color:red" @endif>
                                @if ($booking->expired_date != 0)
                                    {{ date('d-m-Y', strtotime($booking->expired_date)) }}*
                                @else
                                    Belum Diambil
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Pengembalian</strong>
                        </div>
                        <div class="col-lg-6">
                            @if ($booking->return_date != 0)
                                <p class="m-1">{{ date('d-m-Y', strtotime($booking->return_date)) }}</p>
                            @else
                                <p class="m-1">Belum Dikembalikan</p>
                            @endif
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Penerbit</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1">{{ $booking->book->publisher }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Status Peminjaman</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <span
                                @if ($booking->status === 'Diajukan') class="badge bg-warning rounded-3 fw-semibold"
                                                    @elseif ($booking->status === 'Dipinjam') class="badge bg-success rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan') class="badge bg-black rounded-3 fw-semibold" @elseif ($booking->status === 'Ditolak') class="badge bg-danger rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan Terlambat') class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $booking->status }}</span>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Status Denda</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <span
                                @if ($booking->isDenda === 1) class="badge bg-danger rounded-3 fw-semibold" @else class="badge bg-success rounded-3 fw-semibold" @endif>
                                @if ($booking->isDenda === 1)
                                    Aktif
                                @else
                                    Tidak Aktif
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title fw-semibold m-3">Proses Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="title" class="form-label">Ubah status Peminjaman buku dari
                            {{ $booking->user->name }}</label>
                        <p>Anda dapat menolak atau menerima peminjaman dari pengguna</p>
                        <form action="/dashboard/bookings/{{ $booking->id }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <input type="hidden" name="user_id" value="{{ $booking->user->id }}">
                            <input type="hidden" name="desc" value="{{ 'Peminjaman kamu memiliki status baru!' }}">
                            <input type="hidden" name="title" value="{{ 'Pembaruan status' }}">
                            <select class="form-select @error('status') is-invalid @enderror"
                                aria-label="Default select example" id="status" name="status"
                                @if ($booking->status === 'Dikembalikan') disabled @endif>
                                @if ($booking->status === 'Diajukan' || $booking->status === 'Ditolak')
                                    <option value="{{ 'Dipinjam' }}" @if ($booking->status === 'Dipinjam') selected @endif>
                                        Dipinjam
                                    </option>
                                    <option value="{{ 'Ditolak' }}" @if ($booking->status === 'Ditolak') selected @endif>
                                        Ditolak
                                    </option>
                                @elseif ($booking->status === 'Dipinjam')
                                    <option value="{{ 'Dikembalikan' }}"
                                        @if ($booking->status === 'Dikembalikan') selected @endif>
                                        Dikembalikan
                                    </option>
                                @else
                                    <option value="{{ 'Dikembalikan' }}"
                                        @if ($booking->status === 'Dikembalikan') selected @endif>
                                        Dikembalikan
                                    </option>
                                @endif
                            </select>
                            {{-- <input type="hidden" name="isDenda" value="{{ 0 }}"> --}}
                            <button type="submit" class="btn btn-primary my-4" style="margin-right: 15px;">Perbarui
                                Status Laporan
                                <i class="ti ti-checkup-list"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
