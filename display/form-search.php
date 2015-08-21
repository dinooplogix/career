
<p>Thank you for your interest in working with the Battery Systems Family of Companies. We are always excited to meet highly qualified people, passionate about serving others with the talent that they have!</p>

<form action="" method="post" class="search_form">
    
    <p>Location: <?php echo $this->display_search_select_box('cr_location', $cr_location); ?></p>
    <p>Position: <?php echo $this->display_search_select_box('cr_position', $cr_position); ?></p>
    <p>Job Category: <?php echo $this->display_search_select_box('cr_category', $cr_category); ?></p>
    
    <?php wp_nonce_field($form_action, $form_nonce_field); ?>
    <input type="submit" value="Search">
</form>