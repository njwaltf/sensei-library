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
                                            <h6 class="fw-semibold mb-0">Judul Buku</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Status</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Peminjaman</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Tanggal Harus Kembali</h6>
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
                                        @forelse ($bookings as $booking)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $booking->book->title }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <span
                                                        @if ($booking->status === 'Diajukan') class="badge bg-warning rounded-3 fw-semibold"
                                                    @elseif ($booking->status === 'Dipinjam') class="badge bg-success rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan') class="badge bg-black rounded-3 fw-semibold" @elseif ($booking->status === 'Ditolak') class="badge bg-danger rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan Terlambat') class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $booking->status }}</span>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">
                                                        {{ date('d-m-Y', strtotime($booking->book_at)) }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"
                                                        @if ($booking->isDenda === 1) style="color:red;" @endif>
                                                        @if ($booking->expired_date != 0)
                                                            {{ date('d-m-Y', strtotime($booking->expired_date)) }}
                                                        @else
                                                            Belum Diambil
                                                        @endif
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    {{-- detail --}}
                                                    <a href="/dashboard/bookings/{{ $booking->id }}"
                                                        class="btn btn-info m-1">Detail <i
                                                            class="ti ti-arrow-right"></i></a>
                                                    <form action="/dashboard/bookings/{{ $booking->id }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger m-1" type="submit"
                                                            onclick="return confirm('Apakah kamu yakin ingin menghapus ini?')">Batal
                                                            Pinjam
                                                            <i class="ti ti-circle-x"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Belum ada Peminjaman
                                                </td>
                                            </tr>
                                        @endforelse
                                    @else
                                        @forelse ($all_bookings as $booking)
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">{{ $booking->book->title }}</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <span
                                                        @if ($booking->status === 'Diajukan') class="badge bg-warning rounded-3 fw-semibold"
                                                    @elseif ($booking->status === 'Dipinjam') class="badge bg-success rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan') class="badge bg-black rounded-3 fw-semibold" @elseif ($booking->status === 'Ditolak') class="badge bg-danger rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan Terlambat') class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $booking->status }}</span>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">
                                                        {{-- date('d-m-Y', strtotime($user->from_date)) --}}
                                                        {{ date('d-m-Y', strtotime($booking->book_at)) }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1"
                                                        @if ($booking->isDenda === 1) style="color:red;" @endif>
                                                        @if ($booking->expired_date != 0)
                                                            {{ date('d-m-Y', strtotime($booking->expired_date)) }}
                                                        @else
                                                            Belum Diambil
                                                        @endif
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-1">{{ $booking->user->name }}
                                                    </h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <a class="btn btn-warning m-1"
                                                        href="/dashboard/bookings/{{ $booking->id }}/edit">Proses
                                                        Peminjaman
                                                        <i class="ti ti-settings"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Belum ada Peminjaman
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
