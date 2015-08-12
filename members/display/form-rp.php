
<div class="register-form form">
    <?php echo cf_display_front_messages(); ?>
   
    <div class="col-md-12">
    <h3>Reset your password</h3>
    </div>
    <form action="" method="POST" name="password_reset">
        
        <div class="col-md-6">
            <div class="form-group">
                <input type="password" name="user_pass"  placeholder="Password" class="form-control" />            
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="password" name="confirm_password"  placeholder="Confirm Password" class="form-control" />
            </div>
        </div>

        <?php wp_nonce_field($form_action, $form_nonce_field); ?>
        <div class="form-group">
            <div class="col-md-6">
                <input type="hidden" name="<?php echo $this->url_param_alias_user_identifier; ?>" value="<?php echo $user_id; ?>">
                <button type="submit" class="btn btn-default">Reset</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 strength">
                
            </div>
        </div>
    </form>

</div>