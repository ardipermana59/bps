@extends('layouts.app')

@push('title')
    Data Kegiatan
@endpush

@push('breadcrumb')
    Data Kegiatan
@endpush
@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('layouts.modals.modal-delete')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('activity.create') }}"> 
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kegiatan</button>
            </a>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Kegiatan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="activityTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($data as $kegiatan)
                                <tr>
                                    <td class="text-center"></td>
                                    <td>{{ $kegiatan->name }}</td>
                                     <td style="width: 10%" class="text-center">
                                         <a href="{{ route('activity.edit', ['id' => $kegiatan->id]) }}">
                                            <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </a>

                                        <button onclick="confirmDelete('{{ route('activity.destroy', ['id' => $kegiatan->id]) }}')"
                                            class="btn btn-danger" data-toggle="modal" data-target="#modalDelete"><i
                                                class="fa fa-trash"
                                                data-target="#modalDelete"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="width: 1%" class="text-center">No</th>
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
    <script>
        function confirmDelete(url) {
            $('#deleteForm').attr('action', url)
        }
    </script>
    
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function() {
           var t = $('#activityTable').DataTable()
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
