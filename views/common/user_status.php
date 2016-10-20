<?php
    if($this->ion_auth->logged_in()){
        echo "<button type='button' class='btn btn-default btn-lg' id='logoutBtn'>Log Out</button>";
    }
    else{
        /*echo "<li><a href='fake_location' id='sign_in_link'><span class='glyphicon glyphicon-user'> Sign In</span></a></li> <li><a href='users/register'>Register</a></li>";*/
        echo "<button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login</button>";
    }
?>