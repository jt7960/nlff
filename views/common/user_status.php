<?php
    if($this->ion_auth->logged_in()){
        echo "<button type='button' class='btn btn-default btn-lg' id='logoutBtn'>Log Out</button>";
    }
    else{
        echo "<button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login</button>";
    }
?>