<div class="modal fade" id="modal-cetak" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Cetak LKN</h5>
                <button type="button" class="btn-close" id="btn-close-cetak" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/cetak-lkn" method="POST" target="_blank">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="row">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" placeholder=""
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Alasan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                placeholder="Usaha debitur yang bersangkutan sedang mengalami penurunan"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-icon btn-icon-end btn-outline-danger mb-1">
                    <span>Cetak</span>
                    <i class="ri-file-pdf-2-line"></i>
                </button>
            </div>
        </div>
    </div>
    </form>
</div>
