@extends('layouts.app')
@push('title')
    Data Laporan
@endpush

@push('breadcrumb')
    Data Laporan
@endpush
@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
@include('layouts.modals.modal-delete')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="laporanTable" class="table table-bordered table-striped">
                        <thead>
                            <tr class="align-middle">
                                <th style="width: 1%; text-align: center; justify-content: center;align-content: center;margin: auto"
                                    class="text-center" rowspan="2">No</th>
                                <th class="text-center" rowspan="2">Nama Penilai</th>
                                <th class="text-center" rowspan="2">Nama Pegawai</th>
                                <th class="text-center" rowspan="2">Nama Kegiatan</th>
                                <th class="text-center" colspan="4">Kriteria</th>
                                <th class="text-center" rowspan="2">Hasil</th>
                            </tr>
                            <tr>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Aksi</th>
                                <th class="text-center">Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $faker = Faker\Factory::create();
                            @endphp
                            @for ($i = 1; $i < 30; $i++)
                                <tr>
                                    <td></td>
                                    <td>{{ $faker->jobTitle }}</td>
                                    <td style="width: 10%" class="text-center">
                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Penilai</th>
                                <th class="text-center">Nama Pegawai</th>
                                <th class="text-center">Nama Kegiatan</th>
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
            var t = $('#laporanTable').DataTable()

            // create dynamic row number for table
            t.on('order.dt search.dt', function() {
                let i = 1;
                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();
        })
    </script>
@endpush
