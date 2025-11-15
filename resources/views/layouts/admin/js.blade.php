    <!-- Fonts and icons -->
    <script src="{{ asset('assets') }}/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets') }}/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets') }}/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="{{ asset('assets') }}/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets') }}/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets') }}/js/setting-demo2.js"></script>
    <script>
        $(document).ready(function() {
            // Baris 1195 (Kode asli template)
            $("#basic-datatables").DataTable({});

            // TAMBAHKAN KODE INI SETELAH BARIS 1195
            $('#datatable-admin').DataTable({
                pageLength: 10,
                columnDefs: [{
                        orderable: false,
                        targets: 3
                    } // Nonaktifkan sorting di kolom "Aksi"
                ],
            });
            // AKHIR KODE TAMBAHAN

            // $("#multi-filter-select").DataTable({
            //     pageLength: 5,
            //     // ... (Kode Datatables lainnya tetap utuh)
            //     initComplete: function() {
            //         this.api()
            //             .columns()
            //             .every(function() {
            //                 var column = this;
            //                 var select = $(
            //                         '<select class="form-select"><option value=""></option></select>'
            //                     )
            //                     .appendTo($(column.footer()).empty())
            //                     .on("change", function() {
            //                         var val = $.fn.dataTable.util.escapeRegex($(this).val());

            //                         column
            //                             .search(val ? "^" + val + "$" : "", true, false)
            //                             .draw();
            //                     });

            //                 column
            //                     .data()
            //                     .unique()
            //                     .sort()
            //                     .each(function(d, j) {
            //                         select.append(
            //                             '<option value="' + d + '">' + d + "</option>"
            //                         );
            //                     });
            //             });
            //     },
            // });

            // Add Row
            // $("#add-row").DataTable({
            //     pageLength: 5,
            // });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $("#addRowButton").click(function() {
                $("#add-row")
                    .dataTable()
                    .fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action,
                    ]);
                $("#addRowModal").modal("hide");
            });
        });
    </script>
