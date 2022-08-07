<!-- Modal -->
<div class="modal fade" id="modalAddNilai">
    <div class="modal-dialog" style="width: 500px !important">
        <form id="deleteForm" method="post" style="display: inline">
            @csrf
            <div class="modal-content">
                <!-- header-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nilai Pegawai</h4>
                </div>
                <!--body-->
                <div class="modal-body">
                    <div id="errorMessage"  role="alert">
                        <ul >
                        </ul>
                      </div>
                    <input type="text" name="id_nilai" id="idNilai" value="" hidden>
                    <div class="form-group">
                        <label for="name">Nama Pegawai</label>
                        <input type="text" class="form-control" value="" id="full_name" name="full_name"
                            placeholder="Nama Pegawai" readonly>
                    </div>
                    <div class="form-group">
                        <label for="target">Target</label>
                        <input type="number" class="form-control" value="" id="target" name="target" max="100"
                            placeholder="Target" required>
                    </div>
                    <div class="form-group">
                        <label for="kerjasama">Kerjasama</label>
                        <input type="number" class="form-control" value="" id="kerjasama" name="kerjasama"
                            placeholder="Kerjasama">
                    </div>
                    <div class="form-group">
                        <label for="ketepatan_waktu">Ketepatan Waktu</label>
                        <input type="number" class="form-control" value="" id="ketepatan_waktu" name="ketepatan_waktu"
                            placeholder="Ketepatan Waktu">
                    </div>
                    <div class="form-group">
                        <label for="kualitas">Kualitas</label>
                        <input type="number" class="form-control" value="" id="kualitas" name="kualitas"
                            placeholder="Nama Kriteria">
                    </div>

                </div>
                <!--footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="updateNilai" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
</div>
</div>
