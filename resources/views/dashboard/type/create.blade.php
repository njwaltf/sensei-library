@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/types"><i class="ti ti-arrow-left"></i></a> Tambah Genre Buku</h2>
        </div>
    </div>
    <form action="/dashboard/types" method="post">
        @csrf
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
                                    <label for="title" class="form-label">Nama Genre</label>
                                    <p>Isikan judul buku yang akan diupdate.</p>
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
                                    <label for="bully_desc" class="form-label">Deskripsi Genre</label>
                                    <p>Isikan deskripsi buku secara singkat.</p>
                                    <textarea name="desc" id="" cols="160" rows="10" class="form-control">{{ old('desc') }}</textarea>
                                    @error('desc')
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
                <button type="submit" class="btn btn-primary" style="margin-right: 15px">Tambah Genre<i
                        class="ti ti-plus"></i></button>
                <a href="/dashboard/types" class="btn btn-outline-warning">Batal</a>
            </div>
        </div>
    </form>
@endsection
