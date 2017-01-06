<div>
    
    <?php
    print_r(validation_errors());
    
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
    
    <div class='container-fluid'>
    <div class='row'>
    <div class="col-sm-4 text-center"></div>
    <div class="col-sm-4 text-center">
    <h1>Create A League</h1>
    <?php

    //open form
    $attributes = array('id'=>'', 'class'=>'create_league_form', 'name'=>'form_create_league');
    $user = $this->ion_auth->user()->row();
    $hidden = array('creator_id' => $user->id);
    echo form_open('league/create_league', $attributes, $hidden);
    //RADIO Public or Private
    echo '<fieldset class="form-group">';
    echo '<div class="form-check">';
    echo '<label class="form-check-label">';
    $data = array('name'=>'public', 'id'=>'public_league_radio_id', 'class'=>'form-check-input radio_public_private', 'value' => '1', 'checked' => TRUE);
    echo form_radio($data) . 'Public League';
    echo '</label></div>';
    echo '<div class="form-check">';
    echo '<label class="form-check-label">';
    $data = array('name'=>'public', 'id'=>'private_league_radio_id', 'class'=>'form-check-input radio_public_private', 'value' => '0');
    echo form_radio($data) . 'Private League - <span class="text-muted">requires password</span>';
    echo '</label></div>';
    echo '</fieldset>';
    echo "<div id='private_league_div'>";
    // INPUT league name
    echo '<div class="form-group">';
    $data = array('id'=> 'league_name_id', 'class'=> 'form-control', 'name'=>'league_name', 'value'=>set_value('league_name'));
    echo '<label for="league_name_id">League Name</label>';
    echo form_input($data);
    echo '</div>';
    //INPUT/PASSWORD Password
    echo '<div class="form-group">';
    $data = array('id'=>'league_password_input', 'class'=> 'form-control', 'name'=>'league_password');
    echo '<label for="league_password_input">League Password:</label>' . form_password($data);
    echo '<br>';
    echo '</div>';
    //INPUT/PASSWORD Verify Password
    echo '<div class="form-group">';
    $data = array('id'=>'league_password_verify_input', 'class'=> 'form-control', 'name'=>'verify_league_password');
    echo '<label for="league_password_verify_input">Verify Password:</label> ' . form_password($data);
    echo '<br>';
    echo "</div></div>";
    //SELECT Number of Teams
    echo '<div class="form-group">';
    $options = array('8'=>'8 teams', '10'=>'10 teams', '12'=>'12 teams', '14'=>'14 teams', '16'=>'16 teams');
    $extra = array('class'=>'form-control', 'id'=>'num_teams_select');
    echo "<label for='num_teams_select'>Number of Teams: </label>" . form_dropdown('num_teams', $options, '12', $extra);
    echo '<br>';
    echo '</div>';
    //INPUT Draft Date
    echo '<div class="form-group ">';
    $data = array('class'=>'form-control', 'id'=>'draft_date', 'name'=>'draft_date', 'value'=>set_value('draft_date'));
    echo '<label for="draft_date">Draft Date</label>';
    echo form_input($data);
    echo '<br>';
    echo "</div>";
    //SELECT Draft Time
    echo '<div class="form-group">';
    $options = array();
    $extra = array('id' => 'draft_time','class' => 'form-control');
    $selected = '5:00 pm';
    $extra = array('class'=>'form-control', 'id'=>'draft_time');
    $hours = array('12','1','2','3','4','5','6','7','8','9','10','11');
    $minutes = array('00','15','30','45');
    $ampm = array('am','pm');
    foreach($ampm as $ap){
        foreach($hours as $hour){
            foreach($minutes as $minute){
                $options[$hour .':'. sprintf("%02d", $minute) .' '. $ap] = $hour .':'. sprintf("%02d", $minute) .' '. $ap;
            }
        }
    }
    echo "<label for='draft_time'>Draft Time: </label>" . form_dropdown('draft_time', $options, $selected, $extra) . 'GMT';
    echo '<br>';
    echo '</div>';
 
    // RADIO buffs (please can we rename these?)
    echo '<fieldset class="form-group">';
    echo '<div class="form-check">';
    echo '<label class="form-check-label">';
    $data = array('id'=>'', 'class'=> '', 'name'=>'buffs', 'value'=>'1', 'checked'=>TRUE);
    echo form_radio($data) . 'Buffs On';
    echo '</label></div>';
    echo '<div class="form-check">';
    echo '<label class="form-check-label">';
    $data = array('id'=>'', 'class'=> '', 'name'=>'buffs', 'value'=>'0', 'checked'=>False);
    echo form_radio($data) . 'Buffs Off';
    echo '</label></div>';
    echo '</fieldset>';
    // RADIO Roster Upgrades
    echo '<fieldset class="form-group"><div class="form-check"><label class="form-check-label">';
    $data = array('id'=>'', 'class'=> '', 'name'=>'upgrades', 'value'=>'1', 'checked'=>TRUE);
    echo form_radio($data) . 'Roster Upgrades On';
    echo '</label></div><div class="form-check"><label class="form-check-label">';
    $data = array('id'=>'', 'class'=> '', 'name'=>'upgrades', 'value'=>'0', 'checked'=>False);
    echo form_radio($data) . 'Roster Upgrades Off';
    echo '</label></div></fieldset>';
    //RADIO Reserve Spot
    echo '<fieldset class="form-group"><div class="form-check"><label class="form-check-label">';
    $data = array('id'=>'', 'class'=> '', 'name'=>'reserves', 'value'=>'1', 'checked'=>TRUE);
    echo form_radio($data) . 'Reserve Spot Enabled';
    echo '</label></div>';
    echo '<div class="form-check"><label class="form-check-label">';
    $data = array('id'=>'', 'class'=> '', 'name'=>'reserves', 'value'=>'0', 'checked'=>False);
    echo form_radio($data) . 'Reserve Spot Disabled';
    echo '</label></div></fieldset>';
    //SUBMIT
    echo form_submit('mysubmit', 'Create');
    echo '</div>';  
    }
    ?>
    </form></div>
    <div class="col-sm-4 text-center"></div></div>
    </div></div>


    
    