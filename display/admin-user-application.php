<div class="wrap">
    <h2>Job Application</h2>

    <?php
    $user_id = $_GET['user'];

    $crObj = new CR_View();
    $application = $crObj->get_user_submitted_forms($user_id);

    if (!empty($application)) {
        $application = get_user_meta($user_id, $application[0], true);
    } else {
        echo '<p>No applications were found</p>';
        return false;
    }
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th>Resume</th>
                <td><a href="<?php echo wp_get_attachment_url($application['resume']); ?>" target="_blank">Download</a></td>
            </tr>
            <tr>
                <th>Cover Letter</th>
                <td><a href="<?php echo wp_get_attachment_url($application['cover_letter']); ?>" target="_blank">Download</a></td>
            </tr>
            <tr>
                <th>First Name</th>
                <td><?php echo $application['applicant_name']; ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo $application['country']; ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo $application['city']; ?></td>
            </tr>
            <tr>
                <th>State</th>
                <td><?php echo $application['state']; ?></td>
            </tr>
            <tr>
                <th>Zip</th>
                <td><?php echo $application['zip']; ?></td>
            </tr>
            <tr>
                <th>Primary Phone Number</th>
                <td><?php echo $application['primary_phone_number']; ?></td>
            </tr>
            <tr>
                <th>Seconder Phone Number</th>
                <td><?php echo $application['secondary_phone_number']; ?></td>
            </tr>
            <tr>
                <th>Referral Source</th>
                <td><?php echo $application['referral_source']; ?></td>
            </tr>
            <tr>
                <th>Referral Name</th>
                <td><?php echo $application['referral_name']; ?></td>
            </tr>
            <tr>
                <th colspan="2"><h4>Optional EEO and Background Information</h4></th>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?php echo $application['gender']; ?></td>
        </tr>
        <tr>
            <th>Ethnicity</th>
            <td><?php echo $application['ethnicity']; ?></td>
        </tr>
        <tr>
            <th>Do you have a disability? </th>
            <td><?php echo $application['disability']; ?></td>
        </tr>
        <tr>
            <th>Are you a U.S. Veteran?</th>
            <td><?php echo $application['us_veteran']; ?></td>
        </tr>

        <tr>
            <th>Other questions</th>
            <td><?php
    $question_paper = $crObj->get_refined_question_answers($application, $user_id);
    foreach ($question_paper as $qa) {
        echo '<p><strong> Q: ' . $qa['question'] . '</strong></p>';
        echo '<p>' . $qa['answer'] . '</p>';
    }
    ?></td>
        </tr>

        </tbody>


    </table>

</div>