@extends('layouts.app')

@push('title')
    Halaman Utama
@endpush

@push('breadcrumb')
    Halaman Utama
@endpush

@section('content')
    @if (auth()->user()->role == 'admin')
        @include('pages.admin.dashboard')
    @else
        @include('pages.pegawai.dashboard')
    @endif
@endsection

