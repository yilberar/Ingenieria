<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../css/Estilos.css">
<title>Registrar usuario </title>

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
 
  
  
    
 
  <span class="error">* <?php echo $id_rolErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Registrar">  
</form>
</div>

<?php
  
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "ingenieria";
  
  
  
  if($user!=null && $pass!=null && $firstname!=null && $lastname!=null && $id_rol!=null ){
   

      
      

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT * FROM usuarios WHERE user='$user'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<script>alert('nombre de usuario no disponible')</script>";
       
 
      }  else { 
      $sql = "INSERT INTO usuarios (user, pass, firstname, lastname, id_rol)
      VALUES ('$user','$pass','$firstname','$lastname','$id_rol')";
      

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        $conn->close();

        
        header('location:../vicedecano.php');

      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

     
      


  }
}
?>






      </div>

      </center>
</body>
</html>