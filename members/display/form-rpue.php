<div class="rpue form">
    <?php echo cf_display_front_messages(); ?>
    <div class="col-md-12">
    <h3>Enter username or email</h3>
    </div>
    <form action="" method="POST" name="rpue">
       
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="user_login" value="" placeholder="Username" class="form-control" />            
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="email" name="user_email" value="" placeholder="Email" class="form-control" />
            </div>
        </div>

        <?php wp_nonce_field($form_action, $form_nonce_field); ?>
        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-default">Reset</button>
            </div>
        </div>
        
    </form>

</div>



