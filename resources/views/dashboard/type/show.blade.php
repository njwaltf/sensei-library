@extends('layouts.app')
@section('main')
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12 my-3">
            <h2><a href="/dashboard/types"><i class="ti ti-arrow-left"></i></a> Detail Genre Buku</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card w-100">
                <div class="card-header">
                    <h5 class="card-title fw-semibold m-3">{{ $type->name }}</h5>
                </div>
                <div class="card-body p-3">
                    {!! $type->desc !!}
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <a href="/dashboard/types" class="btn btn-outline-info">Batal Pinjam</a>
                </div>
            </div>
        </div>
    </div>
@endsection
