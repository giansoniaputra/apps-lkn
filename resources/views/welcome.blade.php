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
                                            <select id="select2Basic">
                                                <option label="&nbsp;">Pilih Nomor Rekening</option>
                                                @foreach ($nasabah as $row)
                                                    <option value="{{ $row->rekening }}">{{ $row->rekening }} -
                                                        {{ $row->nama }}</option>
                                                @endforeach
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
                    <!-- Basic Single End -->
                    <!-- Search End -->

                    <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
                        <div class="d-inline-block me-0 me-sm-3 float-start float-md-none">
                            <!-- Add Button Start -->
                            <button id="btn-add-data"
                                class="btn btn-icon btn-icon-only btn-foreground-alternate shadow add-datatable"
                                data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Produk"
                                type="button">
                                <i data-acorn-icon="plus"></i>
                            </button>
                            {{--
                        <!-- Add Button End -->

                        <!-- Edit Button Start -->
                        <button
                            class="btn btn-icon btn-icon-only btn-foreground-alternate shadow edit-datatable disabled"
                            data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"
                            type="button">
                            <i data-acorn-icon="edit"></i>
                        </button>
                        <!-- Edit Button End -->

                        <!-- Delete Button Start -->
                        <button
                            class="btn btn-icon btn-icon-only btn-foreground-alternate shadow disabled delete-datatable"
                            data-bs-delay="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                            type="button">
                            <i data-acorn-icon="bin"></i>
                        </button>
                        <!-- Delete Button End --> --}}
                        </div>
                        {{-- <div class="d-inline-block">
                        <!-- Print Button Start -->
                        <button class="btn btn-icon btn-icon-only btn-foreground-alternate shadow datatable-print"
                            data-bs-delay="0" data-datatable="#datatableRowsServerSide" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Print" type="button">
                            <i data-acorn-icon="print"></i>
                        </button>
                        <!-- Print Button End -->

                        <!-- Export Dropdown Start -->
                        <div class="d-inline-block datatable-export" data-datatable="#datatableRowsServerSide">
                            <button class="btn p-0" data-bs-toggle="dropdown" type="button" data-bs-offset="0,3">
                                <span class="btn btn-icon btn-icon-only btn-foreground-alternate shadow dropdown"
                                    data-bs-delay="0" data-bs-placement="top" data-bs-toggle="tooltip" title="Export">
                                    <i data-acorn-icon="download"></i>
                                </span>
                            </button>
                            <div class="dropdown-menu shadow dropdown-menu-end">
                                <button class="dropdown-item export-copy" type="button">Copy</button>
                                <button class="dropdown-item export-excel" type="button">Excel</button>
                                <button class="dropdown-item export-cvs" type="button">Cvs</button>
                            </div>
                        </div>
                        <!-- Export Dropdown End -->

                        <!-- Length Start -->
                        <div class="dropdown-as-select d-inline-block datatable-length"
                            data-datatable="#datatableRowsServerSide" data-childSelector="span">
                            <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" data-bs-offset="0,3">
                                <span class="btn btn-foreground-alternate dropdown-toggle" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-delay="0" title="Item Count">
                                    10 Items
                                </span>
                            </button>
                            <div class="dropdown-menu shadow dropdown-menu-end">
                                <a class="dropdown-item" href="#">5 Items</a>
                                <a class="dropdown-item active" href="#">10 Items</a>
                                <a class="dropdown-item" href="#">20 Items</a>
                            </div>
                        </div>
                        <!-- Length End -->
                    </div> --}}
                    </div>
                </div>
                <!-- Controls End -->

                <!-- Table Start -->
                <!-- Table Start -->
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
                <!-- Table End -->
                <!-- Table End -->
            </div>
        </div>
    </div>
    @include('modal-excel')
@endsection
@section('js_after')
    <script src="/page-script/dashboard.js"></script>
    <script src="/assets/js/vendor/select2.full.min.js"></script>
    <script src="/assets/js/forms/controls.select2.js"></script>
@endsection
