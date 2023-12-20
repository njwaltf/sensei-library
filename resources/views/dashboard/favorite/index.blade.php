@extends('layouts.app')

@section('main')
    <!-- Add this line at the top of your view to listen for Livewire events -->
    @livewireScripts

    <style>
        /* Add this CSS for zoom effect on hover */
        .zoom-card:hover {
            transition: transform 0.4s ease;
            /* Adjust the duration and easing as needed */
            transform: scale(1.1);
            /* Adjust the scaling factor for zoom effect */
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            /* Adjust the gap as needed */
        }

        .card {
            width: 280px;
            /* Adjust the width as needed */
        }

        /* Set the <a> tag to display its content without acting as a block */
        .card-link {
            display: contents;
        }

        /* Custom styles for the circular button */
        .btn-circle {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .btn-circle:hover {
            background-color: #ff5c62;
            /* Change to the desired hover color */
            color: white;
        }
    </style>

    <h1>Daftar Buku Favorit {{ explode(' ', auth()->user()->name)[0] }}</h1>

    <!--  Row 1 -->
    <div class="row py-5">
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
                <div class="row">
                    @forelse ($favorites as $item)
                        <div class="col-md-3 col-lg-3">
                            <div class="card-container zoom-card">
                                <a href="/dashboard/books/{{ $item->book->id }}" class="card-link">
                                    <div class="card d-flex" id="card-{{ $item->book->id }}">
                                        <img src="{{ asset('storage/' . $item->book->image) }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $item->book->title }}</h5>
                                            <p class="card-text my-3 text-dark">
                                                {{ Str::limit($item->book->desc, 50, '...') }}</p>

                                            <div class="d-flex justify-content-start mt-auto py-3">
                                                <a href="/dashboard/books/{{ $item->book->id }}"
                                                    class="btn btn-primary mr-2" style="margin-right: 10px;">Lihat
                                                    Detail</a>
                                                <script>
                                                    Livewire.on('favoriteStatusUpdated', (isFavorite, bookId) => {
                                                        if (!isFavorite) {
                                                            document.getElementById('card-' + bookId).remove();
                                                        }
                                                    });
                                                </script>
                                                <livewire:favorite-button :bookId="$item->book->id" :key="$item->book->id" />
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="text-center m-5">Belum ada favorit nih</h2>
                            </div>
                            <div class="col-lg-12 text-center">
                                <img src="{{ asset('images/Bibliophile-amico 1.png') }}" alt="" srcset="">
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        @else
            <h2>You don't have permission</h2>
        @endif
    </div>
@endsection
