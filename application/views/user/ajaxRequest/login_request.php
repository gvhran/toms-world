<script>
    $(document).on('submit', '#login_form', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $.ajax({
            url: "<?= base_url() . 'user/login_process' ?>",
            method: "POST",
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.error != '') {
                    $('.message').html(data.error);
                    setTimeout(function() {
                        $('.message').html('');
                    }, 3000)
                } else {
                    $('.message').html(data.success);
                    setTimeout(function() {
                        $('#message').html('');
                        window.location.href = "<?= base_url() . 'main' ?>";
                    }, 3000);
                }
            }
        });
    });

    $(document).on('click', '.reset_password', function() {
        var user = $('#resetUsername').val();
        if (user != '') {
            $.ajax({
                url: "<?= base_url('user/resetPassword') ?>",
                method: "POST",
                data: {
                    user: user
                },
                dataType: "json",
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Username not found.', 'warning');
                    } else {
                        Swal.fire('Thank you!', 'Your password successfully reset. Please wait for the action of admin.', 'success');
                        $('#modalForgotPass').modal('hide');
                        $('#resetUsername').val('');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        } else {
            alert('Please input your username');
        }
    });
</script>