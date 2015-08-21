jQuery(function ($) {
    $(".next").click(function () {

        var validation_error = $(this).parents(".form-parts").validate_fields_section();

        if (!validation_error) {
            $(this).parents(".form-parts").hide();
            $(this).parents(".form-parts").next(".form-parts").show();
        }

    });

    $("#application").submit(function () {
        var validation_error = $(this).validate_fields_section();
        return !validation_error;
    });

    jQuery.fn.extend({
        validate_fields_section: function () {

            var error = false;
            //var requiredFields = ["disability", "question_"];
            var requiredFields = ["question_",
                "applicant_name",
                "address",
                "city",
                "state",
                "zip",
                "primary_phone_number",
                "referral_source",
                "referral_name"];

            for (var i = 0; i < requiredFields.length; i++) {

                var $field = $(this).find("[name^='" + requiredFields[i] + "']");

                if ($field.length == 0) {
                    continue;
                }

                var fieldVal = $field.getFieldVal();
                var type = $field.attr("type");

                switch (type) {

                    case "radio" :
                        if (!$field.is(":checked")) {
                            $field.parent().css("color", "#f00");
                            $field.attr("style", "");
                            error = true;
                        } else {
                            $field.parent().attr("style", "");
                        }
                        break;


                    default :
                        if (fieldVal == '' || fieldVal == 0) {
                            $field.css("border", "1px solid #f00");
                            error = true;
                        } else {
                            $field.css("border", "0px");
                        }
                        break;
                }

            }

            return error;

        },
        getFieldVal: function () {
            $this = $(this);
            val = $this.val();
            if (val == $this.attr('placeholder'))
                return '';
            else
                return val;
        }
    });
});



