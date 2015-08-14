<div class="rpue form">
    <?php echo cf_display_front_messages(); ?>
    <div class="col-md-12">
    <h3>Enter username or email</h3>
    </div>
    <form action="" method="POST" name="rpue">
       
        <p><input type="text" name="user_login" value="" placeholder="Username" class="form-control" /></p>
        <p><input type="email" name="user_email" value="" placeholder="Email" class="form-control" /></p>

        <?php wp_nonce_field($form_action, $form_nonce_field); ?>
        <p><button type="submit" class="btn btn-default">Reset</button></p>
        
        
    </form>

</div>



