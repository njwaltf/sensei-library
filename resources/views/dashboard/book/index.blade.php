@extends('layouts.app')
@section('main')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function addToFavorites(button) {
            var form = $(button).closest('form');
            var formData = form.serialize();

            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Update the view here
                        // You can use response.favorite to get the newly created favorite data
                        // Example: You may change the button appearance
                        $(button).removeClass('btn-outline-danger').addClass('btn-danger');
                        // Additional: Show a success message or perform other actions
                        alert('Added to favorites successfully!');
                    } else {
                        // Handle errors if needed
                        alert('Error adding to favorites');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    alert('Error adding to favorites');
                }
            });
            // Prevent the form from submitting and the page from reloading
            return false;
        }
    </script>

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
    <h1>Daftar Buku</h1>
    @if (auth()->user()->role === 'admin')
        <div class="dropdown">
            <!-- The dropdown button -->
            <button class="dropdown-button" onclick="toggleDropdown1()">Export Data <i class="ti ti-file-text"></i></button>

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
                            <div class="card-container zoom-card">
                                <!-- Wrap the card content with the <a> tag and assign the card-link class -->
                                <a href="/dashboard/books/{{ $item->id }}" class="card-link">
                                    <div class="card d-flex">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                            alt="...">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $item->title }}</h5>
                                            <p class="card-text my-3">{{ Str::limit($item->desc, 50, '...') }}</p>

                                            <!-- Buttons in one row on the right side -->
                                            <div class="d-flex justify-content-start mt-auto py-3">
                                                <a href="/dashboard/books/{{ $item->id }}" class="btn btn-primary mr-2"
                                                    style="margin-right: 10px;">Lihat Detail</a>

                                                <livewire:favorite-button :bookId="$item->id" :key="$item->id" />

                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- Add more card elements as needed -->
                                {{-- <script>
                                    // Get a reference to the button element with the "active" class
                                    var button = document.querySelector('.active');

                                    // Get a reference to the popup container
                                    var popupContainer = document.getElementById('popupContainer');

                                    // Add an event listener for the click event
                                    button.addEventListener('click', function() {
                                        // Show the popup or perform any other action
                                        showPopup();
                                        alert('Already added to favorite!');
                                    });

                                    // Function to show the popup
                                    // function showPopup() {
                                    //     // Show the popup container
                                    //     popupContainer.style.display = 'block';

                                    //     // Close the popup after a certain duration (e.g., 3 seconds)
                                    //     setTimeout(function() {
                                    //         popupContainer.style.display = 'none';
                                    //     }, 3000);
                                    // }
                                </script> --}}
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
                                    {{-- <form action="/dashboard/books/{{ $book->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <!-- Add to favorites button -->
                                        <button class="btn btn-outline-danger btn-circle" onclick="addToFavorites(this)">
                                            <i class="ti ti-heart"></i>
                                        </button>
                                    </form> --}}
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
    <!-- ... Your existing HTML code ... -->

    {{-- <!-- Separate script for handling favorite button click and showing popup -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all elements with the class "btn-circle"
            var favoriteButtons = document.querySelectorAll('.btn-circle');

            // Add a click event listener to each button
            favoriteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Show the popup or perform any other action
                    alert('Already added to favorites');
                });
            });

            // Function to show the popup
            // function showPopup() {
            //     // Your code to display the popup goes here
            //     // For example, you can use a modal or create a custom popup element

            //     // Example using Bootstrap modal
            //     $('#myModal').modal('show');
            // }
        });
    </script> --}}

    <!-- Optional: Bootstrap modal example (add this to the end of your view) -->
    {{-- <div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Favorite Added</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Book has been added to your favorites!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
