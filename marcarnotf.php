<?php
$servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "ingenieria";

    $conn = new mysqli($servername, $username, $password, $dbname);

   
if (isset($_GET["id"])){

    $id = $_GET["id"];
    echo $id;
    $id1 = $_GET["id1"];
    echo $id1;
    $id2 = $_GET["id2"];
    echo $id2;
    //  $sql = "DELETE FROM usuarios WHERE iduser=$id";
    // $conn->query($sql);

    $ultnotf = array($id, $id1, $id2);

       echo $ultnotf[2];

    for ($i=0; $i < 3; $i++) { 
            
      $sql = "UPDATE notificaciones SET estado = 1 WHERE idnotif = '$ultnotf[$i]'";

      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
      
              
     }

    
}


       

header("location: /!!!!Ingenieria/estudiante.php?verf=1");
exit;


?>