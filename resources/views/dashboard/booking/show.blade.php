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
                            <strong class="m-1">Waktu Peminjaman</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $booking->created_at->diffForHumans() }}</p>
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
                                    Denda
                                @else
                                    Tidak Denda
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
