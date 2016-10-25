
<div class='container'>
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
                                <img src='http://cdn.na16.netdna-cdn.com/wp-content/uploads/2014/09/eli-manning-bald.png' alt=''>
                            </div>

                            <div class='item'>
                                <img src='http://media.gettyimages.com/photos/aaron-rodgers-of-the-green-bay-packers-poses-for-his-2008-nfl-at-picture-id81972904' alt=''>
                            </div>

                            <div class='item'>
                                <img src='http://prod.static.vikings.clubs.nfl.com/assets/images/imported/MIN/photos/clubimages/2016/06-June/tempsendejo-andrew-2011-headshot--nfl_mezz_1280_1024.jpg' alt=''>
                            </div>

                            <div class='item'>
                                <img src='http://prod.static.eagles.clubs.nfl.com/assets/images/imported/PHI/photos/clubimages/2014/04-April/temppg_headshot_outtakes_042314--nfl_mezz_1280_1024.jpg' alt=''>
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
                    <div class='well' id='leagues-well'>
                        <?php
                            if($this->ion_auth->logged_in()){
                                echo "<a href='nlff/create_league' type='button' class='btn btn-primary btn-block'> Create A New League</a>";
                                echo "<button type='button' class='btn btn-primary btn-block'> Join A Public League</button>";
                                echo "<button type='button' class='btn btn-primary btn-block'> Join A Private League</button>";
                            }
                            else{
                                echo "<button type='button' class='btn btn-default btn-lg' id='loginBtn' data-toggle='modal' data-target='#loginModal'>Login To View Your Teams</button>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='container'>

    </div>


