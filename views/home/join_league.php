<div class='container'>
    <div class='row'>
        <div class='col-md-12 text-center'><h1>Join A League</h1></div>
    </div>
    <div class='row'>
        <div class='col-md-6 text-center'><h2>Public Leagues</h2>
        <div class='table-responsive'><table class='table' id='open_public_leagues'><tr><th>League ID</th><th>Teams</th><th>Draft Date/Time</th><th>Join</th></tr>
        <?php
            foreach($open_leagues as $open_league){
                $date = date(DATE_COOKIE, $open_league->draft_date);
                echo '<tr><td>'.$open_league->league_id.'</td><td>'.$open_league->cur_teams.'/'.$open_league->num_teams.'</td><td>'.$date.'</td><td><a href="">Join Link</a></td></tr>';
            }
            //print_r($open_leagues);
        ?>
        </table></div>

        </table>
        </div>
        <div class='col-md-6 text-center'><h2>Private League</h2></div>
    </div>
    <div class='row'>
        <div class='col-md-6'></div>
        <div class='col-md-6 text-center'>
            <form>
            League ID:<input type='text'></input><br/>
            Password:<input type='password'></input><br/>
            <button type='submit'>Submit</button>
            </form>
        </div>
    </div>
</div>