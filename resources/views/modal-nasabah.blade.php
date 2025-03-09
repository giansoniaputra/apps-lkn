<div class="modal fade" id="modal-nasabah" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Upload Data Nasabah</h5>
                <button type="button" class="btn-close" id="btn-close-nasabah" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-nasabah">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="rekening" class="form-label">Rekening</label>
                                <input type="text" name="rekening" id="rekening" class="form-control"
                                    placeholder="Masukan Nomor Rekening">
                            </div>
                            <div class="mb-3">
                                <label for="cabang" class="form-label">Cabang</label>
                                <input type="text" name="cabang" id="cabang" class="form-control"
                                    placeholder="Masukan Cabang">
                            </div>
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="text" name="unit" id="unit" class="form-control"
                                    placeholder="Masukan Unit">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Nasabah</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukan Nama Nasabah">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label"></label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="plafond" class="form-label">Plafond</label>
                                <input type="text" name="plafond" id="plafond" class="form-control money"
                                    placeholder="Masukan Plafond">
                            </div>
                            <div class="mb-3">
                                <label for="jenis_agunan" class="form-label">Jenis Agunan</label>
                                <input type="text" name="jenis_agunan" id="jenis_agunan" class="form-control"
                                    placeholder="Masukan Jenis Agunan">
                            </div>
                            <div class="mb-3">
                                <label for="kondisi" class="form-label">Kondisi</label>
                                <input type="text" name="kondisi" id="kondisi" class="form-control"
                                    placeholder="Masukan Kondisi">
                            </div>
                            <div class="mb-3">
                                <label for="pokok" class="form-label">Pokok</label>
                                <input type="text" name="pokok" id="pokok" class="form-control money"
                                    placeholder="Masukan Pokok">
                            </div>
                            <div class="mb-3">
                                <label for="bunga" class="form-label">Bunga</label>
                                <input type="text" name="bunga" id="bunga" class="form-control money"
                                    placeholder="Masukan BUnga">
                            </div>
                            <div class="mb-3">
                                <label for="kolek" class="form-label">Kolektabilitas</label>
                                <select class="form-select form-select-lg" name="kolek" id="kolek">
                                    <option value="">Pilih Kolektabilitas</option>
                                    <option value="1">1 - Lancar</option>
                                    <option value="2">2 - Dalam Perhtian Khusus</option>
                                    <option value="3">3 - Kurang Lancar</option>
                                    <option value="4">4 - Diragukan</option>
                                    <option value="5">5 - Macet</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
