<script>
    $(document).ready(function() {
        var table = $('#dataAkun').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            lengthChange: false,
            autoWidth: false,
            sortable: true,
            ajax: {
                url: "{{ route('users.index') }}",
                data: {
                    deleted: 0
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                },
                {
                    data: 'username',
                },
                {
                    data: 'role',
                },
                {
                    data: 'action',
                    width: '10%',
                    orderable: false,
                    searchable: false
                },
            ],
            buttons: [{
                    text: 'PDF',
                    title: 'Data Akun',
                    extend: 'pdfHtml5',
                    filename: 'data_akun',
                    orientation: 'potrait', //portrait
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                    customize: function(doc) {
                        doc.styles['table'] = {
                            width: "100%"
                        };
                    }
                },
                {
                    extend: 'print',
                    title: 'Data Akun',
                    exportOptions: {
                        columns: [0, 1, 2, 3],
                    },
                },
                {
                    extend: 'colvis'
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo($('.col-md-6:eq(0)', table.table().container()));
            }
        });

        function tableRecycle() {
            return $('#dataRecycle').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                lengthChange: false,
                autoWidth: false,
                sortable: true,
                ajax: {
                    url: "{{ route('users.index') }}",
                    data: {
                        deleted: 1
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'username',
                    },
                    {
                        data: 'role',
                    },
                    {
                        data: 'action',
                        width: '10%',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        }

        function refreshRecycle() {
            $("#dataRecycle").DataTable().clear().destroy();
            tableRecycle();
        }

        $(document).on('click', '#recycle', function() {

            $("#modalRecycle").modal('show');
            // tableRecycle.ajax.reload();
            refreshRecycle();

        });

        $('#FrmAkun').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                text: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: `Tidak!`,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        text: 'Memuat...',
                        showConfirmButton: false,
                    });

                    var id = $("#id").val();
                    var url = "";
                    var method = "";

                    if (id == "") {
                        url = "/users/store";
                    } else {
                        url = "/users/update";
                    }

                    var formData = new FormData($('#FrmAkun')[0]);
                    formData.append('_token', $("meta[name='csrf-token']").attr('content'));

                    $.ajax({

                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.icon,

                                }).then(function() {
                                    location.reload();
                                });

                            } else {
                                $("#password").val('');
                                Swal.fire({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.icon,
                                    confirmButtonColor: '#d33',

                                });
                            }

                            $("#role select").trigger('change');

                            table.ajax.reload();
                        },
                        cache: false,

                    });
                }
            });
        });

        $(document).on('click', '#detail', function() {

            $("#modalDetail").modal('show');

            $.ajax({

                url: '/users/show/',
                type: 'POST',
                dataType: 'json',
                cache: false,
                data: {
                    id: $(this).attr('data'),
                    _token: $("meta[name='csrf-token']").attr('content'),
                },
                success: function(output) {

                    $(".name").html(output.name);
                    $(".username").html(output.username);
                    $(".role").html(output.role);

                }
            });
        });

        $(document).on('click', '#ubah', function() {

            $(".password").hide().removeAttr('required');

            $.ajax({

                url: '/users/show/',
                type: 'POST',
                dataType: 'json',
                cache: false,
                data: {
                    id: $(this).attr('data'),
                    _token: $("meta[name='csrf-token']").attr('content'),
                },
                success: function(output) {

                    $.each(output, function(key, value) {

                        var inputan = $('[name=' + key + ']');
                        var select = $('select#' + key);

                        if (inputan.prop('type') == 'select-one') select.val(value)
                            .trigger('change');
                        else inputan.val(value);

                    });

                }

            });

        });

        $(document).on('click', '#hapus, #restore, #destroy', function() {

            Swal.fire({
                text: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: `Tidak!`,
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    var aksi = $(this).attr('id');
                    var url = "/users/recycle";

                    var formData = new FormData($('#FrmAkun')[0]);
                    formData.append('_token', $("meta[name='csrf-token']").attr('content'));
                    formData.append('id', $(this).attr('data'));

                    if (aksi == 'hapus') formData.append('deleted', 1);
                    else if (aksi == 'restore') formData.append('deleted', 0);
                    else url = "/users/destroy";

                    $.ajax({

                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.icon,

                                });

                            } else {
                                Swal.fire({
                                    title: response.title,
                                    text: response.text,
                                    icon: response.icon,

                                });
                            }

                            table.ajax.reload();
                            if (aksi == "restore" || aksi == 'destroy')
                                refreshRecycle();
                        },
                        cache: false,

                    });
                }
            });
        });

    });
</script>
