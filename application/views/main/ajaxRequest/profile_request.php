<script>
    $(document).on('submit', '#register_form', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $.ajax({
            url: "<?= base_url() . 'main/updateProfile' ?>",
            method: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.message == 'Success') {
                    Swal.fire(
                        'Thank you!',
                        'Profile account successfully updated.',
                        'success'
                    );
                    setTimeout(function() {
                        window.location.href = "<?= base_url('main/logout') ?>"
                    }, 2000);
                } else {
                    Swal.fire('Error!', 'Error in updating. Please try again later.', 'warning');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
            }
        });
    });

    function checkPasswordMatch() {
        var password = $("#yourPassword").val();
        var confirmPassword = $("#confirmPassword").val();
        if (password != confirmPassword) {
            $("#error-message").text("Passwords does not match!");
            $("#error-message").removeClass("alert alert-success");
            $("#error-message").addClass("alert alert-danger");
            $("#register_btn").attr("disabled", true);
        } else {
            $("#error-message").text("Passwords match.");
            $("#error-message").removeClass("alert alert-danger");
            $("#error-message").addClass("alert alert-success");
            $("#register_btn").attr("disabled", false);
        }
    }
    $(document).ready(function() {
        var password = $("#yourPassword").val();
        $("#confirmPassword").keyup(checkPasswordMatch);
    });
    $(document).on('keyup', '#yourPassword, #confirmPassword', function() {
        if ($(this).val() == '') {
            $("#error-message").text("");
            $("#error-message").removeClass("alert alert-danger");
            $("#error-message").removeClass("alert alert-success");
        }
    });
</script>