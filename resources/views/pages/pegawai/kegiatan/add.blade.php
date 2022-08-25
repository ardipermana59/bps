@extends('layouts.app')

@push('title')
    Upload Kegiatan
@endpush

@push('breadcrumb')
    Upload Kegiatan
@endpush


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload Kegiatan</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('pegawai.kegiatan.store') }}" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Nama Penilai</label>
                            <input type="text" class="form-control ambil_penilai" value="" id="penilai"
                                name="penilai" placeholder="Nama Penilai" readonly required>
                        </div>

                        
                        <div class="form-group">
                            <label for="kegiatan">Nama Kegiatan</label>
                            <select id="kegiatan" class="form-control select2 @error('kegiatan') is-invalid @enderror ambil_kegiatan"
                                name="kegiatan" style="width: 100%;" required>
                                <option value="">Pilih Kegiatan</option>
                                @foreach ($activities as $activity)
                                    <option class="getnilai" npenilai="{{$activity->full_name }}"value="{{ $activity->id }}" {{ old('kegiatan') ? 'selected' : '' }}>
                                        {{ $activity->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Target">Target</label>
                            <select id="target" class="form-control select2 @error('target') is-invalid @enderror"
                                name="target" style="width: 100%;" required>
                                <option value="">-Pilih Target-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @error('target')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="realisasi">Realisasi</label>
                            <select id="realisasi" class="form-control select2 @error('realisasi') is-invalid @enderror"
                                name="realisasi" style="width: 100%;" required>
                                <option value="">-Pilih Realisasi-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            @error('realisasi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="mulai_kegiatan">Mulai Kegiatan</label>
                            <input type="date" class="form-control @error('mulai_kegiatan') is-invalid @enderror"
                                value="{{ old('mulai_kegiatan') }}" id="mulai_kegiatan" name="mulai_kegiatan"
                                placeholder="Mulai Kegiatan" required>

                            @error('mulai_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="selesai_kegiatan">Selesai Kegiatan</label>
                            <input id="selesai_kegiatan" type="date"
                                class="form-control @error('selesai_kegiatan') is-invalid @enderror"
                                value="{{ old('selesai_kegiatan') }}" id="selesai_kegiatan" name="selesai_kegiatan"
                                placeholder="Waktu Selesai Kegiatan" required>
                            @error('selesai_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
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

<script>
    
</script>
