
<?php

session_start();

if (isset($_GET["id"])){
  $_SESSION['asignaturamodf']=$_GET["id"];
}
        // echo $idasignatura;

        ?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../css/Estilos.css">
<title>Modificar asignatura </title>

<style>
  

body{
        
        background-image:url(../images/Doc5uci.jpg);
        background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
}
.error {color: #FF0000;}
</style>
</head>



<body>  


<center>
<div>



<?php
// define variables and set to empty values
$asignaturaErr = $capacidadErr = $disponibilidadErr = $lastnameErr = $id_rolErr = "";
$asignatura = $capacidad = $disponibilidad = $lastname = $id_rol = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["asignatura"])) {
    $asignaturaErr = "Inserte asignatura";
  } else {
    $asignatura = test_input($_POST["asignatura"]);
  }
  
  if (empty($_POST["capacidad"])) {
    $capacidadErr = "inserte capacidad";
  } else {
    $capacidad = test_input($_POST["capacidad"]);
  }
    
  if (empty($_POST["disponibilidad"])) {
    $disponibilidadErr = "inserte disponibilidad";
  } else {
    $disponibilidad = test_input($_POST["disponibilidad"]);
  }

  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="registrar">
<p><span class="error"></span></p>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nombre de la Asignatura: <input type="text" name="asignatura">
  <span class="error">* <?php echo $asignaturaErr;?></span>
  <br><br>
  Capacidad: <input type="text" name="capacidad">
  <span class="error">* <?php echo $capacidadErr;?></span>
  <br><br>
  Disponibilidad: <select id="disponibilidad" name="disponibilidad">
    <option value="1">Disponible</option>
    <option value="0">No Disponible</option>
  </select>  
  <br><br>
  
  

  <span class="error">* <?php echo $id_rolErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Aceptar">  
</form>
</div>

<?php
  
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "ingenieria";
  
  
  
  if($asignatura!=null && $capacidad!=null && $disponibilidad!=null){
     /* echo $asignatura;
      echo "<br>";
      echo $capacidad;
      echo "<br>";
      echo $disponibilidad;
      echo "<br>";
      echo $lastname;
      echo "<br>";
      echo $id_rol;
      echo "<br>";*/

      
      

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "UPDATE asignaturas SET asignatura='$asignatura', capacidad='$capacidad', disponibilidad='$disponibilidad' WHERE idasig='$_SESSION[asignaturamodf]'";
        
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        $conn->close();
       header('location:../vicedecano.php');
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error; 
        } 
      }


     
      //echo $sql;


  

?>






      </div>

      </center>
</body>
</html>
<?php  ?>