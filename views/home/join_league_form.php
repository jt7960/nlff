<?php
    $attributes = array('name'=>'join_league_form', 'enctype'=>'multipart/form-data');
    $hidden = array('league_id'=>$_POST['league_id']);
    echo form_open_multipart('home/join_league', $attributes, $hidden); 
?>
<div class='form-group'>
    <label for='team_name'>Team Name</label>
    <?php
        $data = array('id'=>'', 'class'=>'form-control', 'name'=>'team_name', 'value'=>set_value('team_name'));
        echo form_input($data);
    ?>
</div>
<div class='form-group'>
    <label for='draft_position'>Draft Position</label>
    <?php
    $attributes = array('class'=>'form-control text-center');
    echo form_dropdown('draft_position', $open_draft_positions, '', $attributes);
    ?>
</div>
<div class='form-group'>
    <label for='team_icon'>Team Icon</label>
    <?php
    $data = array('id'=>'input_team_icon', 'class'=>'form-control', 'type'=>'file', 'name'=>'team_icon', 'value'=>set_value('team_icon'));
    echo form_input($data);
    ?>
</div>
<div class='form-group'>
    <?php
    //$data = array('id'=>'submit_join_league', 'class'=>'btn-default', 'form'=>'join_league_form', 'type'=>'submit');
    //echo form_submit('submit_join_league', 'Submit', $data);
    ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

</div> <!-- end form-group-->
<?php
    echo form_close();
?>