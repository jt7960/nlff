<div class='container'>
    <div class='row'>
        <div class='.col-md-4 text-center'>
        </div>
        <div class='.col-md-4 text-center'>
        <h1>Join A League</h1>
        <h6 id='warning'><?php echo $error; ?></h6>
        <h6 id='validation_errors'><?php echo validation_errors(); ?></h6>
        <fieldset>
            <legend>League Type</legend>
            <div class='form-group'>
                <label for='public'>Public</label><input type="radio" name="league_type" id="public" value="Public" checked>
                <br>
                <label for='private'>Private</label><input type="radio" name="league_type" id="private" value="Private">
            </div>
        </fieldset>
        <div class='panel'>
            <div class='panel-heading'>
                <h1 id='join_league_form_title' class='panel-title'></h1>
            </div>
            <div id='join_league_form_panel' class='panel-body'>
                <div id='public_panel_body'>
                <div class='table-responsive'>
                    <table class='table' id='open_public_leagues'><tr><th>League ID</th><th>Teams</th><th>Draft Date/Time</th><th>Join</th></tr>
                        <?php
                            foreach($open_leagues as $open_league){
                                $date = date(DATE_COOKIE, $open_league->draft_date);
                                echo '<tr>
                                <td>'.$open_league->league_id.'</td>
                                <td>'.$open_league->cur_teams.'/'.$open_league->num_teams.'</td>
                                <td>'.$date.'</td>
                                <td><a href="/home/join_public_league/'.$open_league->league_id.'">Join Link</a></td>
                                </tr>';
                            }
                        //print_r($open_leagues);
                        ?>
                    </table>
                </div>
            </div>
                <div id='private_panel_body'>
                <?php
            //open form
                    $attributes = array('id'=>'', 'class'=>'', 'name'=>'');
                    echo form_open('/home/join_league', $attributes);

                    //league ID
                    echo '<div class="form-group">';
                    $data = array('id'=>'league_id_input', 'class'=>'form-control', 'name'=>'league_id', 'value'=>set_value('league_id'));
                    echo '<label for="league_id_input">League ID</label>';
                    echo form_input($data);
                    echo '</div>';

                    //Password
                    echo '<div class="form-group">';
                    $data = array('id'=>'league_password_input', 'class'=>'form-control', 'name'=>'league_password');
                    echo '<label for="league_password_input">League Password</label>';
                    echo form_password($data);
                    echo '</div>';
                    
                    //SUBMIT
                    
                    echo form_submit('mysubmit', 'Join');
                ?>
                    </form>
                </div>
                <div id='join_league_form'>
                                <?php
                $attributes = array('name'=>'join_league_form', 'enctype'=>'multipart/form-data');
                echo form_open_multipart('home/join_public_league/'.$league_data->league_id, $attributes); 
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
                <button type="submit"  class="btn btn-primary">Submit</button>
            </div>
            
        </div> <!-- end form-group-->
        <?php
            echo form_close();
        ?>
                </div>
            </div>
        </div>
        <div class='.col-md-4 text-center'>
        </div>