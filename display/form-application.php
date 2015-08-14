<form action="" method="post">
    <p>Upload Resume  <input type="file" name="resume"></p>
    <p>Upload Cover Letter and Supporting Documents <input type="text" name="cover_letter"></p>
    <p>Applicant Name  <input type="text"> <input type="text" name="applicant_name"></p>
    <p>Country  <?php require_once $this->html_display_path . 'country-list.php'; ?></p>
    <p>City, State/Province, Zip Code  : <input type="text" name="city"> <input type="text" name="state"> <input type="text" name="zip"></p>
    <p>Primary Phone Number : <input type="text" name="primary_phone_number"></p>
    <p>Secondary Phone Number : <input type="text" name="secondary_phone_number"></p>
    <p>Email Address : <?php echo $user->user_email; ?></p>
    <p>Referral Source <select name="referral_source"><option value=""></option><option value="CW">Company Career Website</option><option value="52">Craigslist Job Board</option><option value="ER">Employee Referral</option><option value="FF">Family/Friends</option><option value="50">Indeed Job Board</option><option value="JF">Job Fair</option><option value="51">LinkedIn Job Board</option><option value="NS">Newspaper Ad</option><option value="OT">Other</option><option value="53">Other Job Board</option><option value="RA">Radio Ad</option><option value="RH">Rehire</option><option value="SN">Social Network site</option><option value="WI">Walk-in</option></select></p>
    <p>Referral Name <input type="text" name="referral_name"></p>

    <h5>Optional EEO and Background Information</h5>
    <p>To comply with laws regarding equal employment opportunity and affirmative action, our company tracks race, gender, disability and veteran status. We need your help with this process. The completion of this section is voluntary and refusal to do so will not affect the processing of your application. This information is kept separate from your application and not viewed by any hiring manager.</p>
    <p>Gender: <input type="radio" name="gender" value="Male"> Male <input type="radio"  name="gender" value="Female"> Female </p>
    <p>Ethnicity: <select name="ethnicity"><option value=""> (none) </option><option value="W">White</option><option value="B">Black or African American</option><option value="H">Hispanic or Latino</option><option value="N">Native Hawaiian or Other Pacific Islander</option><option value="A">Asian</option><option value="I">American Indian or Alaska Native</option><option value="T">Two or more races</option></select></p>
    <p>Do you have a disability? <input type="radio" name="disability" value="Yes"> Yes <input type="radio" name="disability" value="No"> No <input type="radio" name="disability" value="Do not wish to self identify">  Do not wish to self identify </p>
    <p>Are you a U.S. Veteran? <input type="radio" name="us_veteran" value="Yes"> Yes <input type="radio" name="us_veteran" value="No"> No <input type="radio" name="us_veteran" value="Do not wish to self identify">  Do not wish to self identify </p>
    <input type="hidden" name="application_formid" value="<?php echo $application_formid; ?>">
    <?php wp_nonce_field($form_action, $form_nonce_field); ?>
    <p><input type="submit" value="submit"></p>
</form>