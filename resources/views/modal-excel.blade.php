<div class="modal fade" id="modal-excel" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Upload File Excel</h5>
                <button type="button" class="btn-close" id="btn-close-excel" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-excel">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">File Excel</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="file" name="file">
                                </div>
                                {{-- <div class="mb-2">
                                    <form class="d-flex">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
                                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                    placeholder="" aria-describedby="helpId" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="mb-2">
                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                            placeholder="Usaha debitur yang bersangkutan sedang mengalami penurunan"></textarea>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-icon btn-icon-end btn-outline-secondary mb-1" type="button" id="save-excel">
                    <span>Upload</span>
                    <i class="ri-upload-2-line"></i>
                </button>
            </div>
        </div>
    </div>
</div>
