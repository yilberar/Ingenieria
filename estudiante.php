<?php 

session_start();



if(!isset($_SESSION['rol'])){
    header('location: index.php');
}
else{
    if($_SESSION['rol'] !=1){
        header('location: index.php');
    }
}

if(!isset($_SESSION['iduser'])){
  header('location: index.php');
}

if (isset($_GET["id"])){

  

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

          $usuarioreg="";

          $sqluser = "SELECT user, firstname, lastname FROM usuarios WHERE iduser=  '$_SESSION[iduser]'";
          $resultuser = $conn->query($sqluser);

          if (!$resultuser) {
            die("Invalid query: " . $conn->error);
        } else{
          $row = $resultuser->fetch_assoc();
          $usuarioreg= $row['firstname']. " ". $row['lastname'];
        }

        $ultnotf = array(0, 0, 0);


?>

<!DOCTYPE html>
<html>
<head>

<title>Estudiante</title>

<link rel="stylesheet" href="css/Estilos.css">

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/push.min.js"></script>

<style>
      
      body{
        
                    background-image:url(images/Doc5uci.jpg);
                    background-repeat: no-repeat;
                  background-attachment: fixed;
                  background-size: cover;
      }

     
      table, th, td {
        border: 1px solid black;
      } 
</style>

</head>
<body>


<?php
    
    if (isset($_GET["verf"])){
    
    echo '<script>
		Push.create("Notificaciones actualizadas",{
			body: "Las notificaciones han sido marcadas como leidas",
			icon: "images/confirmacion.jfif",
			timeout: 7000,
			onClick: function () {
				window.location="https://nickersoft.github.io/push.js/";
				this.close();
			}
		});
  </script>';
  
    }

    if (isset($_GET["solic"])){
    
      echo '<script>
      Push.create("Solicitud Enviada",{
        body: "La solicitud ha sido enviada con éxito",
        icon: "images/confirmacion.jfif",
        timeout: 7000,
        onClick: function () {
          window.location="https://nickersoft.github.io/push.js/";
          this.close();
        }
      });
    </script>';
    
      }

      if (isset($_GET["solicden"])){
    
        echo '<script>
        Push.create("Solicitud no Enviada",{
          body: "Tu solicitud a este curso ya ha sido enviada con anterioridad",
          icon: "images/denegar.jfif",
          timeout: 7000,
          onClick: function () {
            window.location="https://nickersoft.github.io/push.js/";
            this.close();
          }
        });
      </script>';
      
        }

      
      

	?>

   <div>
      <div class="tab">
      <button class="main" >ESTUDIANTE</button>
      <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'RSolicitud')">Realizar Solicitud de Asignatura</button>
      <button class="tablinks" onclick="openCity(event, 'VAsignaturas')">Visualizar Asignaturas</button>
      
        <div class="topnav-right">
        <div class= "mynombre">
       <h2> <?php echo $usuarioreg; ?> </h2>
        </div>
        <div class="dropdown">
        <button class="dropbtn"   onclick="myFunction()"><img src="images/icon2.png" width="25" height="25"></button>
        <?php 
           
           $sql = "SELECT idnotif, mensaje FROM `notificaciones` WHERE iduser='$_SESSION[iduser]' AND estado = 0 ORDER BY fecha DESC";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            $row = $result->fetch_assoc();
          
        
           for ($i=0; $i < 3 & $row = $result->fetch_assoc(); $i++)  { 
             # code...
                $ultnotf[$i]=$row['idnotif'];
                /*echo "
                <h5>$ultnotf[$i]</h5>
                ";*/
            }
            ?>

            <div class="dropdown-content" id="myDropdown">
            <div class="ml"> 
            <!-- <button class="btcolor" onClick="Marcar()">Marcar como leido</button> -->
            <a  href='/!!!!Ingenieria/marcarnotf.php?id=<?php echo $ultnotf[0] ?>&id1=<?php echo $ultnotf[1] ?>&id2=<?php echo $ultnotf[2] ?>'>Marcar como leido</a>
            <br><br>
            </div>


           <?php 
           
          
           
           $sql = "SELECT idnotif, mensaje FROM `notificaciones` WHERE iduser='$_SESSION[iduser]' AND estado = 0 ORDER BY fecha DESC";
            $result = $conn->query($sql);
            
            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            
            $row = $result->fetch_assoc();
            if(count($row)==0){
              echo "<h5>sin notificaciones nuevas</h5>";
            }else{
           for ($i=0; $i < 3; $i++) { 
             # code...
           $row = $result->fetch_assoc();
                
                echo "
                <h5>$row[mensaje]</h5>
                ";
                $ultnotf[$i]=$row['idnotif'];
                /*echo "
                <h5>$ultnotf[$i]</h5>
                ";*/
                }
              }
            ?>

              
            
            <button onclick="openCity(event, 'ListarNotif')">Mostrar todas</button>
            </div>
        </div>
          <button class="tablinks" onclick="location.href='cerrar_sesion.php'">Cerrar Sesion</button>
        </div>
        
      </div>

      <div id="VAsignaturas" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
        
        <script>
          
          

          function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
          }

          window.onclick = function(e) {
            if (!e.target.matches('.dropbtn')) {
            var myDropdown = document.getElementById("myDropdown");
              if (myDropdown.classList.contains('show')) {
                myDropdown.classList.remove('show');
              }
            }
          }

          
        </script>  
        <center>
        
        <br><br>
        
        
        <table border="1" class="tabla1">

        <thead>
        
        
        <th>Asignatura</th>
        <th>Nota</th>
        

        </thead>   

        <tbody>

       

            <?php
            
            // $servername = "localhost";
            // $username = "root";
            // $password = "root"; 
            // $dbname = "ingenieria";


            // // Create connection
            // $conn = new mysqli($servername, $username, $password, $dbname);
            // // Check connection
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }

            $sql = "SELECT asignaturas.asignatura, estud_asig.nota 
            FROM asignaturas 
            JOIN estud_asig ON asignaturas.idasig = estud_asig.idasig 
            WHERE estud_asig.iduser='$_SESSION[iduser]'";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            $asignat=array("");
           
           for($i=0;$row = $result->fetch_assoc();$i++){
                
              $asignat[$i]=$row['asignatura'];
                echo "
                <tr>   
                        <td>$asignat[$i]</td>
                        <td>$row[nota]</td>
                        
                </tr>
                ";
            }
            ?>
        </tbody>
        </table>
          </center>
      </div>


      <div id="RSolicitud" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
       
       
       <center>
        <h1>Asignaturas Optativas Disponibles</h1>
        
        
        <table border="1" class="tabla1">

        <thead>


        <th>Asignaturas</th><th>Solicitar</th>
        


        </thead>   

