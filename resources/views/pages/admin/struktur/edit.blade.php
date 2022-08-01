@extends('layouts.app')

@push('title')
    Data Penilai Pegawai
@endpush

@push('breadcrumb')
    Data Penilai Pegawai
@endpush

@section('content')
    <div class="row">
            <!-- left column -->
            <div class="col-md-6 col-md-offset-3">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Penilai Pegawai</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('stuktur.update', ['id' => $data->id ]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nama Penilai</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $data->name }}" id="name" name="name" placeholder="Nama Penilai">
                                <label for="name">Nama Pegawai</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ $data->name }}" id="name" name="name" placeholder="Nama Pegawai">
                                    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.content -->
    @endsection

    @push('scripts')
        @php
        // dd($errors)
        @endphp
    @endpush

