<!-- Modal -->
<div class="modal fade" id="modalDelete">
    <div class="modal-dialog" style="width: 500px !important">
        <div class="modal-content">
            <!-- header-->
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
            </div>
            <!--body-->
            <form method="post" action="{{ route('user.destroy') }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-body">

                </div>
                <!--footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
