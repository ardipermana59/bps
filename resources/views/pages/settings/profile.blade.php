@extends('layouts.app')

@push('title')
    Catatan Kepegawaian
@endpush

@push('breadcrumb')
    Profile
@endpush

@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Profile</h3>
                </div>
                <!-- form start -->
                <form role="form" action="{{ route('profile.change') }}" method="post">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->username }}" id="username"
                                name="username" placeholder="Nama lengkap" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" value="{{ $data->nip }}" id="nip"
                                name="nip" placeholder="NIP" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') ? old('name') : auth()->user()->name }}" id="name"
                                name="name" placeholder="Nama lengkap" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') ? old('email') : auth()->user()->email }}" id="email"
                                name="email" placeholder="Email" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hp">Jenis Kelamin</label>
                            <select class="form-control form-control-lg" name="gender" required>
                                <option value="">Pilih Level</option>
                                <option value="Laki-laki" {{ ($data->gender == 'Laki-laki') || (old('gender') == 'Laki-laki') ? 'selected' : '' }}>Laki - laki
                                <option value="Perempuan" {{ ($data->gender == 'Perempuan') || (old('gender') == 'Perempuan') ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="hp">No Hp</label>
                            <input type="text" class="form-control @error('hp') is-invalid @enderror"
                                value="{{ old('hp') ? old('hp') : $data->hp }}" id="hp" name="hp"
                                placeholder="Nomor Hp" required>
                            @error('hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" cols="30"
                                rows="10" required>{{ old('address') ? old('address') : $data->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
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
