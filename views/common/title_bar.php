<?php
    if($this->ion_auth->logged_in()){
        $button_id = 'logOutBtn';
        $button_string = 'Log Out';
        $data_toggle = '';
        $data_target = '';
        $user = $this->ion_auth->user()->row();
        $username = $user->username;
        $welcome_string = 'Welcome '.$username;
    }
    else{
        $button_id = 'loginBtn';
        $button_string = 'Log In';
        $data_toggle = 'modal';
        $data_target = '#loginModal';
        $user = '';
        $username = 'Guest';
        $welcome_string = 'Welcome '.$username;
    }
?>

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
                    <span id='user_status'><?php echo $welcome_string;?>
                    <?php
                        echo "<button type='button' class='btn btn-default btn-lg' id='".$button_id."' data-toggle='".$data_toggle."' data-target='".$data_target."'>Login</button>";
                    ?>
                    </span>
            </ul>
        </div>
    </div>
</nav>
