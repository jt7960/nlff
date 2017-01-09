 <!-- Modal -->
<div class='modal' id='loginModal' role='dialog'>
    <div class='modal-dialog'>
        <!-- Modal Content -->
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span></h4>
                </div>
                <div class='warning text-center'>
                    <span id='login_modal_status'></span>
                </div>
                <div class='modal-body' style='padding:40px 50px;'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <h3>Login</h3>
                               <!--<form id='login_form' method='post'>-->
                                    <input type='hidden' name='page' id='page' value='<?php echo $_SERVER['REQUEST_URI'] ?>'>
                                    <div class='form-group' >
                                        <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
                                        <input type='text' class='form-control' name='username' id='login_username' placeholder='Enter Username'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
                                        <input type='password' class='form-control' name='password' id='login_password' placeholder='Enter Password'>
                                    </div>
                                    <div class='checkbox'>
                                        <!--<input type='hidden' id='remember_me_true' name='remember_me' value='FALSE'></input>-->
                                        <label><input id='remember_me' type='checkbox' 'name='remember_me' value='TRUE' checked>Remember me</label>
                                    </div>
                                    <button class='btn btn-default btn-success btn-block' id='login_submit' ><span class='glyphicon glyphicon-off'></span>Login</button>
                               <!-- </form>-->
                            </div>
                            <div class='col-md-6'  style='padding-left: 15px; border-left: 1px solid #ccc;'>
                                <h3>Register</h3>
                                <!--<form id='register_form' method='post' action='/home/register'>-->
                                <div class='form-group'>
                                        <label for='register_username'><span class='glyphicon glyphicon-user'></span> Username</label>
                                        <input type='text' class='form-control' name='register_username' id='register_username' placeholder='Select a Username'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='email'><span class='glyphicon glyphicon-envelope'></span> Email</label> 
                                        <input type='text' class='form-control' name='register_email' id='register_email' placeholder='Enter Your Email'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='verify_email'>Verify Email</label> 
                                        <input type='text' class='form-control' name='verify_email' id='verify_register_email' placeholder='Verify Your Email'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='register_password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
                                        <input type='password' class='form-control' name='password' id='register_password'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='verify_register_password'> Verify Password</label> 
                                        <input type='password' class='form-control' name='verify' id='verify_register_password'>
                                    </div>
                                    <button class='btn btn-default btn-success btn-block' id='register_submit' name='register_submit'><span class='glyphicon glyphicon-plus'></span>Register</button>
                                <!--</form>-->
                            </div>
                        </div>
                </div>
                <div class='modal-footer'>
                    <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal' ><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <p> <a href='#'>Forgot Password?</a></p>
                </div>
            </div>
    </div>
</div>


