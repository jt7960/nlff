<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Next Level Fantasy Football</a>
        </div>

        <div class="collapse navbar-collapse" id="NLFF-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home </a></li>
                <li><a href="#">Link </a></li>
            </ul>        
            <ul class="nav navbar-nav navbar-right">
                    <!--<div id='user_status'></div>-->
                    <?php
                        if($this->ion_auth->logged_in()){
                            echo "<li><a href='users/".$username."'>".$username."</a></li>";
                        }
                        else{
                            echo "<li><span class='glyphicon glyphicon-user'><a href='fake_location' id='sign_in_link'> Sign In</a></span> / <a href='users/register'>Register</a></li>";
                        }
                    ?>
            </ul>
        </div>
    </div>
</nav>