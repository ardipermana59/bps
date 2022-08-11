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
    @elseif (auth()->user()->role == 'pegawai')
        @include('pages.pegawai.dashboard')
    @else
        @include('pages.penilai.dashboard')
    @endif
@endsection

