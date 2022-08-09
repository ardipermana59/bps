@extends('layouts.app')

@push('title')
    profile
@endpush

@push('breadcrumb')
    profile
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
                        <label for="profile">Nama Baru</label>
                        <input type="profile" class="form-control @error('profile') is-invalid @enderror"
                            value="{{ old('profilee') }}" id="profile" name="profile" placeholder="Name" required autocomplete="new-profile">

                        @error('profile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile_confirmation">Konfirmasi Nama Baru</label>
                        <input type="profile" class="form-control"
                            value="{{ old('profile') }}" id="profile_confirmation" name="profile_confirmation" placeholder="New Name" required autocomplete="new-profile">
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
