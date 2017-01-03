<?php echo validation_errors(); ?>
<div id='register_modal'>
<div id='register_modal_content'>
<!--<span id='close_register_modal'>x</span><br>-->
<form id='register_form' method='post'>
Username: <input type='text' name='username' id='register_username' value="<?php echo set_value('username'); ?>"><br>
Email: <input type='text' name='email' id='register_email' value="<?php echo set_value('email'); ?>"><br>
Password: <input type='password' name='password' id='register_password'><br>
Verify Password: <input type='password' name='verify' id='verify_register_password'><br>
<button id='register_submit' name='register'>Register</button>
</form>
</div>
</div>