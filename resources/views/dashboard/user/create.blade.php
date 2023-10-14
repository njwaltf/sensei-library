@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/users"><i class="ti ti-arrow-left"></i></a> Tambah Pengguna</h2>
        </div>
    </div>
    <form action="/dashboard/users" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        {{-- <input type="hidden" name="status" value="{{ 'Dalam Proses' }}"> --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informasi Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <p>Isikan nama lengkap pengguna.</p>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}">
                                    @error('name')
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
                                    <label for="username" class="form-label">Username</label>
                                    <p>Isikan nama pengguna.</p>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="username" name="username" value="{{ old('username') }}">
                                    @error('username')
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
                                    <label for="" class="form-label">Email</label>
                                    <p>Isikan alamat email.</p>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
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
                                    <label for="role" class="form-label">Role</label>
                                    <p>Atur Role Pengguna.</p>
                                    <select class="form-select @error('role') is-invalid @enderror"
                                        aria-label="Default select example" id="role" name="role">
                                        <option value="{{ 'member' }}">Member</option>
                                        <option value="{{ 'admin' }}">Admin</option>
                                    </select>
                                    @error('role')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <p>Isikan password pengguna.</p>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" value="{{ old('password') }}">
                                    @error('password')
                                        <p class="invalid" style="color: red">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="prof_pic" value="{{ 'profile/user-2.png' }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px">Tambah Pengguna <i
                        class="ti ti-plus"></i></button>
                <a href="/dashboard/books" class="btn btn-outline-warning">Batal</a>
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
