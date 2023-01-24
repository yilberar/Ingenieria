<?php
    
    session_start();
    if(isset($_GET['cerrar_sesion'])){

        session_unset();

        session_destroy();
    }

    if(isset($_SESSION['rol'])){
        switch($_SESSION['rol']){
            case 1:
                header('location: estudiante.php');
            break;
            
            case 2:
                header('location: profesor.php');
            break;

            case 3:
                header('location: vicedecano.php');
            break;
            
            default:
        }
    }

    $alertpass="";
    $username= "1";
    $passtecleadoErr="";

    if(isset($_POST['usertecleado']) && isset($_POST['passtecleado'])){
        $username = $_POST['usertecleado'];
        $password = $_POST['passtecleado'];
        
        

        $servername = "localhost";
        $userserver = "root";
        $passserver = "root";
        $dbname = "ingenieria";
        
        // Create connection
        $conn = new mysqli($servername, $userserver, $passserver, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM usuarios WHERE user='$username' AND pass='$password'";
        $result = $conn->query($sql);
        
        
        if ($result->num_rows > 0)  {
         
            $row = $result->fetch_assoc();
           
            $rol = $row['id_rol'];
            $iduser= $row['iduser'];
            $notif= $row['newnotif'];

            
            $_SESSION['rol'] = $rol;

            $_SESSION['iduser'] = $iduser;

            $_SESSION['notif'] = $notif;


            switch($_SESSION['rol']){
                case 1:
                    header('location: estudiante.php');
                break;
                
                case 2:
                    header('location: profesor.php');
                break;
    
                case 3:
                    header('location: vicedecano.php');
                break;
                
                default:
            }




        } else {
        
        if (!(empty($_POST["usertecleado"])) AND !(empty($_POST["passtecleado"])) ) {
          

         $alertpass="usuario o contraseña incorrecto";
        }
  
        $conn->close();

        }  
    }   

 

?>

<!DOCTYPE html>
<html>

    <head>

    
        <title>Sistema de gestión de cursos de capacitacion optativa</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/Estilos.css">

        <style> 
            .error {color: #FF0000;}
            body{
                /* background-color: rgb(7, 7, 78);*/
                background-image:url(images/imagenuci.jpg);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                
            } 
                  
        </style>

      

    </head>


    <body bgcolor="black" text="white">

    <script type="text/javascript">
      window.onload = function(){
        Push.Permission.request();
      }
      </script>


                  <!-- PHP --> 
                  
                  <?php 
            
            $passtecleadoErr="";
            //Almacenando input en variables
           // $usertecleado = $passtecleado = $privilege = "";
             $usertecleadoErr = $passtecleadoErr = $userNotFound = $passNotFound = "";

             if ($_SERVER["REQUEST_METHOD"] == "POST") {
                 if (empty($_POST["usertecleado"])) {
                     $usertecleadoErr = "Inserte el usuario";
                   }/*else{
                     $usertecleado = test_input($_POST["userinput"]);
                   }*/
                   if (empty($_POST["passtecleado"])) {
                     $passtecleadoErr = "Inserte contraseña";
                   }/*else{
                     $passtecleado = test_input($_POST["passinput"]);
                   }*/
                 
             }
             
             function test_input($data) {
                 $data = trim($data);
                 $data = stripslashes($data);
                 $data = htmlspecialchars($data);
                 return $data;
             } 

                         
                      
     ?>
    

            <center>
                <div class="uno">
                
               
                
                
                <div></div><h1>Sistema de Gestión de Curso de Capacitación Optativa</h1>

               <br>

               <div><img class="avatar" src="images/Avatar2.jfif"></div> 
               <br>
                <h1>Autenticarse</h1>
                <br>
                
                
                <form method="post" action="#">
        
               <div class="div1"> usuario: <input class="myinput myinput1" name="usertecleado">
               <span class="error"> <br> <?php echo $usertecleadoErr;?></span>
                <br>
                <br>
                contraseña: <input type="password" class="myinput myinput2" name="passtecleado">
                <span class="error"> <br> <?php echo $passtecleadoErr;?></span>
                <p class="error"> <?php echo "$alertpass"; ?> </p>
                
                <br>  
                </div>
                <div>
                  <button class="boton boton1"  >Iniciar Sesión </button>
                 <!-- <input type="button" class="boton boton1" value="Iniciar sesion" href="index.php"> -->
                 
           




                </form>
           
                 
                  
                  
                  

        
    
         



                
    


  

            </div>
        </center>
        
        
        
        
    </div>
</center>
        

    </body>

</html>