<html>
        <head>
                <title>Next Level Fantasy Football</title>
                <?php
                foreach($css as $style){
                        echo "<link rel = 'stylesheet' type = 'text/css' href = '" . base_url() . "css/" . $style ."'>";
                        }
                foreach($javascript as $js){
                        echo "<script type = 'text/javascript' src = '" . base_url() . "javascript/" . $js ."'></script>";
                        }
                ?>
        </head>
        <body>