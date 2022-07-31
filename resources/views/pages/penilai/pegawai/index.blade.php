@extends('layouts.app')
@push('title')
    Input Nilai Pegawai
@endpush

@push('breadcrumb')
    Input Nilai Pegawai
@endpush
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
                    <table id="inputTablePegawai" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Pegawai</th>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Kriteria 1</th>
                                <th class="text-center">Kriteria 2</th>
                                <th class="text-center">Kriteria 3</th>
                                <th class="text-center">Kriteria 4</th>
                                <th class="text-center">Hasil</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $faker = Faker\Factory::create();
                            @endphp
                            @for ($i = 1; $i < 30; $i++)
                                <tr>
                                    <td class="text-center"></td>
                                    <td>{{ $faker->name }}</td>
                                    <td>{{ $faker->jobTitle }}</td>
                                    <td class="text-center">{{ 2.5 * rand(30,40) }}</td>
                                    <td class="text-center">{{ 2.5 * rand(30,40) }}</td>
                                    <td class="text-center">{{ 2.5 * rand(30,40) }}</td>
                                    <td class="text-center">{{ 2.5 * rand(30,40) }}</td>
                                    <td class="text-center">{{ 1.25 * rand(60,80) }}</td>
                                    <td style="width: 10%" class="text-center">
                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Pegawai</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Kriteria 1</th>
                                <th class="text-center">Kriteria 2</th>
                                <th class="text-center">Kriteria 3</th>
                                <th class="text-center">Kriteria 4</th>
                                <th class="text-center">Hasil</th>
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
            var t = $('#inputTablePegawai').DataTable()

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