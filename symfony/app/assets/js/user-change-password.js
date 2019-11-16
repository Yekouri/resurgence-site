$(document).ready(function () {
    $(".user-update-form-submit").click(function() {
        if (!confirmPassword()) {
            $(".user-update-form-error").html('Password does not match');
            return false;
        }
        $(".user-update-form-error").html('');
    });

    function confirmPassword() {
    return $(".user-update-form input[name*='password']").val() === $(".user-update-form input[name*='confirm_password']").val();
    }
});