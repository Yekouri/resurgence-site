$(document).ready(function () {    
    $(".profile-form-page-2").hide();

    $(".profile-form-create-next-1").click(function() {
        if (charNameSet()) {
            $(".profile-form-page-1").hide();
            $(".profile-form-page-2").show();
        }
    });

    $(".profile-form-create-back-2").click(function() {
        $(".profile-form-page-2").hide();
        $(".profile-form-page-1").show();
    });

    function charNameSet() {
         if ($("input[name*='name']").val()) {
             return true;
         }
         
        alert('There needs to be a Character name');
        return false;
    }
});