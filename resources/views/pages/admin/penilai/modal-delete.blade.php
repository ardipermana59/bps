<!-- Modal -->
<div class="modal fade" id="modalDelete">
    <div class="modal-dialog" style="width: 500px !important">
        <form id="deleteForm" method="post"  style="display: inline">
            @csrf
            @method('delete')
            <div class="modal-content">
                <!-- header-->
                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Hapus Data Penilai</h4>
                </div>
                <!--body-->
                <div class="modal-body">
                    <p style="font-size: 1.5rem">
                        Anda yakin ingin hapus data ini ?
                    </p>
                </div>
                <!--footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
        </form>
    </div>
</div>
</div>