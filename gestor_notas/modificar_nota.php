
<?php

session_start();

if (isset($_GET["id"])){
  $_SESSION['notamodf']=$_GET["id"];
}
      

        ?>

<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="../css/Estilos.css">
<title>Modificar nota </title>

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
$notaErr = "";
$nota = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["nota"])) {
    $notaErr = "Inserte nota";
  } else {
    $nota = test_input($_POST["nota"]);
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
 
  Nota: <select id="nota" name="nota">
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    
    <option value="0">No Asignada</option>
  </select>  
  <br><br>
  
  

  <span class="error">* <?php echo $notaErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Aceptar">  
</form>
</div>

<?php
  
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "ingenieria";
  
  
  
  if($nota!=null){
    

      
      

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "UPDATE estud_asig SET nota='$nota' WHERE idestud_asig='$_SESSION[notamodf]'";
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