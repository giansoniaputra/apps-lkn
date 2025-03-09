$(document).ready(function () {
    // datatables
    let table = $("#tables-nasabah").DataTable({
        scrollX: true,
        info: false,
        searching: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "/dataTablesNasabah",
            data: (d) => {
                d.search = $("#search").val();
            },
        },
        sDom: '<"row"<"col-sm-12"<"table-container"t>r>><"row"<"col-12"p>>', // Hiding all other dom elements except table and pagination
        pageLength: 10,
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#tables-nasabah").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "rekening",
            },
            {
                data: "nama",
            },
            {
                data: "cabang",
            },
            {
                data: "unit",
            },
            {
                data: "action",
                orderable: false,
                searchable: true,
            },
        ],
        language: {
            paginate: {
                previous: '<i class="cs-chevron-left"></i>',
                next: '<i class="cs-chevron-right"></i>',
            },
        },
        initComplete: function (settings, json) {
            _setInlineHeight();
        },
        drawCallback: function (settings) {
            _setInlineHeight();
        },
        columnDefs: [
            {
                targets: [5], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
        ],
    });
    function _setInlineHeight() {
        if (!this._datatable) {
            return;
        }
        const pageLength = this._datatable.page.len();
        document.querySelector(".dataTables_scrollBody").style.height =
            this._staticHeight * pageLength + "px";
    }

    $("#btn-upload-excel").on("click", function () {
        $("#modal-excel").modal("show");
    });
    $("#btn-close-excel").on("click", function () {
        $("#file").val("");
    });
    $("#save-excel").on("click", function () {
        $("#loader3").html(loader3)
        let button = $(this)
        $(button).attr("disabled", "true");
        let file = document.querySelector("input[name='file']");

        let formData = new FormData();
        if (file.value != "") {
            formData.append("file", file.files[0]);
        }

        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $("form[id='form-excel']").serialize(); // Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });
        $.ajax({
            data: formData,
            url: "/upload",
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                $("#loader3").html("")
                $(button).removeAttr("disabled");
                $("#file").val("");
                $("#modal-excel").modal("hide");
                table.ajax.reload()
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $("#loader3").html("")
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    });
    // HAPUS DATA
    $("#tables-nasabah").on("click", ".delete-button", function () {
        //HAPUS DATA
        let id = $(this).attr("data-id");
        let token = csrfToken;
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus debitur ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#loader3").html(loader3)
                $.ajax({
                    data: {
                        _token: token,
                    },
                    url: "/delete/" + id,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        $("#loader3").html("")
                        table.ajax.reload();
                        Swal.fire("Deleted!", response.success, "success");
                    },
                });
            }
        });

    })
    //Hendler Error
    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $("input.form-control").removeClass("is-invalid");
        $("select.form-control").removeClass("is-invalid");
        $("div.invalid-feedback").remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            let inputElement = $("input[name=" + field + "]");
            let selectElement = $("select[name=" + field + "]");
            let textAreaElement = $("textarea[name=" + field + "]");
            let feedbackElement = $(
                '<div class="invalid-feedback ml-2"></div>'
            );

            $("#btn-close-excel").on("click", function () {
                inputElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                textAreaElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                selectElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
            });

            $.each(messages, function (index, message) {
                feedbackElement.append(
                    $('<p class="p-0 m-0" style="font-style=:italic">' + message + "</p>")
                );
            });

            if (inputElement.length > 0) {
                inputElement.addClass("is-invalid");
                inputElement.after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass("is-invalid");
                selectElement.after(feedbackElement);
            }
            if (textAreaElement.length > 0) {
                textAreaElement.addClass("is-invalid");
                textAreaElement.after(feedbackElement);
            }
            inputElement.each(function () {
                if (inputElement.attr("type") == "text" || inputElement.attr("type") == "number") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "date") {
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "password") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "email") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                }
            });
            textAreaElement.each(function () {
                textAreaElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
            selectElement.each(function () {
                selectElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
        });
    }
});
