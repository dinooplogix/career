
jQuery("[name='register_form']").submit(function (e) {



    // Fom validation register form

    var error = false;

    var requiredFields = ["user_email", "user_pass", "confirm_password"];

    for (var i = 0; i < requiredFields.length; i++) {

        var $field = jQuery("[name='" + requiredFields[i] + "']");
        var fieldVal = getVal($field);
        var type = $field.attr("type");

        switch (type) {

            case "radio" :
                if (!$field.is(":checked")) {
                    $field.parent().css("color", "#f00");
                    $field.attr("style", "");
                } else {
                    $field.parent().attr("style", "");
                }
                break;


            default :
                if (fieldVal == '' || fieldVal == 0) {
                    $field.css("borderColor", "#f00");
                    error = true;
                } else {
                    $field.css("borderColor", "#CCC");
                }
                break;
        }

    }

    $pass1 = jQuery("[name='user_pass']");
    $pass2 = jQuery("[name='confirm_password']");
    $pass1_val = $pass1.val();
    $pass2_val = $pass2.val();


    if ($pass1_val != $pass2_val) {
        $pass1.css("borderColor", "#f00");
        $pass2.css("borderColor", "#f00");
        error = true;
    }

    if (error == true) {
        e.preventDefault();
    }
});


$pass1 = jQuery("[name='user_pass']");
$pass2 = jQuery("[name='confirm_password']");

$pass1.keyup(function () {
    $pass1_val = $pass1.val().length;
    if ($pass1_val < 5) {
        jQuery(".strength").html('<div class="strength-red">Very Weak</div>');
    }
    if ($pass1_val > 8) {
        jQuery(".strength").html('<div class="strength-green">Strong</div>');
    }


});


$pass2.keyup(function () {

    $pass1_val = $pass1.val();
    $pass2_val = $pass2.val();

    if ($pass1_val != $pass2_val) {
        jQuery(".strength").html('<div class="strength-red">Password Mismatch</div>');
    } else {
        jQuery(".strength").html('');
    }
});


//Replace the place holder with null string
function getVal($this) {
    val = $this.val();
    if (val == $this.attr('placeholder'))
        return '';
    else
        return val;
}


