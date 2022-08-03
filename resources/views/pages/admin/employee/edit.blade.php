@extends('layouts.app')

@push('title')
    Data Pegawai
@endpush

@push('breadcrumb')
    Data Pegawai
@endpush


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('employee.update', ['id' => $data->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" value="{{ old('nip') ? old('nip') : $data->nip }}"
                                id="nip" name="nip" placeholder="nip" readonly>

                        </div>

                        <div class="form-group">
                            <label for="full_name">Nama Pegawai</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                value="{{ old('full_name') ? old('full_name') : $data->full_name }}" id="full_name"
                                name="full_name" placeholder="Nama Lengkap">

                            @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Jeni Kelamin</label>
                            <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender"
                                name="gender">
                                <option value="Laki-laki"
                                    {{ $data->gender == 'Laki-laki' || old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki - laki</option>
                                <option value="Perempuan"
                                    {{ $data->gender == 'Perempuan' || old('gender') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select class="form-control form-control-lg @error('jabatan') is-invalid @enderror"
                                name="jabatan">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('jabatan') && old('jabatan') == $item->id) || ( !old('jabatan') && $data->position_id == $item->id)  ? 'selected' : '' }}>
                                       {{ $item->name }}  </option>
                                @endforeach
                            </select>
                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hp">No Hp</label>
                            <input type="text" class="form-control @error('hp') is-invalid @enderror"
                                value="{{ old('hp') ? old('hp') : $data->hp }}" id="hp" name="hp"
                                placeholder="Nomor Hp">

                            @error('hp')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                                placeholder="Alamat">{{ old('address') ? old('address') : $data->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.box-body -->

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
