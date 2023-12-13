@extends('layouts.app')
@section('main')
    <div class="card">
        @if (session()->has('emailUsed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! session('emailUsed') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('user-profile-update') }}" method="post" enctype="multipart/form-data">
                <div class="row">
                    @csrf
                    <div class="col-lg-4">
                        <img src="@if (auth()->user()->prof_pic > 0) {{ asset('storage/' . auth()->user()->prof_pic) }}
                        @else {{ asset('assets/images/profile/no-pp.png') }} @endif"
                            width="250" height="250" class="rounded-circle" id="preview-selected-image">
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text"
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
                            @error('name')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email"
                                class="form-control @error('email')
                            is-invalid
                        @enderror"
                                id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                            @error('email')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- btn-submit --}}
                        <button type="submit" class="btn btn-primary m-1">Simpan Profile</button>
                        <a href="/dashboard/profile" class="btn btn-outline-danger m-1">Batal</a>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text"
                                class="form-control @error('username')
                            is-invalid
                        @enderror"
                                id="username" name="username" value="{{ old('username', auth()->user()->username) }}">
                            @error('username')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="prof_pic" class="form-label">Upload Profile</label>
                            <input type="file" class="form-control" id="prof_pic" name="prof_pic"
                                value="{{ auth()->user()->prof_pic }}" onchange="previewImage(event);">
                        </div>
                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
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
