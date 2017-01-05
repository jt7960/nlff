<div class='container'>
    <div class='row'>
        <div class='col-sm-12 text-center'>
            <h1>Join League<br><?php echo 'Name Place Holder'; ?></h1>
        </div><!--end h1 column-->
    </div><!--end h1 row-->
    <div class='row'>
        <div class='col-sm-4 text-center'>
        </div><!--end left gutter column-->
        <div class='col-sm-4 text-center'>
            <?php echo form_open('league/join_league'); ?>
            <div class='form-group'>
                <label for='team_name'>Team Name </label>
                <?php
                    $data = array('id'=>'', 'class'=>'', 'name'=>'team_name', 'value'=>set_value('team_name'));
                    echo form_input($data);
                ?>
            </div>
            <div class='form-group'>
                <label for='draft_position'>Draft Position</labal>
                <?php
                $open_draft_positions = get_open_draft_positions($league_id); ///problem here! need to run this function from controller and pass teh data to the view...duh!
                echo form_select();
                ?>
            </div>
        </div> <!-- end form-group-->



        </div><!--end form column-->
        <div class='col-sm-4 text-center'>
        </div><!--end right gutter column-->
    </div><!--end row-->
</div><!--end container-->
