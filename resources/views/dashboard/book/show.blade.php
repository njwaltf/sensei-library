@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/books"><i class="ti ti-arrow-left"></i></a> Detail Buku</h2>
        </div>
    </div>
    <div class="row">
        @if ($book->image)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">Cover Buku</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $book->image) }}" height="440" class="m-2">
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
                            <strong class="m-1">Penulis</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $book->writer }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Terbit</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $book->publish_date }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Genre</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1">{{ $book->type->name }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Stok</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1"
                                @if ($book->stock > 0) style="color: green;"
                            @else
                            style="color: red;" @endif>
                                @if ($book->stock > 0)
                                    {{ $book->stock }}
                                @else
                                    Tidak Tersedia
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Penerbit</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1">{{ $book->publisher }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title fw-semibold m-3">{{ $book->title }}</h5>
                </div>
                <div class="card-body p-3">
                    {!! $book->desc !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">Kode QR</h5>
                    </div>
                    <div class="card-body">
                        {{-- <img src="{{ asset('storage/' . $book->image) }}" height="250" width="250"
                            class="m-2 text-center"> --}}
                        {!! QrCode::size(250)->generate('http://127.0.0.1:8000/dashboard/books/' . $book->id) !!}
                        {{-- btn add --}}
                        @if (auth()->user()->role === 'admin')
                            <a class="btn btn-info my-3" href="{{ url('/qr/export/' . $book->id) }}">Export QR PDF <i
                                    class="ti ti-file-text"></i></a>
                        @endif
                        {{-- <img src="{!! QrCode::format('png')->generate('http://127.0.0.1:8000/dashboard/books/' . $book->id) !!}"> --}}
                    </div>
                </div>
            </div>
            @if (auth()->user()->role === 'member' && $book->stock > 0)
                <div class="col-lg-5">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold ">Pinjam {{ $book->title }} ?</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="row m-0">
                                <div class="col-lg-4 m-0">
                                    <form action="/dashboard/bookings" method="post">
                                        @csrf
                                        <input type="hidden" value="{{ $book->id }}" name="book_id">
                                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                        <input type="hidden" value="{{ 'Diajukan' }}" name="status">
                                        <input type="hidden" value="{{ 0 }}" name="isDenda">
                                        <input type="hidden" value="{{ $book->stock }}" name="stock">
                                        <button class="btn btn-primary" type="submit">Pinjam Buku</button>
                                    </form>
                                </div>
                                {{-- <p>{{ $date_now->format('d-m-Y') }}</p> --}}
                                <div class="col-lg-4 m-0">
                                    <a href="/dashboard/books" class="btn btn-outline-warning">Batal Pinjam</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold ">Lihat Komentar</h5>
                    </div>
                    <div class="card-body p-3">
                        <div class="row m-0">
                            <div class="col-lg-12 m-0">
                                <form action="/dashboard/comments" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $book->id }}" name="book_id">
                                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" placeholder="Ketikan sesuatu..." name="caption"
                                                class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-primary" type="submit">Kirim <i
                                                    class="ti ti-"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12 m-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <strong>gojoo</strong>
                                    </div>
                                    <div class="col-lg-5">
                                        <p>isi komennyaaasjjkdashjd</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
@endsection
