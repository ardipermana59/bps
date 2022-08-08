@extends('layouts.app')

@push('title')
    Ganti Password
@endpush

@push('breadcrumb')
    Ganti Password
@endpush

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
           
            <!-- form start -->
            <form role="form" action="{{ route('password.change') }}" method="post">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" id="password" name="password" placeholder="*******" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control"
                            value="{{ old('password') }}" id="password_confirmation" name="password_confirmation" placeholder="*******" required autocomplete="new-password">
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
