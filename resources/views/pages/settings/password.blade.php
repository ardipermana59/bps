@extends('layouts.app')

@push('title')
    Catatan Kepagawaian
@endpush

@push('breadcrumb')
    Password
@endpush

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-6 col-md-offset-3">
        <!-- general form elements -->
        <div class="box box-primary">
           <div class="box-header with-border">
                    <h3 class="box-title">Ganti Password</h3>
                </div>
            <!-- form start -->
            <form role="form" action="{{ route('password.change') }}" method="post">
                @csrf
                <div  class="box-body">
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
