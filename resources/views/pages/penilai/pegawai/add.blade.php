@extends('layouts.app')

@push('title')
    Upload Nilai
@endpush

@push('breadcrumb')
    Upload Nilai
@endpush


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title judul_halaman">Upload Nilai</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                <form role="form" action="{{ route('nilai.store') }}" method="post">
                    @csrf
                    <div class="box-body">
                        <!-- Nama Pegawai -->
                        <div class="form-group">
                            <label for="name">Nama Pegawai</label>
                            <input type="text" class="form-control ambil_Pegawai" value="" id="Pegawai" name="pegawai" placeholder="Nama Pegawai" readonly required>
                        </div>

                        <!-- Kegiatan -->
                        <div class="form-group">
                            <label for="kegiatan">Nama Kegiatan</label>
                            <select id="kegiatan" class="form-control select2 @error('kegiatan') is-invalid @enderror ambil_kegiatans"
                                name="kegiatan" style="width: 100%;" required>
                                <option value="">Pilih Kegiatan</option>
                                @foreach($activities as $activity)
                                    <option class="getnilai" nambilfullname="{{$activity->full_name}}" nambilkegiatanid="{{ $activity->id }}" value="" {{ old('kegiatan') ? 'selected' : '' }}>
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

                        <!-- Input Ambil Kegiatans ID Ke Table Nilai -->
                        <div class="form-group">
                            <input type="input" class="form-control @error('ambil_kegiatan_id') is-invalid @enderror ambil_kegiatan_id_nilai"
                                value="{{ old('ambil_kegiatan_id') }}" id="ambil_kegiatan_id" name="ambil_kegiatan_id"
                                placeholder="Ambil Kegiatan ID" required readonly>

                            @error('ambil_kegiatan_id')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Target Realisasi -->
                        <div class="form-group">
                            <label for="target_realisasi">Target Realisasi</label>
                            <input type="number" class="form-control @error('target_realisasi') is-invalid @enderror ambil_kegiatan_id_nilai"
                                value="{{ old('target_realisasi') }}" id="target_realisasi" name="target_realisasi"
                                placeholder="Target Realisasi" required>

                            @error('target_realisasi')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Kerja Sama -->
                        <div class="form-group">
                            <label for="kerjasama">Kerjasama</label>
                            <input type="number" class="form-control @error('kerjasama') is-invalid @enderror ambil_kegiatan_id_nilai"
                                value="{{ old('kerjasama') }}" id="kerjasama" name="kerjasama"
                                placeholder="Kerjasama" required>

                            @error('kerjasama')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Ketepatan Waktu -->
                        <div class="form-group">
                            <label for="ketepatan_waktu">Ketepatan Waktu</label>
                            <input type="number" class="form-control @error('ketepatan_waktu') is-invalid @enderror ambil_kegiatan_id_nilai"
                                value="{{ old('ketepatan_waktu') }}" id="ketepatan_waktu" name="ketepatan_waktu"
                                placeholder="Ketepatan Waktu" required>

                            @error('ketepatan_waktu')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Kualitas -->
                        <div class="form-group">
                            <label for="kualitas">Kualitas</label>
                            <input type="number" class="form-control @error('kualitas') is-invalid @enderror ambil_kegiatan_id_nilai"
                                value="{{ old('kualitas') }}" id="kualitas" name="kualitas"
                                placeholder="Kualitas" required>

                            @error('kualitas')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <!-- Simpan -->
                    <div class="form-group">
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
