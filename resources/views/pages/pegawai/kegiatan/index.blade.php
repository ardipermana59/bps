@extends('layouts.app')
@push('title')
    Kegiatan
@endpush

@push('breadcrumb')
    Kegiatan
@endpush
@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('pages.pegawai.kegiatan.file_upload')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('pegawai.kegiatan.laporan') }}">
                <button class="btn btn-primary"><i class="fa-solid fa-file-arrow-down"></i> PDF</button>
            </a>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Pegawai</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="kegiatan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 1%">No</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Nama Penilai</th>
                                <th class="text-center">Mulai Kegiatan</th>
                                <th class="text-center">Selesai Kegiatan</th>
                                <th class="text-center" style="width: 10%">Upload Hasil</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center"></td>
                                    <td>{{ $item->activity_name }}</td>
                                    <td class="text-center">
                                        @if ($item->url_file != null)
                                            <a href="{{ asset('file_kegiatan/'.$item->url_file) }}">Download</a>|
                                            <a href="#" data-toggle="modal" data-target="#modalAddFileKegiatan"
                                            onclick="confirmUpload('{{ $item->id }}' )">Upload Ulang</a>
                                        @else
                                            <a href="#" data-toggle="modal" data-target="#modalAddFileKegiatan"
                                                onclick="confirmUpload('{{ $item->id }}' )">Upload</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Kegiatan</th>
                                <th class="text-center">Nama Penilai</th>
                                <th class="text-center">Mulai Kegiatan</th>
                                <th class="text-center">Selesai Kegiatan</th>
                                <th class="text-center">Upload Hasil</th>
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
        @if ($errors->any())
            $('#modalAddFileKegiatan form').show
        @endif
        function confirmUpload(id) {
            $('#modalAddFileKegiatan form').attr('action', "{{ url('/') }}/pegawai/kegiatan/upload/" + id)
        }
    </script>
    <script src="{{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function() {
            var t = $('#kegiatan').DataTable()
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