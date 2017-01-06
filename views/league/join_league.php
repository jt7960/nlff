<div class='container'>
    <div class='row'>
        <div class='col-sm-12 text-center'>
            <h1>Join League</h1><h6>League ID: <?php echo $league_data->league_id; ?></h6>
        </div><!--end h1 column-->
    </div><!--end h1 row-->
    <div class='row'>
        <div class='col-sm-4 text-center'>
        </div><!--end left gutter column-->
        <div class='col-sm-4 text-center'>
            <?php
                $attributes = array('enctype'=>'multipart/form-data');
                echo form_open_multipart('league/join_league', $attributes); 
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
                    $data = array('id'=>'submit_join_league', 'class'=>'btn-default', 'value'=>true);
                    echo form_button('submit_join_league', 'Submit', $data);
                ?>
            </div>
        </div> <!-- end form-group-->



        </div><!--end form column-->
        <div class='col-sm-4 text-center'>
        </div><!--end right gutter column-->
    </div><!--end row-->
</div><!--end container-->
