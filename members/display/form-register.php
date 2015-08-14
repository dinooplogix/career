<div class="col-md-8 col-md-offset-2">
    <div class="register-form form">
        <?php echo cf_display_front_messages(); ?>
        <div class="col-md-12">
            <h3><?php echo $form_heading; ?></h3>
            <?php $disable_login_button = (isset($disable_login_button) && $disable_login_button)? 'style="display:none"' : ''; ?>
            <div <?php echo $disable_login_button; ?>><p>Already have an account - <a href="<?php echo $this->login_form_url ?>">login</a></p></div>
        </div>
        <form action="" method="post" name="<?php echo $form_name; ?>">
            <p>
                <?php $disabled = ($disable_username) ? '' : ''; ?>
                <input type="email" name="user_email" value="<?php echo (isset($user_email)) ? $user_email : ""; ?>" placeholder="Email" <?php echo $disabled; ?> class="form-control" />
            </p>

            <!-- PASSWORD -->
            <div class="clearfix"></div>

            <?php $style = ($display_password) ? "" : 'style="display:none"'; ?>

            <div <?php echo $style; ?> >
                <p><input type="password" name="user_pass"  value="<?php echo (isset($user_pass)) ? $user_pass : ""; ?>" placeholder="Password" class="form-control" /></p>
                <p><input type="password" name="confirm_password"  value="<?php echo (isset($confirm_password)) ? $confirm_password : ""; ?>" placeholder="Confirm Password" class="form-control" /></p>
            </div>

            <?php wp_nonce_field($form_action, $form_nonce_field); ?>
            <p><button type="submit" class="btn btn-default">Submit</button></p>
            
        </form>
    </div>
</div>