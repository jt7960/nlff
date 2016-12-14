<div>
    <h1>Login</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('home/login'); ?>
     <label for="user_email">Email:</label>
     <input type="text" size="20" id="user_email" name="user_email"/>
     <br/>
     <label for="user_password">Password:</label>
     <input type="password" size="20" id="user_password" name="user_password"/>
     <br/>
     <input type="hidden" name="remember_me" value="false">
     <label><input type="checkbox" id='' class='' name='remember_me' value='true'>Remember Me</label><br>
     <input type="submit" value="Login"/>
   </form>
   </div>