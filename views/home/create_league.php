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
    ?>
    
    <div class='container'><div class='row'><div class="col-sm-2"></div></div></div>
    <div class='container'><div class='row'><div class="col-sm-8">
    
    <?php

    //open form
    $attributes = array('id'=>'', 'class'=>'create_league_form', 'name'=>'form_create_league');
    $user = $this->ion_auth->user()->row();
    $hidden = array('commissioner_id' => $user->id);
    echo form_open('home/create_league', $attributes, $hidden);
    //Public or Private
    echo '<fieldset class="form-group">';
    echo '<div class="form-check">';
    echo '<label class="form-check-label">';
    $data = array('name'=>'public', 'id'=>'public_league_radio_id', 'class'=>'form-check-input radio_public_private', 'value' => true, 'checked' => TRUE);
    echo form_radio($data) . 'Public League';
    echo '</label></div>';
    echo '<div class="form-check">';
    echo '<label class="form-check-label">';
    $data = array('name'=>'public', 'id'=>'private_league_radio_id', 'class'=>'form-check-input radio_public_private', 'value' => false);
    echo form_radio($data) . 'Private League - requires password' ;
    echo '</label></div>';
    echo '</fieldset>';
    echo "<div id='private_league_div'>";
    //league name
    echo '<div class="form-group">';
    $data = array('id'=> 'league_name_id', 'class'=> 'form-control', 'name'=>'league_name', 'value'=>set_value('league_name'));
    echo '<label for="league_name_id">League Name</label>';
    echo form_input($data);
    echo '</div>';
    //Password
    echo '<div class="form-group">';
    $data = array('id'=>'league_password_input', 'class'=> 'form-control', 'name'=>'league_password');
    echo '<label for="league_password_input">League Password:</label>' . form_password($data);
    echo '<br>';
    echo '</div>';
    //Verify Password
    echo '<div class="form-group">';
    $data = array('id'=>'league_password_verify_input', 'class'=> 'form-control', 'name'=>'verify_league_password');
    echo '<label for="league_password_verify_input">Verify Password:</label> ' . form_password($data);
    echo '<br>';
    echo "</div></div>";
    //Number of Teams
    echo '<div class="form-group">';
    $options = array('8'=>'8 teams', '10'=>'10 teams', '12'=>'12 teams', '14'=>'14 teams', '16'=>'16 teams');
    $selected = array('12');
    $extra = array('class'=>'custom-select', 'id'=>'num_teams_select');
    echo "<label for='num_teams_select'>Number of Teams: <label>" . form_dropdown('num_teams', $options, $selected, $extra);
    echo '<br>';
    echo '</div>';
    //Draft Date
    echo '<div class="form-group">';
    echo '<label for="draft_date">Draft Date</label>';
    echo "<input type='text' class='form-control' id='draft_date'>";
    echo "</input></div>";
    //Draft Time
    echo '<div class="form-group">';
    $options = array();
    $extra = array('id' => 'draft_time','class' => 'form-control');
    $selected = array();
    $extra = array('class'=>'custom-select', 'id'=>'draft_time');
    for($ampm=0; $ampm<2; $ampm++){
        for($h=1; $h<13; $h++){
            for($m=00; $m<60; $m+=15){
                if($ampm == 0){$ap = 'am';}
                if($ampm == 1){$ap = 'pm';}
                $options[] = $h . ":" . sprintf("%02d", $m) . " " . $ap;
                }
            }
        }
    echo "<label for='draft_time'>Draft Time: </label>" . form_dropdown('draft_time', $options, $selected, $extra);
    echo '<br>';
    echo '</div>';
 
    //buffs (please can we rename these?)
    echo '<div class="form-group">';
    echo 'Buffs: ';
    $data = array('id'=>'', 'class'=> '', 'name'=>'buffs', 'value'=>'1', 'checked'=>TRUE);
    echo 'On ' . form_radio($data);
    $data = array('id'=>'', 'class'=> '', 'name'=>'buffs', 'value'=>'0', 'checked'=>False);
    echo 'Off ' . form_radio($data);
    echo '<br>';
    echo '</div>';
    //Roster Upgrades
    echo '<div class="form-group">';
    echo 'Roster Upgrades: ';
    $data = array('id'=>'', 'class'=> '', 'name'=>'upgrades', 'value'=>'1', 'checked'=>TRUE);
    echo 'On ' . form_radio($data);
    $data = array('id'=>'', 'class'=> '', 'name'=>'upgrades', 'value'=>'0', 'checked'=>False);
    echo 'Off ' . form_radio($data);
    echo '<br>';
    echo '</div>';
    //Reserve Spot
    echo '<div class="form-group">';
    echo 'Reserve Roster Spot: ';
    $data = array('id'=>'', 'class'=> '', 'name'=>'reserves', 'value'=>'1', 'checked'=>TRUE);
    echo 'On ' . form_radio($data);
    $data = array('id'=>'', 'class'=> '', 'name'=>'reserves', 'value'=>'0', 'checked'=>False);
    echo 'Off ' . form_radio($data);
    echo '<br>';
    echo form_submit('mysubmit', 'Create');
    echo '</div>';  
    }
    ?>

</form>
</div></div></div>
<div class='container'><div class='row'><div class="col-sm-2"></div></div></div>

    
    