<h2>User Login</h2>
<form action="" method="post" >
    <?php cf_display_front_messages(); ?>
    <p>Username: <input type="text" name="user_login" value=""></p>
    <p>Password: <input type="password" name="user_pass" value=""></p>
    <?php wp_nonce_field($form_action, $form_nonce_field); ?>
    
    <input type="submit" value="Login">
    <p><a href="<?php echo $this->forgot_password_form_url; ?>">Lost your password?</a></p>
</form>
