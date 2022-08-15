<!-- Modal -->
<div class="modal fade" id="modalAddFileKegiatan">
    <div class="modal-dialog" style="width: 500px !important">
        <form id="deleteForm" method="post" enctype="multipart/form-data" style="display: inline" >
            @csrf
            @method('put')
            <div class="modal-content">
                <!-- header-->

                <div class="modal-header">
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nilai Pegawai</h4>
                </div>
                <!--body-->
                <div class="box-body">
                        <div class="form-group">
                            <label for="name">Nama Kegiatan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name" name="name" placeholder="Nama Kegiatan">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                     <div class="box-body">
                        <div class="form-group">
                            <label for="name">Nama Penilai</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name" name="name" placeholder="Nama Kegiatan">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                     <div class="box-body">
                        <div class="form-group">
                            <label for="name">Mulai Kegiatan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name" name="name" placeholder="Nama Kegiatan">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                     <div class="box-body">
                        <div class="form-group">
                            <label for="name">Selesai Kegiatan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" id="name" name="name" placeholder="Nama Kegiatan">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                <!--body-->
                <div class="modal-body">
                    <div id="errorMessage" role="alert">
                        <ul>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload File</label> <span style="color: red">*</span>
                        <input type="file" class="form-control" id="file" name="file"  placeholder="Upload File" required readonly>
                        <small class="form-text text-muted">Format file : pdf, word, xls, jpg, png</small>
                    </div>
                    @error('file')
                    <span class="invalid-feedback" role="alert">
                       {{ $message }}
                    </span>
                @enderror
                </div>
                <!--footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="uploadFile" class="btn btn-primary">Simpan</button>
                </div>
        </form>
    </div>
</div>
</div>
