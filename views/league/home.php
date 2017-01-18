<div class='container'>
    <div class='row'>
        <div class='col-md-12 text-center'>
            <h1>
                <?php if($league_data->league_name != ''){echo $league_data->league_name; } else {echo "League: ". $league_data->league_id;} ?>
            </h1>
            <h2>
                <?php echo $team_data->team_name; ?>
            </h2>
            <h6>
                <?php echo $league_data->announcement; ?>
            </h6>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-2'>
            <div class="list-group" id='links'>
                <!--should be some logic to include administrator links-->
                <!--this might be ajaxed in, might need a 'league navigation' file that gets pulled in, instead of repeating the same code-->
                <?php echo "<a href='/league/home/".$league_data->league_id."' class='list-group-item' type='user'>Home</a>"; ?>
                <?php echo "<a href='/league/team/".$league_data->league_id."/".$team_data->team_id."' class='list-group-item' type='user'>My Team</a>"; ?>
                <?php echo "<a href='/league/players' class='list-group-item' type='user'>Players</a>"; ?>
                <?php echo "<a href='/league/settings/".$league_data->league_id."' class='list-group-item' type='admin'>League Settings</a>"; ?>
            </div>
        </div>
        <div class='col-md-8 text-center'>
            <div id='league_standings'>
                <h3>
                    League Standings
                </h3>
                <?php echo '';?>
            </div>
            <div id='chat_input'>
                <!--chat input form-->
            </div>
            <div id='league_chat'>
                <?php echo '';?> <!--logic to display chat-->
            </div>
        </div>
        <div class='col-md-2 text-center'>
        </div>
    </div>
</div>