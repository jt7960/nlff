<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url() ?>">Next Level Fantasy Football</a>
        </div>

        <div class="collapse navbar-collapse" id="NLFF-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?php echo base_url() ?>home">Home </a></li>
                <li><a href="#">Link </a></li>
            </ul>        
            <ul class="nav navbar-nav navbar-right">
                    <!--<div id='user_status'></div>-->
                    <?php
                        if($this->ion_auth->logged_in()){
                            echo "<li><a href='users/".$username."'>".$username."</a></li>";
                        }
                        else{
                            /*echo "<li><a href='fake_location' id='sign_in_link'><span class='glyphicon glyphicon-user'> Sign In</span></a></li> <li><a href='users/register'>Register</a></li>";*/
                            echo "<button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login</button>
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
                                                        <form role='form'>
                                                            <div class='form-group'>
                                                                <label for='username'><span class='glyphicon glyphicon-user'></span> Username</label>
                                                                <input type='text' class='form-control' id='username_field' placeholder='Enter Username'>
                                                            </div>
                                                            <div class='form-group'>
                                                                <label for='password'><span class='glyphicon glyphicon-eye-open'></span> Password</label>
                                                                <input type='text' class='form-control' id='password_field' placeholder='Enter Password'>
                                                            </div>
                                                            <div class='checkbox'>
                                                                <label><input type='checkbox' value='' checked>Remember me</label>
                                                            </div>
                                                            <button type='submit' class='btn btn-default btn-success btn-block><span class='glyphicon glyphicon-off'></span>Login</button>
                                                        </form>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='submit' class='btn btn-default btn-default pull-left' data-dismiss='modal'><span class='glyphicon glyphicon-remove'></span> Cancel</button>
                                                        <p>Not a member? <a href='Nlff/register_user'>Sign Up</a></p>
                                                        <p>Forgot <a href='#'>Password?</a></p>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>";
                        }
                    ?>
            </ul>
        </div>
    </div>
</nav>