@extends('layouts.app')

@push('title')
    Edit Penilai
@endpush

@push('breadcrumb')
    Edit Penilai
@endpush
@push('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/select2/dist/css/select2.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data Penilai</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('penilai.update', ['id' => $data->id ]) }}" method="post">
                    @csrf
                    @method('put')
                     <div class="box-body">
                        <div class="form-group">
                            <label for="name">NIP</label>
                            <select class="form-control select2" name="pegawai" style="width: 100%;">
                                <option value="" {{ old('pegawai') ? '' : 'selected' }}>Pilih NIP</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('pegawai') ? 'selected' : '' }}>
                                        {{ $employee->employee_nip }} - ({{ $employee->position_nip }})</option>
                                @endforeach
                            </select>
                            @error('pegawai')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                            <div class="form-group">
                            <label for="name">Nama Penilai</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name" name="name" placeholder="Nama Penilai">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Jabatan</label>
                            <select class="form-control select2" name="jabatan" style="width: 100%;">
                                <option value="" {{ old('jabatan') ? '' : 'selected' }}>Pilih Jabatan</option>
                                @foreach ($positios as $position)
                                    <option value="{{ $position->id }}" {{ old('pegawai') ? 'selected' : '' }}>{{ $position->position_name }} -
                                        ({{ $position->position_name }})</option>
                                @endforeach
                            </select>
                            @error('pegawai')
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
    <!-- Select2 -->
    <script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2()
        })
    </script>
@endpush
