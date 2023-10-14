@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/books"><i class="ti ti-arrow-left"></i></a> Tambah Buku</h2>
        </div>
    </div>
    <form action="/dashboard/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
        @method('put')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informasi Utama</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="title" class="form-label">Judul Buku</label>
                                    <p>Isikan judul buku yang akan diupdate.</p>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $book->title) }}">
                                    @error('title')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="bully_desc" class="form-label">Deskripsi Buku</label>
                                    <p>Isikan deskripsi buku secara singkat.</p>
                                    <input id="bully_desc" type="hidden" name="desc"
                                        value="{{ old('desc', $book->desc) }}">
                                    <trix-editor input="bully_desc"></trix-editor>
                                    @error('desc')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="title" class="form-label">Genre Buku</label>
                                    <p>Pilih genre buku yang sesuai.</p>
                                    <select class="form-select @error('type') is-invalid @enderror"
                                        aria-label="Default select example" id="type" name="type">
                                        <option value="{{ 'Fiksi' }}"
                                            @if ($book->type === 'Fiksi') selected @endif>Fiksi</option>
                                        <option value="{{ 'Non Fiksi' }}"
                                            @if ($book->type === 'Non Fiksi') selected @endif>Non Fiksi</option>
                                    </select>
                                    @error('type')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- tersangka dan korban --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informasi Buku & Penulis</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="stock" class="form-label">Jumlah Stok</label>
                                    <p>Jumlah stok buku yang tersedia saat ini</p>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" value="{{ old('stock', $book->stock) }}">
                                    @error('stock')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <label for="publisher" class="form-label">Nama Penerbit</label>
                                    <p>Isikan nama perusahaan penerbit dari buku ini</p>
                                    <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                        id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}">
                                    @error('publisher')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-4">
                                    <label for="writer" class="form-label">Nama Penulis</label>
                                    <p>Isikan nama penulis dari buku ini.</p>
                                    <input type="text" class="form-control @error('writer') is-invalid @enderror"
                                        id="writer" name="writer" value="{{ old('writer', $book->writer) }}">
                                    @error('writer')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <label for="publish_date" class="form-label">Tanggal Terbit</label>
                                    <p>Tanggal terbit dari buku.</p>
                                    <input type="date" class="form-control @error('publish_date') is-invalid @enderror"
                                        id="publish_date" name="publish_date"
                                        value="{{ old('publish_date', $book->publish_date) }}">
                                    @error('publish_date')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- latar tempat dan waktu --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Upload Cover</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Upload Foto Cover</label>
                                    <p>Upload gambar cover dari buku</p>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" value="" onchange="previewImage(event);">
                                    @if ($book->image > 0)
                                        <img id="preview-selected-image" class="img-fluid m-2" height="200"
                                            width="150" src="{{ asset('storage/' . $book->image) }}">
                                    @else
                                        <img id="preview-selected-image" class="img-fluid m-2" height="200"
                                            width="150">
                                    @endif
                                    @error('image')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <button type="submit" class="btn btn-warning" style="margin-right: 15px">Edit Buku <i
                        class="ti ti-pencil"></i></button>
                <a href="/dashboard/books" class="btn btn-outline-primary">Batal</a>
            </div>
        </div>
    </form>
    <script>
        const previewImage = (event) => {
            /**
             * Get the selected files.
             */
            const imageFiles = event.target.files;
            /**
             * Count the number of files selected.
             */
            const imageFilesLength = imageFiles.length;
            /**
             * If at least one image is selected, then proceed to display the preview.
             */
            if (imageFilesLength > 0) {
                /**
                 * Get the image path.
                 */
                const imageSrc = URL.createObjectURL(imageFiles[0]);
                /**
                 * Select the image preview element.
                 */
                const imagePreviewElement = document.querySelector("#preview-selected-image");
                /**
                 * Assign the path to the image preview element.
                 */
                imagePreviewElement.src = imageSrc;
                /**
                 * Show the element by changing the display value to "block".
                 */
                imagePreviewElement.style.display = "block";
            }
        };
    </script>
@endsection