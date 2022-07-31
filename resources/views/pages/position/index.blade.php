@extends('layouts.app')

@push('title')
    Jabatan
@endpush

@push('breadcrumb')
    Jabatan
@endpush

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('pages.position.modal-delete')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('position.create') }}"> 
                <button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Jabatan</button>
            </a>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Jabatan Kepegawaian</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $i => $jabatan)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $jabatan->name }}</td>
                                    </td>
                                     <td style="width: 10%" class="text-center">
                                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                                        <button onclick="confirmDelete('{{ route('position.destroy', ['id' => $jabatan->id]) }}')"
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
                                <th class="text-center">Nama jabatan</th>
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
            $('#example1').DataTable()
        })
    </script>
@endpush
