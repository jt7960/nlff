<div>
    <h1>Create A League</h1>
    <?php
    //open form
    $attributes = array('id'=>'', 'class'=>'', 'name'=>'form_create_league');
    $hidden = array('user_id' => $user_id);
    echo form_open('nlff/create_league', $attributes, $hidden);
    //HIDDEN commissioner
    $data = array('id'=> '', 'class'=> '', 'name'=>'league_commissioner', 'value'=>$user_id);
    //league name
    $data = array('id'=> '', 'class'=> '', 'name'=>'league_name', 'value'=>'Enter League Name');
    echo form_input($data) . "<br>";
    //Password
    $data = array('id'=>'', 'class'=> '', 'name'=>'league_password');
    echo 'League Password: ' . form_password($data) . ' Note: Leave the password blank to make public league.';
    echo '<br>';
    $data = array('id'=>'', 'class'=> '', 'name'=>'verify_league_password');
    echo 'Verify Password: ' . form_password($data);
    echo '<br>';
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
    ?>
    </form>
</div>
    
    