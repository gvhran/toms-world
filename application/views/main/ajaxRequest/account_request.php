<script>
    $(document).ready(function() {
        $('#table_account').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                paginate: {
                    next: '<i class="bi bi-chevron-right"></i>',
                    previous: '<i class="bi bi-chevron-left"></i>'
                }
            },
            "ordering": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            // "responsive": true,
            "ajax": {
                "url": "<?= base_url('main/get_accountData') ?>",
                "type": "POST"
            },
        });

        $('#table_permissionManage').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
            },
            "ordering": false,
            "paginate": false,
            "info": false,
            "stateSave": true,
            "bDestroy": true,
        });

        $(document).on('click', '.add_permission', function() {
            var accountID = $(this).attr('id');
            $('#modalPermission').modal('show');
            $('#table_permission').DataTable({
                "ordering": false,
                "paginate": false,
                "searching": false,
                "info": false,
                "serverSide": true,
                "processing": true,
                "pageLength": 25,
                "stateSave": true,
                "bDestroy": true,
                "ajax": {
                    "url": "<?= base_url('main/get_Permission/') ?>" + accountID,
                    "type": "POST"
                },
            });
        });

        $(document).on('click', '.action_session', function() {
            var perm_id = $(this).attr('id');
            var userID = $(this).data('user');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?= base_url() . 'main/add_permission' ?>",
                    type: "POST",
                    data: {
                        userID: userID,
                        perm_id: perm_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Permission granted.', 'success');
                            var table = $('#table_account').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url() . 'main/remove_permission' ?>",
                    type: "POST",
                    data: {
                        userID: userID,
                        perm_id: perm_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Removed permission successfully.', 'success');
                            var table = $('#table_account').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            }
        });

        $(document).on('submit', '#addAccount', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'user/account_register' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Account already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Account successfully created. Credentials sent successfully!',
                            'success'
                        );
                        $('#modalNewAccount').modal('hide');
                        var table = $('#table_account').DataTable();
                        table.draw();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('click', '.account_activation', function() {
            var userID = $(this).attr('id');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?= base_url() . 'main/account_activated' ?>",
                    type: "POST",
                    data: {
                        userID: userID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Account activated.', 'success');
                            var table = $('#table_account').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }

                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url() . 'main/account_deactivated' ?>",
                    type: "POST",
                    data: {
                        userID: userID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Account deactivated.', 'success');
                            var table = $('#table_account').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            }
        });

        $(document).on('submit', '#addPermissionForm', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'main/createPermission' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Permission already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Permission successfully added!',
                            'success'
                        );
                        $('#addPermissionForm').trigger('reset');
                        var table = $('#table_permissionManage').DataTable();
                        table.draw();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

    }); //end of document ready
</script>