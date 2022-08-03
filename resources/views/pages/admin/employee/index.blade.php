@extends('layouts.app')
@push('title')
    Data Pegawai
@endpush

@push('breadcrumb')
    Data Pegawai
@endpush
@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('layouts.modals.modal-delete')

    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('employee.create') }}">
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pegawai</button>
            </a>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="employeeTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">NIP</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">No Hp</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pegawai as $employee)
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">{{ $employee->nip ?? '-' }}</td>
                                    <td>{{ $employee->full_name ?? '-' }}</td>
                                    <td class="text-center">{{ $employee->position ?? '-' }}</td>
                                    <td class="text-center">{{ $employee->email ?? '-' }}</td>
                                    <td class="text-center">{{ $employee->gender ?? '-' }}</td>
                                    <td class="text-center">{{ $employee->hp ?? '-' }}</td>
                                    <td class="text-center">{{ $employee->address ?? '-' }}</td>
                                    <td style="width: 10%" class="text-center">
                                        <a href="{{ route('employee.edit', ['id' => $employee->id]) }}">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <button
                                            onclick="confirmDelete('{{ route('employee.destroy', ['id' => $employee->id]) }}')"
                                            class="btn btn-danger" data-toggle="modal" data-target="#modalDelete"><i
                                                class="fa fa-trash" data-target="#modalDelete"></i></button>
                                        </form>
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
                                <th class="text-center">Email</th>
                                <th class="text-center">Jenis Kelamin</th>
                                <th class="text-center">No Hp</th>
                                <th class="text-center">Alamat</th>
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
            var t = $('#employeeTable').DataTable()
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
