@extends('layouts.app')
@section('main')
    <style>
        .invalid {
            color: red;
        }
    </style>
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
                        <h5 class="card-title fw-semibold m-3">{{ $book->title }}</h5>
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
                    <h5 class="card-title fw-semibold m-3">Deskripsi</h5>
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
            {{-- pinjam card --}}
            @if (auth()->user()->role === 'member' && $book->stock > 0)
                <div class="col-lg-5">
                    <div class="card w-100">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold ">Pinjam {{ $book->title }} ?</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="row m-0">
                                <div class="col-lg-4 m-0">
                                    <form action="/dashboard/bookings" method="POST">
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
        </div>
        @if (auth()->user()->role)
            <div class="row">
                <div class="col-lg-10" id="comment-section">
                    <!-- Comment Card -->
                    <div class="card" style="height: 500px; overflow-y: auto;">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Lihat komentar tentang {{ $book->title }}</h5>
                        </div>
                        <div class="card-body" style="overflow-y: auto;">
                            @if (session()->has('successComment'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {!! session('successComment') !!}
                                    {{-- test aja --}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @forelse ($comments as $item)
                                <!-- Comments -->
                                <div class="media d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $item->user->prof_pic) }}"
                                        class="mr-3 rounded-circle m-2" alt="Profile Picture" height="48"
                                        width="48">
                                    <div class="media-body m-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mt-0 mb-1" style="margin-right: 10px;">
                                                {{ $item->user->name }} @if (auth()->user()->username === $item->user->username)
                                                    <span class="text-muted" style="font-size:12px;">(Komentar
                                                        anda)</span>
                                                @endif
                                            </h5>
                                            <p class="text-muted mb-0" style="font-size:11px;">
                                                {{ $item->created_at->diffForHumans() }}</p>
                                        </div>
                                        {!! $item->comment_text !!}
                                    </div>
                                </div>
                                <hr>
                            @empty
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5 class="text-center m-5">Belum ada komentar tentang buku ini</h5>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <img src="{{ asset('images/Search-pana 1.png') }}" alt="" srcset=""
                                            height="300" width="300">
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    @if (auth()->user()->role === 'member')
                        <!-- Update your comment form -->
                        @if (auth()->check())
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title fw-semibold m-3">Tambah Komentar</h5>
                                </div>
                                <div class="card-body">
                                    <form id="commentForm" action="{{ route('comments.store', $book->id) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <div class="form-group">
                                            <!-- Add the "emoji" class to your textarea -->
                                            <textarea class="form-control emoji @error('comment_text') is-invalid @enderror" name="comment_text" rows="3"
                                                placeholder="Ketik komentar Anda di sini..." id="emojiarea">{{ old('comment_text') }}</textarea>
                                            <script>
                                                $('#emojiarea').emojioneArea({
                                                    pickerPosition: "right"
                                                });
                                            </script>
                                            @error('comment_text')
                                                <p class="invalid">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Kirim Komentar</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <!-- JavaScript to scroll to the comment section on validation failure -->
                        @if ($errors->any())
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.getElementById("commentForm").scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                });
                            </script>
                        @endif
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
