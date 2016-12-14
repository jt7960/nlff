<div>
    <h1>Create A League</h1>
    <?php
    //echo validation_errors();
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
    $attributes = array('id'=>'', 'class'=>'create_league_form', 'name'=>'form_create_league');
    $user = $this->ion_auth->user()->row();
    $hidden = array('commissioner_id' => $user->id);
    echo form_open('home/create_league', $attributes, $hidden);
    //HIDDEN commissioner_id
    //$data = array('id'=> '', 'class'=> '', 'name'=>'league_commissioner', 'value'=>/*$user_id*/$user->id);
    //league name
    $data = array('id'=> '', 'class'=> '', 'name'=>'league_name', 'value'=>set_value('league_name'));
    echo 'League Name: ' . form_input($data) . "<br>";

    //Public or Private
    $data = array('name'=>'public', 'id'=>'', 'class'=>'radio_public_private', 'value' => true, 'checked' => TRUE);
    echo 'Public League ' . form_radio($data)  ;
    echo '<br>';
    $data = array('name'=>'public', 'id'=>'', 'class'=>'radio_public_private', 'value' => false);
    echo 'Private League ' . form_radio($data) ;
    echo '<br>';
    //Password
    echo "<div id='pw_div'>";
    $data = array('id'=>'', 'class'=> '', 'name'=>'league_password');
    echo 'League Password: ' . form_password($data) . ' Note: Password not required for a public league';
    echo '<br>';
    //Verify Password
    $data = array('id'=>'', 'class'=> '', 'name'=>'verify_league_password');
    echo 'Verify Password: ' . form_password($data);
    echo '<br>';
    echo "</div>";
    //Number of Teams
    $options = array('8'=>'8 teams', '10'=>'10 teams', '12'=>'12 teams', '14'=>'14 teams', '16'=>'16 teams');
    $selected = array(set_value('num_teams'), '12');
    echo "Number of Teams: " . form_dropdown('num_teams', $options, set_value('num_teams'));
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
    
    