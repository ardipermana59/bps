@extends('layouts.app')
@push('title')
    Laporan Nilai Pegawai
@endpush

@push('breadcrumb')
    Laporan Nilai Pegawai
@endpush
@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endpush

@section('content')
    @include('pages.admin.laporan.add')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ route('laporan.pdf') }}">
                <button class="btn btn-primary"><i class="fa-solid fa-file-arrow-down"></i> PDF</button>
            </a>
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
                                <th class="text-center">Target</th>
                                <th class="text-center">Realisasi</th>
                                <th class="text-center">Mulai Kegiatan</th>
                                <th class="text-center">Selesai Kegiatan</th>
                                <th class="text-center">Nilai Target</th>
                                <th class="text-center">Kerjasama</th>
                                <th class="text-center">Ketepatan Waktu</th>
                                <th class="text-center">Kualitas</th>
                                <th class="text-center">Hasil</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                @php
                                    $hasil = 0;
                                @endphp
                                <tr>
                                    <td class="text-center"></td>
                                    <td>{{ $item->full_name }}</td>
                                    <td>{{ $item->activity_name }}</td>
                                    <td id="target_kegiatan{{ $item->id }}" class="text-center">{{ $item->target_kegiatan ?? '-' }}</td>
                                    <td id="realisasi{{ $item->id }}" class="text-center">{{ $item->realisasi ?? '-' }}</td>
                                    <td id="mulai_kegiatan{{ $item->id }}" class="text-center">{{ $item->mulai_kegiatan ?? '-' }}</td>
                                    <td id="selesai_kegiatan{{ $item->id }}" class="text-center">{{ $item->selesai_kegiatan ?? '-' }}</td>
                                    <td id="target{{ $item->id }}" class="text-center">{{ $item->target }}</td>
                                    <td id="kerjasama{{ $item->id }}" class="text-center">{{ $item->kerjasama }}</td>
                                    <td id="ketepatan_waktu{{ $item->id }}" class="text-center">
                                        {{ $item->ketepatan_waktu }}</td>
                                    <td id="kualitas{{ $item->id }}" class="text-center">{{ $item->kualitas }}</td>
                                    <td id="hasil{{ $item->id }}" class="text-center">
                                        {{ ($item->target * 40) / 100 + ($item->kerjasama * 10) / 100 + ($item->ketepatan_waktu * 40) / 100 + ($item->kualitas * 10) / 100 }}
                                    </td>
                                    
                                    <td style="width: 15%" class="text-center">
                                        <button onclick="editNilai('{{ $item }}')" class="btn btn-warning"><i
                                                class="fa fa-pencil"></i></button>
                                                
                                        <a href="{{ route('laporan.pdf.employee', ['id' => $item->print_id]) }}"
                                            class="btn btn-primary "><i class="fa-solid fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Pegawai</th>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Target</th>
                                <th class="text-center">Realisasi</th>
                                <th class="text-center">Mulai Kegiatan</th>
                                <th class="text-center">Selesai Kegiatan</th>
                                <th class="text-center">Nilai Target</th>
                                <th class="text-center">Kerjasama</th>
                                <th class="text-center">Ketepatan Waktu</th>
                                <th class="text-center">Kualitas</th>
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
    <script>
        function editNilai(data) {
            var data = JSON.parse(data)
            $('#idNilai').val(data.id);
            $('#full_name').val(data.full_name);
            $('#target').val(data.target);
            $('#kerjasama').val(data.kerjasama);
            $('#ketepatan_waktu').val(data.ketepatan_waktu);
            $('#kualitas').val(data.kualitas);

            $('#target_kegiatan').val(data.target_kegiatan ?? '');
            $('#realisasi').val(data.realisasi ?? '');
            $('#mulai_kegiatan').val(data.mulai_kegiatan ?? '');
            $('#selesai_kegiatan').val(data.selesai_kegiatan ?? '');
            $('#modalAddNilai').modal('show');
        }

        jQuery(document).ready(function() {
            $('#updateNilai').click(function(e) {
                let id = jQuery('#idNilai').val()
                let target = jQuery('#target').val()
                let kerjasama = jQuery('#kerjasama').val()
                let ketepatan_waktu = jQuery('#ketepatan_waktu').val()
                let kualitas = jQuery('#kualitas').val()
                let target_kegiatan = jQuery('#target_kegiatan').val()
                let realisasi = jQuery('#realisasi').val()
                let mulai_kegiatan = jQuery('#mulai_kegiatan').val()
                let selesai_kegiatan = jQuery('#selesai_kegiatan').val()

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#modalAddNilai').modal('hide');
                Swal.fire({
                    title: 'Proses...',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $("#errorMessage").removeClass("alert alert-danger")
                $("#errorMessage ul").empty()

                $.ajax({
                    url: "{{ url('/') }}/laporan/nilai/pegawai/" + id,
                    method: 'put',
                    data: {
                        id: id,
                        target: target,
                        kerjasama: kerjasama,
                        ketepatan_waktu: ketepatan_waktu,
                        kualitas: kualitas,
                        target_kegiatan: target_kegiatan,
                        realisasi: realisasi,
                        mulai_kegiatan: mulai_kegiatan,
                        selesai_kegiatan: selesai_kegiatan,
                    },
                    error: function(result) {
                        switch (result.status) {
                            case 404:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Data tidak ditemukan',
                                })
                                break;
                            case 422:
                                var errors = $.parseJSON(result.responseText);
                                $("#errorMessage").addClass("alert alert-danger")
                                $.each(errors.errors, function(key, value) {
                                    $("#errorMessage ul").append(`<li>${value}</li>`)

                                })
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Data gagal disimpan',
                                })
                                $('#modalAddNilai').modal('show');

                                break;
                            case 500:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Internal Server error',
                                })
                                break;
                            default:
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Data gagal disimpan. Error code ' + result
                                        .status,
                                })
                                break;
                        }
                    },

                    success: function(result) {
                        $("#target_kegiatan" + id).text(target_kegiatan)
                        $("#realisasi" + id).text(realisasi)
                        $("#mulai_kegiatan" + id).text(mulai_kegiatan)
                        $("#selesai_kegiatan" + id).text(selesai_kegiatan)
                        $("#target" + id).text(target)
                        $("#kerjasama" + id).text(kerjasama)
                        $("#ketepatan_waktu" + id).text(ketepatan_waktu)
                        $("#kualitas" + id).text(kualitas)
                        $("#hasil" + id).text((target * 40 / 100) + (kerjasama * 10 / 100) + (
                            ketepatan_waktu * 40 / 100) + (kualitas * 10 / 100))

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.success,
                        })
                    },
                });
            });
        })
    </script>
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
