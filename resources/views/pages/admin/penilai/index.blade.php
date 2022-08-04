@extends('layouts.app')

@push('title')
    Penilai
@endpush

@push('breadcrumb')
    Penilai
@endpush

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('layouts.modals.modal-delete')

    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('penilai.create') }}">
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Penilai</button>
            </a>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Penilai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="penilaiTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $penilai)
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">{{ $penilai->nip }}</td>
                                    <td class="text-center">{{ $penilai->full_name }}</td>
                                    <td class="text-center">{{ $penilai->position }}</td>
                                    <td style="width: 10%" class="text-center">


                                        <button
                                            onclick="confirmDelete('{{ route('penilai.destroy', ['id' => $penilai->id_evaluator]) }}')"
                                            class="btn btn-danger" data-toggle="modal" data-target="#modalDelete"><i
                                                class="fa fa-trash" data-target="#modalDelete"></i></button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Jabatan</th>
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
            var t = $('#penilaiTable').DataTable()
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
