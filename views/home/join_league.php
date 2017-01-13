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
                                <td><a league_id="'.$open_league->league_id.'" password="" class="load_join_league_form_link" href="/home/load_join_league_form">Join League</a></td>
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
                    $data = array('id'=>'password_input', 'class'=>'form-control', 'name'=>'password_input');
                    echo '<label for="password_input">League Password</label>';
                    echo form_password($data);
                    echo '</div>';
                    
                    //SUBMIT
                    $data = array('id'=>'load_join_league_form_submit', 'class'=>'');
                    echo form_submit('mysubmit', 'Join', $data);
                ?>
                    </form>
                </div>
                <div id='join_league_form'>
                    <!--Ajax in the form-->
                </div>
            </div>
        </div>
        <div class='.col-md-4 text-center'>
        </div>