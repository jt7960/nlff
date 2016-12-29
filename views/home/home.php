
<div class='container' id='home-container'>
    <div class='row'>
        <div class='row-height'>
            <div class='col-md-8 col-height col-top'>
                <div class='inside'>
                    <div id='headline_carousel' class='carousel slide' data-ride='carousel'>
                        <!-- Indicators -->
                        <ol class='carousel-indicators'>
                            <li data-target='#headline_carousel' data-slide-to='0' class='active'></li>
                            <li data-target='#headline_carousel' data-slide-to='1'></li>
                            <li data-target='#headline_carousel' data-slide-to='2'></li>
                            <li data-target='#headline_carousel' data-slide-to='3'></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class='carousel-inner' role='listbox'>
                            <div class='item active'>
                                <img src='http://wallpapercave.com/wp/9USb2ah.jpg' alt=''>
                            </div>

                            <div class='item'>
                                <img src='https://aos.iacpublishinglabs.com/question/aq/1400px-788px/tall-nfl-field-goal-post_35c09e670f010208.jpg?domain=cx.aos.ask.com' alt=''>
                            </div>

                            <div class='item'>
                                <img src='http://www.dartreview.com/wp-content/uploads/2016/11/Locker-room-2-pic-pic.jpg' alt=''>
                            </div>

                            <div class='item'>
                                <img src='http://cdn2.bigcommerce.com/n-arxsrf/83zess/products/34/images/607/Epic_Helmet__64171.1395631198.1280.1280.jpg?c=2' alt=''>
                            </div>
                        </div>

                        <!-- Left and Right controls -->
                        <a class='left carousel-control' href='#headline_carousel' role='button' data-slide='prev'>
                            <span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>
                            <span class='sr-only'>Previous</span>
                        </a>
                        <a class='right carousel-control' href='#headline_carousel' role='button' data-slide='next'>
                            <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span>
                            <span class='sr-only'>Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class='col-md-4 col-height col-top'>
                <div class='inside'>
                <?php if($this->ion_auth->logged_in()): ?>
                    <div class='well' id='leagues-well'>
                        <a href='home/create_league' type='button' class='btn btn-primary btn-block'> Create A New League</a>
                        <a href='home/join_league' type='button' class='btn btn-primary btn-block'>Join A League</a>
                    </div>
                <?php else: ?>
                    <div class='well' id='leagues-well'>
                        <button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login To View Your Teams</button>
                    </div>
                    <?php endif; ?>
                </div>
                <div id="public_leagues_div">
                <h1>My Leagues</h1>
                <?php
                //print_r($leagues as $id => $name);

                foreach ($leagues as $league){
                    foreach($league as $id => $name){
                    echo "<a href='league/".$id."/home/'>".$name. "</a><br>";
                }}
                ?>
                </div><!--end ofpublic leagues div-->
            </div>
        </div>
    </div>
    <div class='container'>
    </div>


