@extends('layouts.app')

@section('content')
@include('pages.user.modal-delete')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data User</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $i => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ ($user->status == 'active') ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td style="width: 10%" class="text-center">
                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        <button onclick="console.log({{ $user->id }})" class="btn btn-danger"><i class="fa fa-trash" data-toggle="modal" data-target="#modalDelete"></i></button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.content -->
@endsection