
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
                    <span id='user_status'>
                    <?php
                    if($this->ion_auth->logged_in()){
                        echo "<button type='button' class='btn btn-default btn-lg' id='logoutBtn'>Log Out</button>";
                    }
                    else{
                        echo "<button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login</button>";
                    }
                    ?>
                    </span>
            </ul>
        </div>
    </div>
</nav>
