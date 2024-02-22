<?php
    require_once 'vendor/autoload.php';


    $desired_view = isset($_GET["view"]) ? $_GET["view"] : default_view ;

    if($desired_view =="display"){
        display_all_submits();
        echo "<br/> To add a new submit <a href='index.php?view=add'>click here</a>";
    }
?>