<tbody>

    <?php
       $cantasig="";
       $sql0 = "SELECT COUNT(asignaturas.asignatura) AS cantidad
       FROM asignaturas 
       JOIN estud_asig ON asignaturas.idasig = estud_asig.idasig 
       WHERE estud_asig.iduser='$_SESSION[iduser]'";
        
        $result0 = $conn->query($sql0);
        $row = $result0->fetch_assoc();
        $cantasig=$row['cantidad'];
        
            
        
        $sql = "SELECT asignatura,idasig FROM asignaturas WHERE disponibilidad = 1";

            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }
            
            while($row = $result->fetch_assoc()){
              $matric=0;
              for($i=0;$i<count($asignat);$i++){
                if($row['asignatura']==$asignat[$i]){
                  $matric=1;
                }
              }
                echo "
                <tr>   
                        <td>$row[asignatura]</td>";
                        if($cantasig<2 & $matric==0){  
                        echo "<td> <a class='three' href='/!!!!Ingenieria/usuarios/solicitar_asignatura.php?id=$row[idasig]' clas='table_item_link'>Solicitar</a>  </td>";
               }else{
                echo "<td></td>";
               }
               echo "</tr>";
                
                

            }

          
            
    ?>
      </tbody>
        </table>



<center>
      </div>

      
 
    </div>

    <div id="ListarNotif" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
       
       
       <center>
        <h1>Listado de Notificaciones</h1>
        
        
        <table border="1" class="tabla1">

        <thead>


        <th>Notificaciones</th><th>Fecha</th><th>Estado</th>
        


        </thead>   

<tbody>

    <?php

        $sql = "SELECT mensaje, fecha, estado FROM notificaciones WHERE iduser='$_SESSION[iduser]' ORDER BY fecha DESC";

            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            while($row = $result->fetch_assoc()){
                echo "
                <tr>   
                        <td>$row[mensaje]</td>
                        <td>$row[fecha]</td>";
                        
                  if($row['estado']==0){
                    echo "<td> Nueva </td>";
                  }else{
                       echo "<td> Leida </td>";
                  }
                      echo"        
                </tr>";
            }

    ?>
      </tbody>
        </table>



<center>
      </div>

      
 
    </div>


  <script>
  
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
  
  function MostrarApartado(x){

    document.getElementByClassName(x);
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }

  }
  
 
  </script>
    </center>


</body>
</html> 
      
      



   
     
   


 