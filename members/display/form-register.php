<div class="col-md-8 col-md-offset-2">
    <div class="register-form form">
        <?php echo cf_display_front_messages(); ?>
        <div class="col-md-12">
            <h3><?php echo $form_heading; ?></h3>
        </div>
        <form action="" method="post" name="<?php echo $form_name; ?>">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="email" name="user_email" value="<?php echo (isset($user_email)) ? $user_email : ""; ?>" placeholder="Email" class="form-control" />
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="clearfix"></div>
            
            <?php $style = ($display_password) ? "" : 'style="display:none"'; ?>

            <div <?php echo $style; ?> >
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="password" name="user_pass"  value="<?php echo (isset($user_pass)) ? $user_pass : ""; ?>" placeholder="Password" class="form-control" />            
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="password" name="confirm_password"  value="<?php echo (isset($confirm_password)) ? $confirm_password : ""; ?>" placeholder="Confirm Password" class="form-control" />
                    </div>
                </div>
            </div>

            <?php wp_nonce_field($form_action, $form_nonce_field); ?>

            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>