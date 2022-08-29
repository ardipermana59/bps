@extends('layouts.app')

@push('title')
    Edit Struktur
@endpush

@push('breadcrumb')
    Edit Struktur
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
                    <h3 class="box-title">Edit Data Struktur</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('struktur.update', ['id' => $struktur->id ]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Nama Penilai</label>
                            <select class="form-control select2" name="penilai" style="width: 100%;">
                                <option value="" {{ old('penilai') ? '' : 'selected' }}>Pilih Penilai</option>
                                @foreach ($evaluators as $evaluator)
                                    <option value="{{ $evaluator->id }}" {{ $struktur->evaluator_id == $evaluator->id ? 'selected' : '' }}>
                                        {{ $evaluator->evaluator_name }} - ({{ $evaluator->position_name }})</option>
                                @endforeach
                            </select>
                            @error('penilai')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                         <div class="form-group">
                            <label for="name">Nama Kegiatan</label>
                            <select class="form-control select2" name="kegiatan" style="width: 100%;">
                                <option value="" {{ old('kegiatan') ? '' : 'selected' }}>Pilih Kegiatan</option>
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}" {{ old('kegiatan') ? 'selected' : '' }}>
                                        {{ $activity->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                            @error('kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Pegawai</label>
                            <select class="form-control select2" name="pegawai" style="width: 100%;">
                                <option value="" {{ old('pegawai') ? '' : 'selected' }}>Pilih Penilai</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ $struktur->employee_id == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->employee_name }} - ({{ $employee->position_name }})</option>
                                @endforeach
                            </select>
                            @error('pegawai')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Kegiatan</label>
                            <select class="form-control select2" name="kegiatan" style="width: 100%;">
                                <option value="" {{ old('kegiatan') ? '' : 'selected' }}>kegiatan</option>
                                @foreach ($activities as $act)
                                    <option value="{{ $act->id }}" {{ $struktur->activity_id === $act->id ? 'selected' : '' }}>
                                        {{ $act->name }}</option>
                                @endforeach
                            </select>
                            @error('kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>



                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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
