@extends('layouts.app')


@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Kriteria</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($kriteria as $i => $criteria)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $criteria->Nama Kriteria}}</td>
                                    <td style="width: 10%" class="text-center">
                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Kriteria</th>
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

@push('scripts')
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function() {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        })
    </script>
@endpush
