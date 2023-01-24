
<?php

session_start();

if (isset($_GET["id"])){
  $_SESSION['usermodf']=$_GET["id"];
}
        // echo $iduser;

        ?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../css/Estilos.css">
<title>Modificar usuario </title>

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
$userErr = $passErr = $firstnameErr = $lastnameErr = $id_rolErr = "";
$user = $pass = $firstname = $lastname = $id_rol = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["user"])) {
    $userErr = "Inserte el usuario";
  } else {
    $user = test_input($_POST["user"]);
  }
  
  if (empty($_POST["pass"])) {
    $passErr = "inserte contraseña";
  } else {
    $pass = test_input($_POST["pass"]);
  }
    
  if (empty($_POST["firstname"])) {
    $firstnameErr = "inserte nombre";
  } else {
    $firstname = test_input($_POST["firstname"]);
  }

  if (empty($_POST["lastname"])) {
    $lastnameErr = "inserte apellido";
  } else {
    $lastname = test_input($_POST["lastname"]);
  }

  if (empty($_POST["rol"])) {
    $id_rolErr = "inserte rol";
  } else {
    $id_rol = test_input($_POST["rol"]);
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
  Usuario: <input type="text" name="user">
  <span class="error"> <?php echo $userErr;?></span>
  <br><br>
  Contraseña: <input type="text" name="pass">
  <span class="error"> <?php echo $passErr;?></span>
  <br><br>
  Nombre: <input type="text" name="firstname">
  <span class="error"> <?php echo $firstnameErr;?></span>
  <br><br>
  Apellido: <input type="text" name="lastname">
  <span class="error"> <?php echo $lastnameErr;?></span>
  <br><br>
  Rol: <select id="rol" name="rol">
    <option value="1">Estudiante</option>
    <option value="2">Profesor</option>
    <option value="3">Vicedecano</option>
    
  </select>  
 
  
  
    
  </select>
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
  
  
  
  if($user!=null && $pass!=null && $firstname!=null && $lastname!=null && $id_rol!=null ){
     /* echo $user;
      echo "<br>";
      echo $pass;
      echo "<br>";
      echo $firstname;
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

      $sql = "UPDATE usuarios SET user='$user', pass='$pass', firstname='$firstname', lastname='$lastname', id_rol='$id_rol' WHERE iduser='$_SESSION[usermodf]'";
        echo $sql;
      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        $conn->close();
       header('location:../vicedecano.php');
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error; 
        } 
      }


     
      


  

?>






      </div>

      </center>
</body>
</html>
<?php  ?>