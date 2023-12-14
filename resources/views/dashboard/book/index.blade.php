@extends('layouts.app')
@section('main')
    <h1>Daftar Buku</h1>
    @if (auth()->user()->role === 'admin')
        <div class="dropdown">
            <!-- The dropdown button -->
            <button class="dropdown-button" onclick="toggleDropdown()">Export Data <i class="ti ti-file-text"></i></button>

            <!-- The dropdown content -->
            <div class="dropdown-content" id="myDropdown">
                <a href="{{ url('pdf/export-book/') }}">PDF</a>
                <a href="{{ url('excel/export-book/') }}">Excel</a>
                {{-- <a href="#">Something else here</a> --}}
            </div>
        </div>
        {{-- <a class="btn btn-info my-3" href="">Export Book Data to pdf</a> --}}
    @endif
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
            <div class="container-fluid">
                <form method="get">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <input type="text" class="form-control" name="search_keyword"
                                    placeholder="Cari buku atau pengarang ..."
                                    value="{{ request()->get('search_keyword') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <button class="btn btn-primary" type="submit">Cari <i class="ti ti-search"></i></button>
                        </div>
                    </div>
                </form>
                {{-- <div id="reader" width="600px"></div> --}}
                <div class="row">
                    @forelse ($books as $item)
                        <div class="col-md-3 col-lg-3">
                            <style>
                                .card-container {
                                    display: flex;
                                    flex-wrap: wrap;
                                    gap: 10px;
                                    /* Adjust the gap as needed */
                                }

                                .card {
                                    width: 280px;
                                    /* Adjust the width as needed */
                                    transition: transform 0.3s;
                                    /* Add a smooth transition for the transform property */
                                }

                                .card:hover {
                                    transform: scale(1.05);
                                    /* Apply a scale transform on hover to create the zoom effect */
                                }

                                /* Set the <a> tag to display its content without acting as a block */
                                .card-link {
                                    display: contents;
                                }
                            </style>

                            <div class="card-container">
                                <!-- Wrap the card content with the <a> tag and assign the card-link class -->
                                <a href="/dashboard/books/{{ $item->id }}" class="card-link">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->title }}</h5>
                                            <p class="card-text my-3">{{ Str::limit($item->desc, 50, '...') }}</p>
                                            <a href="/dashboard/books/{{ $item->id }}" class="btn btn-primary">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </a>
                                <!-- Add more card elements as needed -->
                            </div>
                        </div>

                    @empty
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="text-center m-5">Buku tidak ditemukan</h2>
                            </div>
                            <div class="col-lg-12 text-center">
                                <img src="{{ asset('images/Search-pana 1.png') }}" alt="" srcset="">
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        @else
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
                                <h6 class="fw-semibold mb-0">Stok</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Penerbit</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $book->title }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1"
                                        @if ($book->stock > 0) style="color:green;" @else style="color:red;" @endif>
                                        @if ($book->stock > 0)
                                            {{ $book->stock }}
                                        @else
                                            {{ 'Habis' }}
                                        @endif
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ $book->publisher }}
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    {{-- detail --}}
                                    <a href="/dashboard/books/{{ $book->id }}" class="btn btn-info m-1">Detail <i
                                            class="ti ti-arrow-right"></i></a>
                                    {{-- update --}}
                                    <a href="/dashboard/books/{{ $book->id }}/edit" class="btn btn-warning m-1">Ubah
                                        <i class="ti ti-edit"></i></a>
                                    {{-- delete --}}
                                    <form action="/dashboard/books/{{ $book->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger m-1" type="submit"
                                            onclick="return confirm('Apakah kamu yakin ingin menghapus buku ini?')">Hapus
                                            <i class="ti ti-circle-x"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada Peminjaman
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
