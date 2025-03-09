@extends('layouts.main')
@section('js_before')
    <link rel="stylesheet" href="/assets/css/vendor/select2.min.css" />
    <link rel="stylesheet" href="/assets/css/vendor/select2-bootstrap4.min.css" />
@endsection
@section('container')
    <div class="card">
        <div class="card-body">
            <div class="data-table-rows slim">
                <!-- Controls Start -->
                <div class="row">
                    <!-- Search Start -->
                    <!-- Basic Single Start -->
                    <section class="scroll-section" id="basicSingle">
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Cari Nomor Rekening</label>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-2">
                                        <div class="w-100">
                                            <select id="select2Basic" name="search">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <button class="btn btn-icon btn-icon-end btn-outline-success mb-1"
                                            id="btn-upload-excel" type="button" style="float: right">
                                            <span>Upload Excel</span>
                                            <i class="ri-file-excel-2-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
                        <div class="d-inline-block me-0 me-sm-3 float-start float-md-none">
                            <!-- Add Button Start -->
                            <button id="btn-add-data"
                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow add-datatable"
                                data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Produk"
                                type="button">
                                <i data-acorn-icon="plus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="data-table-responsive-wrapper">
                    <table id="tables-nasabah" class="data-table nowrap hover">
                        <thead>
                            <tr>
                                <th class="text-muted text-small text-uppercase">No</th>
                                <th class="text-muted text-small text-uppercase">JNo Rekening</th>
                                <th class="text-muted text-small text-uppercase">Nasabah</th>
                                <th class="text-muted text-small text-uppercase">Cabang</th>
                                <th class="text-muted text-small text-uppercase">Unit</th>
                                <th class="text-muted text-small text-uppercase">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @include('modal-excel')
    @include('modal-nasabah')
    @include('modal-cetak')
@endsection
@section('js_after')
    <script src="/page-script/dashboard.js"></script>
    <script src="/assets/js/vendor/select2.full.min.js"></script>
    <script src="/assets/js/forms/controls.select2.js"></script>
    @include('script-included.money')
@endsection
