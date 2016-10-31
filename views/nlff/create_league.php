<div>
    <h1>Create A League</h1>
    <?php
    echo validation_errors();
    if (!$this->ion_auth->logged_in())
    {
        echo "<div class='alert alert-warning'>";
        echo "<a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        echo "<strong>Warning!</strong> You must be logged in to create a new league.";
        echo "</div>";        
    }
    else
    {
    //open form
    $attributes = array('id'=>'', 'class'=>'', 'name'=>'form_create_league');
    $user = $this->ion_auth->user()->row();
    $hidden = array('commissioner_id' => $user->id);
    echo form_open('nlff/create_league', $attributes, $hidden);
    //HIDDEN commissioner_id
    //$data = array('id'=> '', 'class'=> '', 'name'=>'league_commissioner', 'value'=>/*$user_id*/$user->id);
    //league name
    $data = array('id'=> '', 'class'=> '', 'name'=>'league_name', 'value'=>'');
    echo 'League Name: ' . form_input($data) . "<br>";
    //Password
    $data = array('id'=>'', 'class'=> '', 'name'=>'league_password');
    echo 'League Password: ' . form_password($data) . ' Note: Leave the password blank to make public league.';
    echo '<br>';
    //Verify Password
    $data = array('id'=>'', 'class'=> '', 'name'=>'verify_league_password');
    echo 'Verify Password: ' . form_password($data);
    echo '<br>';
    //Public or Private
    $data = array('name'=>'public', 'id'=>'public', 'value' => false);
    echo 'Private League ' . form_radio($data) ;
    $data = array('name'=>'public', 'id'=>'public', 'value' => true);
    echo 'Public League ' . form_radio($data)  ;
    echo ' <i> -- Private leagues require a password to join, public leagues are available for anyone to join.</i><br>';
    //Number of Teams
    $data = array('8'=>'8 teams', '10'=>'10 teams', '12'=>'12 teams', '14'=>'14 teams', '16'=>'16 teams');
    echo "Number of Teams: " . form_dropdown('num_teams', $data, '12');
    echo '<br>';
    //buffs (please can we rename these?)
    echo 'Buffs: ';
    $data = array('id'=>'', 'class'=> '', 'name'=>'buffs', 'value'=>'1', 'checked'=>TRUE);
    echo 'On ' . form_radio($data);
    $data = array('id'=>'', 'class'=> '', 'name'=>'buffs', 'value'=>'0', 'checked'=>False);
    echo 'Off ' . form_radio($data);
    echo '<br>';
    //Roster Upgrades
    echo 'Roster Upgrades: ';
    $data = array('id'=>'', 'class'=> '', 'name'=>'upgrades', 'value'=>'1', 'checked'=>TRUE);
    echo 'On ' . form_radio($data);
    $data = array('id'=>'', 'class'=> '', 'name'=>'upgrades', 'value'=>'0', 'checked'=>False);
    echo 'Off ' . form_radio($data);
    echo '<br>';
    //Reserve Spot
    echo 'Reserve Roster Spot: ';
    $data = array('id'=>'', 'class'=> '', 'name'=>'reserves', 'value'=>'1', 'checked'=>TRUE);
    echo 'On ' . form_radio($data);
    $data = array('id'=>'', 'class'=> '', 'name'=>'reserves', 'value'=>'0', 'checked'=>False);
    echo 'Off ' . form_radio($data);
    echo '<br>';
    echo form_submit('mysubmit', 'Create');    
    }
    ?>
    </form>
</div>
    
    