<html>
        <head>
                <title>Next Level Fantasy Football</title>
                <?php
                foreach($javascript as $js){
                        echo "<script type = 'text/javascript' src = '" . base_url() . "application/javascript/" . $js ."'></script>";
                        }
                foreach($css as $style){
                        echo "<link rel = 'stylesheet' type = 'text/css' href = '" . base_url() . "application/css/" . $style ."'>";
                        }
                ?>
        </head>
        <body>