<?php

if (isset($_GET["id"])){
    $idsolicitud=$_GET["id"];
  }

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "ingenieria";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "UPDATE solicitud SET estado_solicitud='denegada' WHERE idsolicitud=$idsolicitud";
  
  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    header("location: /!!!!Ingenieria/estudiante.php");

  
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
  $conn->close();
  

?>