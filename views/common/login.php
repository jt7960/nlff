 <!-- Modal -->
<div class='modal fade' id='loginModal' role='dialog'>
    <div class='modal-dialog'>
        <!-- Modal Content -->
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    <h4 style='color:red;'><span class='glyphicon glyphicon-lock'></span></h4>
                </div>
                <div class='modal-body' style='padding:40px 50px;'>
                    <form role='form' method='post'>
                        <div class='form-group'>
                            <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
                            <input type='text' class='form-control' name='username' id='username_field' placeholder='Enter Username'>
                        </div>
                        <div class='form-group'>
                            <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
                            <input type='password' class='form-control' name='password' id='password_field' placeholder='Enter Password'>
                        </div>
                        <div class='checkbox'>
                            <label><input id='remember_me' type='checkbox' name='remember_me' value='' checked>Remember me</label>
                        </div>
                        <button type='submit' class='btn btn-default btn-success btn-block' data-dismiss='modal' id='login_submit' ><span class='glyphicon glyphicon-off'></span>Login</button>
                    </form>
                </div>

                <div class='modal-footer'>
                    <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal' ><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                    <p>Not a member? <a href='users/register'>Sign Up</a></p>
                    <p>Forgot <a href='#'>Password?</a></p>
                </div>
            </div>
    </div>
</div>


