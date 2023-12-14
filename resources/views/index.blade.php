@extends('layouts.app')
@section('main')
    <h1 class="py-3">Selamat Datang {{ auth()->user()->name }}</h1>
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Monthly Earnings -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold">Jumlah Peminjaman</h5>
                                    @if (auth()->user()->role === 'member')
                                        <h4 class="fw-semibold mb-3">{{ $count_user_bookings }}</h4>
                                    @else
                                        <h4 class="fw-semibold mb-3">{{ $count_all_bookings }}</h4>
                                    @endif
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center pb-1">
                                                    <span
                                                        class="me-2 rounded-circle bg-light-warning round-20 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-notebook text-warning"></i>
                                                    </span>
                                                    @if (auth()->user()->role === 'member')
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $active_user_bookings }}</p>
                                                    @else
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $active_all_bookings }}</p>
                                                    @endif
                                                    <p class="fs-3 mb-0">Aktif</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center pb-1">
                                                    <span
                                                        class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-checks text-success"></i>
                                                    </span>
                                                    @if (auth()->user()->role === 'member')
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $done_user_bookings }}</p>
                                                    @else
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $done_all_bookings }}</p>
                                                    @endif
                                                    <p class="fs-3 mb-0">Selesai</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center"
                                            style="width: 80px;height:80px;">
                                            <i class="ti ti-book-upload fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="earning"></div> --}}
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Denda -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold">Keterlembatan</h5>
                                    @if (auth()->user()->role === 'member')
                                        <h4 class="fw-semibold mb-3">{{ $count_user_forfeits }}</h4>
                                    @else
                                        <h4 class="fw-semibold mb-3">{{ $count_all_forfeits }}</h4>
                                    @endif
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center pb-1">
                                                    <span
                                                        class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-exclamation-mark text-danger"></i>
                                                    </span>
                                                    @if (auth()->user()->role === 'member')
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $active_user_forfeits }}</p>
                                                    @else
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $active_all_forfeits }}</p>
                                                    @endif
                                                    <p class="fs-3 mb-0">Aktif</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex align-items-center pb-1">
                                                    <span
                                                        class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-cash-banknote text-success"></i>
                                                    </span>
                                                    @if (auth()->user()->role === 'member')
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $done_user_forfeits }}</p>
                                                    @else
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $done_all_forfeits }}</p>
                                                    @endif
                                                    <p class="fs-3 mb-0">Dibayar</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center"
                                            style="width: 80px;height:80px;">
                                            <i class="ti ti-alert-circle fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div id="earning"></div> --}}
                    </div>
                </div>
                {{-- user --}}
                @if (auth()->user()->role === 'admin')
                    <div class="col-lg-5">
                        <!-- Denda -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start">
                                    <div class="col-8">
                                        <h5 class="card-title mb-9 fw-semibold">Jumlah Pengguna</h5>
                                        <h4 class="fw-semibold mb-3">{{ $count_user }}</h4>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center pb-1">
                                                        <span
                                                            class="me-2 rounded-circle bg-light-info round-20 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-user text-info"></i>
                                                        </span>
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $member_user }}
                                                        </p>
                                                        <p class="fs-3 mb-0">Member</p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center pb-1">
                                                        <span
                                                            class="me-2 rounded-circle bg-light-dark round-20 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-settings text-dark"></i>
                                                        </span>
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $admin_user }}
                                                        </p>
                                                        <p class="fs-3 mb-0">Admin</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-success rounded-circle p-6 d-flex align-items-center justify-content-center"
                                                style="width: 80px;height:80px;">
                                                <i class="ti ti-users fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="earning"></div> --}}
                        </div>
                    </div>

                    {{-- book --}}
                    <div class="col-lg-5">
                        <!-- Denda -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row alig n-items-start">
                                    <div class="col-8">
                                        <h5 class="card-title mb-9 fw-semibold">Jumlah Buku</h5>
                                        <h4 class="fw-semibold mb-3">{{ $count_book }}</h4>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center pb-1">
                                                        <span
                                                            class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-books text-success"></i>
                                                        </span>
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $avail_book }}
                                                        </p>
                                                        <p class="fs-3 mb-0">Tersedia</p>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center pb-1">
                                                        <span
                                                            class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-exclamation-mark text-danger"></i>
                                                        </span>
                                                        <p class="text-dark me-1 fs-3 mb-0">{{ $empty_book }}
                                                        </p>
                                                        <p class="fs-3 mb-0">Habis</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center"
                                                style="width: 80px;height:80px;">
                                                <i class="ti ti-book fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="earning"></div> --}}
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-5 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <h5 class="card-title fw-semibold">Peminjaman Terakhir</h5>
                                    </div>
                                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                                        @if (auth()->user()->role === 'admin')
                                            @forelse ($all_latest_bookings as $latest_booking)
                                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                                    <div class="timeline-time text-dark flex-shrink-0 text-end">
                                                        {{ date('d-m-Y', strtotime($latest_booking->created_at)) }}</div>
                                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                        <span
                                                            class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                    </div>
                                                    <a href="/dashboard/bookings/{{ $latest_booking->id }}">
                                                        <div class="timeline-desc fs-3 text-dark mt-n1">
                                                            {{ $latest_booking->book->title }}</div>
                                                    </a>
                                                </li>
                                            @empty
                                            @endforelse
                                        @else
                                            @forelse ($latest_bookings as $latest_booking)
                                                <li class="timeline-item d-flex position-relative overflow-hidden">
                                                    <a href="/dashboard/bookings/{{ $latest_booking->id }}">
                                                        <div class="timeline-time text-dark flex-shrink-0 text-end">
                                                            {{ date('d-m-Y', strtotime($latest_booking->created_at)) }}
                                                        </div>
                                                    </a>
                                                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                        <span
                                                            class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                                    </div>
                                                    <a href="/dashboard/bookings/{{ $latest_booking->id }}">
                                                        <div class="timeline-desc fs-3 text-dark mt-n1">
                                                            {{ $latest_booking->book->title }}</div>
                                                    </a>
                                                </li>
                                            @empty
                                            @endforelse
                                        @endif
                                        <li class="timeline-item d-flex position-relative overflow-hidden">
                                            <div class="timeline-time text-dark flex-shrink-0 text-end">
                                                Belum ada &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                                <span
                                                    class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                                {{-- <span class="timeline-badge-border d-block flex-shrink-0"></span> --}}
                                            </div>
                                            <div class="timeline-desc fs-3 text-dark mt-n1">
                                                Belum ada</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection
