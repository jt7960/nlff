<?php
    if($this->ion_auth->logged_in()){
        echo "<a href='nlff/create_league' type='button' class='btn btn-primary btn-block'> Create A New League</a>";
        echo "<button type='button' class='btn btn-primary btn-block'> Join A Public League</button>";
        echo "<button type='button' class='btn btn-primary btn-block'> Join A Private League</button>";
    }
    else{
        echo "<button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login To View Your Teams</button>";
    }
?>