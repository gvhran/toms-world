<script>
    $(document).ready(function() {
        function getSub(perm_id, userID) {
            $('#table_Subpermission').DataTable({
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
                    "url": "<?= base_url('main/get_SubPermission/') ?>" + perm_id + '/' + userID,
                    "type": "POST"
                },
            });
        }

        var tableAccount = $('#table_account').DataTable({
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
                "type": "POST",
                "data": function(data) {
                    data.department_filter = $('#department_filter').val();
                    data.position_filter = $('#position_filter').val();
                }
            },
        });
        $('#department_filter').change(function() {
            tableAccount.draw();
        });
        $('#position_filter').change(function() {
            tableAccount.draw();
        });

        $('#table_permissionManage').DataTable({
            "searching": false,
            "ordering": false,
            "paginate": false,
            "info": false,
            "stateSave": true,
            "bDestroy": true,
        });

        $('#table_department').DataTable({
            "serverSide": true,
            "processing": true,
            "searching": false,
            "ordering": false,
            "paginate": false,
            "info": false,
            "stateSave": true,
            "bDestroy": true,
            "ajax": {
                "url": "<?= base_url('main/getDepartment') ?>",
                "type": "POST"
            },
        });

        $('#table_position').DataTable({
            "serverSide": true,
            "processing": true,
            "searching": false,
            "ordering": false,
            "paginate": false,
            "info": false,
            "stateSave": true,
            "bDestroy": true,
            "ajax": {
                "url": "<?= base_url('main/getPosition') ?>",
                "type": "POST"
            },
        });

        $('#table_branch').DataTable({
            "serverSide": true,
            "processing": true,
            "searching": false,
            "ordering": false,
            "paginate": false,
            "info": false,
            "stateSave": true,
            "bDestroy": true,
            "ajax": {
                "url": "<?= base_url('main/getBranch') ?>",
                "type": "POST"
            },
        });

        $('#table_area').DataTable({
            "serverSide": true,
            "processing": true,
            "searching": false,
            "ordering": false,
            "paginate": false,
            "info": false,
            "stateSave": true,
            "bDestroy": true,
            "ajax": {
                "url": "<?= base_url('main/getArea') ?>",
                "type": "POST"
            },
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
                            // Swal.fire('Thank you!', 'Permission granted.', 'success');
                            // $('#modalSubPermission').modal('show');
                            getSub(perm_id, userID);
                            var table = $('#table_permission').DataTable();
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
                            var table = $('#table_permission').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.action_sub', function() {
            var perm_id = $(this).attr('id');
            var userID = $(this).data('user');
            var subID = $(this).data('sub');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?= base_url() . 'main/add_Subpermission' ?>",
                    type: "POST",
                    data: {
                        userID: userID,
                        perm_id: perm_id,
                        subID: subID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Permission granted.', 'success');
                            var table = $('#table_Subpermission').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url() . 'main/remove_Subpermission' ?>",
                    type: "POST",
                    data: {
                        userID: userID,
                        perm_id: perm_id,
                        subID: subID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Removed permission successfully.', 'success');
                            var table = $('#table_Subpermission').DataTable();
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
                beforeSend: function() {
                    $('#loading').show();
                    $('#save_account').text('Please Wait...');
                    $('#save_account').attr('disabled', true);
                },
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Account already exist.', 'warning');
                    } else if (data.error == 'NotSent') {
                        Swal.fire('Error!', 'Email not sent.', 'error');
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
                complete: function() {
                    $('#loading').hide();
                    $('#save_account').text('Save Account');
                    $('#save_account').attr('disabled', false);
                },
                error: function() {
                    $('#loading').hide();
                    $('#save_account').text('Save Account');
                    $('#save_account').attr('disabled', false);
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

        $(document).on('click', '.add_sub_permission', function() {
            var permID = $(this).attr('id');
            $('#perm_id').val(permID);
            $('#modalAddSubPermission').modal('show');
            $('#table_sub').DataTable({
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
                    "url": "<?= base_url('main/getSubPermission/') ?>" + permID,
                    "type": "POST"
                },
            });
        });

        var rowIdx = 0;
        $(document).on('click', '.add_row', function() {
            console.log('Hello');
            $('#table_body').append(
                `<tr class="data_lot" id="R${++rowIdx}">
                <td class="row-index">
                    <span>${rowIdx}</span>
                </td>
                <td contenteditable="true">
                
                </td>
                <td>
                    <span id="deleteRow">Delete</span>
                </td>
            </tr>`
            );
        });
        // jQuery button click event to remove a row.
        $('#table_body').on('click', '#deleteRow', function() {
            var child = $(this).closest('tr').nextAll();
            child.each(function() {
                var id = $(this).attr('id');
                var idx = $(this).children('.row-index').children('span');
                var dig = parseInt(id.substring(1));
                idx.html(`${dig - 1}`);
                $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });

        $(document).on('click', '.save_permission', function() {
            var permID = $('#perm_id').val();
            var table_data = [];

            $('#table_body .data_lot').each(function(row, tr) {
                var sub = {
                    'sub_details': $(tr).find('td:eq(1)').text(),
                };
                table_data.push(sub);
            });
            if (table_data != '') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url('main/saveSubPermission'); ?>",
                            method: "POST",
                            data: {
                                'data_table': table_data,
                                permID: permID
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.success == 'Success') {
                                    Swal.fire('Thank you!', 'Successfully added.', 'success');
                                    $('#modalSubPermission').modal('hide');
                                }
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                            }
                        });
                    }
                })
            } else {
                Swal.fire("Error!", "Table is empty", "error");
            }
        });

        $(document).on('click', '.view_sub', function() {
            var perm_id = $(this).data('id');
            var userID = $(this).data('sub');
            $('#modalSubPermission').modal('show');
            getSub(perm_id, userID);
        });

        $(document).on('submit', '#addDepartment', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'ManageAccount/addDepartment' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Department already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Successfully added!',
                            'success'
                        );
                        $('#addDepartment').trigger('reset');
                        var table = $('#table_department').DataTable();
                        table.draw();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('submit', '#addPosition', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'ManageAccount/addPosition' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Position already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Successfully added!',
                            'success'
                        );
                        $('#addPosition').trigger('reset');
                        var table = $('#table_position').DataTable();
                        table.draw();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('click', '.print_account', function() {
            window.open("<?= base_url() . 'ManageAccount/printAccount' ?>", 'targetWindow', 'resizable=yes,width=1000,height=1000');
        });

        $(document).on('click', '.resetPassword', function() {
            var userID = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('ManageAccount/resetPassword'); ?>",
                        method: "POST",
                        data: {
                            userID: userID
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.success == 'Success') {
                                Swal.fire('Thank you!', 'Please copy the temporary password: ' + data.tempPass, 'success');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                        }
                    });
                }
            })
        });

        function load_resetAccount(view = '') {
            $.ajax({
                url: "<?= base_url() . 'ManageAccount/getResetData' ?>",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('#resetBoard').html(data.resetAccount);
                }
            });
        }
        load_resetAccount();
        setInterval(function() {
            load_resetAccount();;
        }, 1000);

        $(document).on('submit', '#addBranches', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'Main/addBranches' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Branch already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Successfully added!',
                            'success'
                        );
                        $('#addBranches').trigger('reset');
                        var table = $('#table_branch').DataTable();
                        table.draw();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('submit', '#addArea', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'Main/addArea' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Area already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Successfully added!',
                            'success'
                        );
                        $('#addArea').trigger('reset');
                        var table = $('#table_area').DataTable();
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