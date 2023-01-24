<?php

if (isset($_GET["id"])){

    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ingenieria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "DELETE FROM asignaturas WHERE idasig=$id";
    $conn->query($sql);

    
}



header("location: /!!!!Ingenieria/vicedecano.php");
exit;


?>