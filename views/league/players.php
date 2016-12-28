<div class="container">
    <div class="row">
        <div id="PlayerStatusDropdown" class="col-sm-8 dropdown">
            <label>Status: </label>
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">All Available Players<span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <!-- placeholder, will need to add code to add options to the drop down list
                    <li><a href="#">HTML</a></li>
                    <li><a href="#">CSS</a></li>
                    <li><a href="#">JavaScript</a></li>
                    -->
                </ul>
        </div>

        <form>
            <div id="PlayerSearch" class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div id="PositionSort" class="col-sm-6">
            <label>Position: </label>
            <a href="#">All</a>
            <a href="#">QB</a>
            <a href="#">RB</a>
            <a href="#">WR</a>
            <a href="#">TE</a>
            <a href="#">FLEX</a>
            <a href="#">K</a>
            <a href="#">DEF</a>
        </div>
    </div>

    <div class="row">
        <div id="WeekSelector" class="col-sm-9">
            <label>Weeks: </label>
            <!-- placeholder, will need to modify controller and model to get the number of weeks for each league
                </*?php 
                foreach ($week in $weeks){
                    echo '<a href="',$week,'">',$week,' </a>';
                }
            ?>
            -->
        </div>

        <div id="PaginationTop" class="col-sm-3 pull-right">
            <ul class="pager">
                <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
            </ul>
    </div>

    <div class="row">
        <div id="PlayerTable" class="col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Add/Follow</th>
                        <th>Player Name</th>
                        <th>Opponent</th>
                        <th>Owner</th>
                        <th>Passing</th>
                        <th>Rushing</th>
                        <th>Receiving</th>
                        <th>Misc</th>
                        <th>Fumble</th>
                        <th>Fantasy Points</th>
                    </tr>
                <thead>
                <tbody>
                    <!-- placeholder, will need code to populate the table with players based on the player status dropdown -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div id="PaginationBottom" class="col-sm-3 pull-right">
            <ul class="pager">
                <li><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
            </ul>
        </div>
    </div>




















</div>