<?php
    require_once("src/db/connection.php");
    echo "ok";
    print_r($_GET);
    print_r(getAnimal($connection, $_GET["q"]));
?>