<?php

if (isset($_GET["id"])){

    $iduser = $_GET["id"];
    echo "usuario ";
    echo $iduser;
    echo "<br> ";
}
if (isset($_GET["id1"])){

    $idasig = $_GET["id1"];
    echo "asignatura ";
    echo $idasig;
    echo "<br> ";
}
if (isset($_GET["id2"])){

    $idsolicitud = $_GET["id2"];
    echo "solicitud ";
    echo $idsolicitud;
    echo "<br>";
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




    $sql = "INSERT INTO estud_asig (iduser, idasig)
            VALUES ('$iduser','$idasig')";
     if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;   
      }
      
      $sql2 = "UPDATE solicitud SET estado_solicitud='aceptada' WHERE idsolicitud='$idsolicitud'";

      echo $sql2;
      echo "<br>";
        if ($conn->query($sql2) === TRUE) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

        
$conn->close();
     
     header("location: /!!!!Ingenieria/estudiante.php");

?>