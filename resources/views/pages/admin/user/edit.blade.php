@extends('layouts.app')

@push('title')
    Manajemen User
@endpush

@push('breadcrumb')
    Manajemen User
@endpush


@section('content')
    <div class="row">
        <!-- left column -->
        <div class="col-md-6 col-md-offset-3">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Data User</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('user.update', ['id' => $user->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="box-body">


                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                value="{{$user->username }}" id="username" name="username" placeholder="username" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{$user->email  }}" id="email" name="email" aria-describedby="emailHelp"
                                placeholder="contoh@gmail.com" readonly>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Level</label>
                            <select class="form-control form-control-lg" name="role">
                                <option value="">Pilih Level</option>
                                <option value="admin" {{ ($user->role == 'admin') || (old('role') == 'admin') ? 'selected' : '' }}>Admin</option>
                                <option value="staff" {{ ($user->role == 'staff') || (old('role') == 'staff') ? 'selected' : '' }}>Staff</option>
                                <option value="pegawai" {{ ($user->role == 'pegawai') || (old('role') == 'pegawai') ? 'selected' : '' }}>Pegawai</option>
                                <option value="penilai" {{ ($user->role == 'penilai') || (old('role') == 'penilai') ? 'selected' : '' }}>Penilai</option>
                            </select>
                            @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Level</label>
                            <select class="form-control form-control-lg" name="status">
                                <option value="">Pilih Level</option>
                                <option value="active" {{ ($user->status == 'active') || ( old('status') == 'active') ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ $user->status == 'inactive'|| ( old('status') == 'inactive')  ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
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
