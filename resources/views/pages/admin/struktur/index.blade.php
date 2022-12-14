@extends('layouts.app')
@push('title')
    Data Strukur Penilai & Pegawai
@endpush

@push('breadcrumb')
    Data Strukur Penilai & Pegawai
@endpush
@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('layouts.modals.modal-delete')

    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('struktur.create') }}">
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Struktur</button>
            </a>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Penilai Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="strukturTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Penilai</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Nama Karyawan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center"></td>
                                    <!-- Penilai 1 - Position -->
                                    <td>{{ $item->evaluator_name }} ({{ $item->evaluator_position }}) </td>
                                    <!-- Kegiatan -->
                                    <td>{{ $item->kegiatan }}</td>

                                    <td>{{ $item->employee_name }}</td>
                                    



                                    <td style="width: 10%" class="text-center">
                                        <a href="{{ route('struktur.edit', ['id' => $item->id]) }}">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <button
                                            onclick="confirmDelete('{{ route('struktur.destroy', ['id' => $item->id]) }}')"
                                            class="btn btn-danger"><i class="fa fa-trash" data-toggle="modal"
                                                data-target="#modalDelete"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Penilai</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Nama Pegawai</th>
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
    <script>
        function confirmDelete(url) {
            $('#deleteForm').attr('action', url)
        }
    </script>
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function() {
            var t = $('#strukturTable').DataTable()

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
