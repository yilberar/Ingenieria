<?php

if (isset($_GET["id"])){

    $id = $_GET["id"];
    echo $id;

  
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ingenieria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    $sql = "DELETE FROM usuarios WHERE iduser=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("location: /!!!!Ingenieria/vicedecano.php");
      exit;
      } else {
        echo "Error deleting record: " . $conn->error;
        header("location: /!!!!Ingenieria/vicedecano.php?eliminar=1");
      exit;
      }
      
      $conn->close();

    
}






?>