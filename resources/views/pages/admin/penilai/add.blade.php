@extends('layouts.app')

@push('title')
    Tambah Penilai
@endpush

@push('breadcrumb')
    Tambah Penilai
@endpush


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Data Penilai</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('penilai.store') }}" method="post">
                    @csrf
                    <div class="box-body">
                    <div class="form-group">
                            <label for="name">Nama Penilai</label>
                            <select class="form-control select2" name="penilai" style="width: 100%;">
                                <option value="">Pilih Penilai</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('penilai') ? 'selected' : '' }}>
                                        {{ $employee->full_name }} - ({{ $employee->position }})</option>
                                @endforeach
                            </select>
                            @error('penilai')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
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
