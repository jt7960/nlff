<div class='container'>
    <div class='row'>
        <div class='col-sm-12 text-center'>
            <h1>Join A League</h1>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-6 text-center'>
            <h2>
                Public Leagues
            </h2>
            <div class='table-responsive'>
                <table class='table' id='open_public_leagues'><tr><th>League ID</th><th>Teams</th><th>Draft Date/Time</th><th>Join</th></tr>
        <?php
            foreach($open_leagues as $open_league){
                $date = date(DATE_COOKIE, $open_league->draft_date);
                echo '<tr>
                <td>'.$open_league->league_id.'</td>
                <td>'.$open_league->cur_teams.'/'.$open_league->num_teams.'</td>
                <td>'.$date.'</td>
                <td><a href="/home/join_league/'.$open_league->league_id.'">Join Link</a></td>
                </tr>';
            }
            //print_r($open_leagues);
        ?>
                </table>
            </div>
        </div>

    <div class='col-sm-6 text-center'>
        <h2>
            Private Leagues
        </h2>
        <?php
            //open form
            $attributes = array('id'=>'', 'class'=>'', 'name'=>'');
            echo form_open('home/join_league', $attributes);

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
            echo form_submit('join_public_league_submit', 'Join');
        ?>
            </form>
        </div>

