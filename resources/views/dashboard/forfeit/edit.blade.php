@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/forfeits"><i class="ti ti-arrow-left"></i></a> Detail Pembayaran</h2>
        </div>
    </div>
    <div class="row">
        @if ($forfeit->book->image)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">{{ $forfeit->book->title }}</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $forfeit->book->image) }}" height="250" width="200"
                            class="m-2">
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title fw-semibold m-1">Informasi Lanjutan</h5>
                </div>
                <div class="card-body p-3">
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Peminjam</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $forfeit->user->name }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Judul Buku</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ $forfeit->book->title }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Peminjaman</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ date('d-m-Y', strtotime($forfeit->booking->book_at)) }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Harus Kembali</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1" @if ($forfeit->booking->expired_date != 0) style="color:red" @endif>
                                {{ date('d-m-Y', strtotime($forfeit->booking->expired_date)) }}*
                            </p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6">
                            <strong class="m-1">Tanggal Pengembalian</strong>
                        </div>
                        <div class="col-lg-6">
                            <p class="m-1">{{ date('d-m-Y', strtotime($forfeit->booking->return_date)) }}</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Status Denda</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <span
                                @if ($forfeit->status === 'Menunggu') class="badge bg-warning rounded-3 fw-semibold"
                                                    @elseif ($forfeit->status === 'Belum Dibayar') class="badge bg-danger rounded-3 fw-semibold" @elseif ($forfeit->status === 'Dibayar') class="badge bg-success rounded-3 fw-semibold" @elseif ($forfeit->status === 'Tolak') class="badge bg-danger rounded-3 fw-semibold" @endif>{{ $forfeit->status }}</span>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Metode Pembayaran</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <p class="m-1">E Wallet</p>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">Total Denda</strong>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <strong class="m-1">@currency($forfeit->cost)</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($forfeit->status === 'Dibayar')
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $forfeit->pay_image) }}" height="250" width="250"
                            class="m-2 text-center">
                    </div>
                </div>
            </div>
        @endif
        @if (auth()->user()->role === 'member' && $forfeit->status != 'Dibayar')
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">Upload Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="title" class="form-label">Bukti Pembayaran</label>
                            <p>Silahkan bayar denda sebesar yang ditentukan dan upload bukti disini.</p>
                            <form action="{{ route('upload-payment') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('put') --}}
                                <input type="file" class="form-control @error('pay_image') is-invalid @enderror"
                                    id="image" name="pay_image" value="" onchange="previewImage(event);"
                                    @if ($forfeit->status === 'Dibayar') disabled @endif required>
                                <input type="hidden" name="id" value="{{ $forfeit->id }}">
                                <input type="hidden" name="status" value="{{ 'Menunggu' }}">
                                @if ($forfeit->pay_image > 0)
                                    <img id="preview-selected-image" class="img-fluid m-2" height="200" width="150"
                                        src="{{ asset('storage/' . $forfeit->pay_image) }}">
                                @else
                                    <img id="preview-selected-image" class="img-fluid m-2" height="200" width="150">
                                @endif
                                @error('image')
                                    <p class="invalid" style="color: red">
                                        {{ $message }}
                                    </p>
                                @enderror
                                {{-- <input type="hidden" name="user_id" value="{{ $forfeit->user_id }}">
                                <input type="hidden" name="user_id" value="{{ $forfeit->booking_id }}"> --}}
                                <button type="submit" class="btn btn-primary my-4" style="margin-right: 15px;">Upload
                                    <i class="ti ti-upload"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @else
            @if ($forfeit->pay_image)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Bukti Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $forfeit->pay_image) }}" height="250" width="250"
                                class="m-2 text-center">
                        </div>
                    </div>
                </div>
            @endif --}}
        @endif
        @if (auth()->user()->role === 'admin' && $forfeit->status != 'Belum Dibayar')
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $forfeit->pay_image) }}" height="250" width="250"
                            class="m-2 text-center">
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @if (auth()->user()->role === 'admin' && $forfeit->status != 'Belum Dibayar')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Proses Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="title" class="form-label">Ubah status pembayaran denda dari
                                    {{ $forfeit->user->name }}</label>
                                <p>Anda dapat menolak atau menerima bukti pembayaran dari pengguna</p>
                                <form action="/dashboard/forfeits/{{ $forfeit->id }}" method="post">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="booking_id" value="{{ $forfeit->booking_id }}">
                                    <input type="hidden" name="user_id" value="{{ $forfeit->user->id }}">
                                    <input type="hidden" name="desc"
                                        value="{{ 'Denda kamu memiliki status baru!' }}">
                                    <input type="hidden" name="title" value="{{ 'Pembaruan status Denda' }}">
                                    <select class="form-select @error('status') is-invalid @enderror"
                                        aria-label="Default select example" id="status" name="status"
                                        @if ($forfeit->status === 'Dibayar') disabled @endif>
                                        <option value="{{ 'Dibayar' }}"
                                            @if ($forfeit->status === 'Dibayar') selected @endif>
                                            Konfirmasi Pembayaran
                                        </option>
                                        <option value="{{ 'Tolak' }}"
                                            @if ($forfeit->status === 'Tolak') selected @endif>
                                            Tolak Pembayaran
                                        </option>
                                    </select>
                                    {{-- <input type="hidden" name="isDenda" value="{{ 0 }}"> --}}
                                    <button type="submit" class="btn btn-primary my-4"
                                        style="margin-right: 15px;">Perbarui
                                        Status Denda
                                        <i class="ti ti-checkup-list"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (auth()->user()->role === 'member')
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">DANA</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('images/Dana-QR-Code.png') }}" height="250" width="250"
                                class="m-2 text-center">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">Gopay</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('images/Dana-QR-Code.png') }}" height="250" width="250"
                                class="m-2 text-center">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title fw-semibold m-3">ShopeePay</h5>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('images/Dana-QR-Code.png') }}" height="250" width="250"
                                class="m-2 text-center">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
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
