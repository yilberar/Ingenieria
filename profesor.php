<?php 

session_start();



if(!isset($_SESSION['rol'])){
    header('location: index.php');
}
else{
    if($_SESSION['rol'] !=2){
        header('location: index.php');
    }
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



?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/Estilos.css">

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/push.min.js"></script>

  <title>Profesor</title>


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


   <div>
      <div class="tab">
      <button class="main" >PROFESOR</button>
      <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'Listestud')">Visualizar Estudiantes</button>
      <button class="tablinks" onclick="openCity(event, 'Gnotas')">Gestionar Notas</button>
      <button class="tablinks" onclick="openCity(event, 'GRTnotas')">Gestionar Notas</button>
  
      <div class="topnav-right">
        <div class= "mynombre">
      
        </div>
        <div class="dropdown">
        <button class="dropbtn"   onclick="myFunction()"><img src="images/icon2.png" width="25" height="25"></button>
       
            <div class="dropdown-content" id="myDropdown">
            <div class="ml"> 
            <!-- <button class="btcolor" onClick="Marcar()">Marcar como leido</button> -->
            <a  href='/!!!!Ingenieria/marcarnotf.php?id=<?php echo $ultnotf[0] ?>&id1=<?php echo $ultnotf[1] ?>&id2=<?php echo $ultnotf[2] ?>'>Marcar como leido</a>
            <br><br>
            </div>


         
            
            <button onclick="openCity(event, 'ListarNotif')">Mostrar todas</button>
            </div>
        </div>
          <button class="tablinks" onclick="location.href='cerrar_sesion.php'">Cerrar Sesion</button>
        </div>
        
      </div>

      <div id="Listestud" class="tabcontent">
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
        
        
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Usuario</th>
        

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

            $sql = "SELECT * FROM usuarios WHERE id_rol=1";
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            while($row = $result->fetch_assoc()){
                echo "
                <tr>   
                        <td>$row[firstname]</td>
                        <td>$row[lastname]</td>
                        <td>$row[user]</td>
                        
                </tr>
                ";
            }
            ?>
        </tbody>
        </table>
          </center>
      </div>


      <div id="Gnotas" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
       
       
       <center>
        <h1>Gestionar notas</h1>
        
        
        <table border="1" class="tabla1">

        <thead>


        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Asignaturas</th>
        <th>Nota</th> 
        <th></th>
        


        </thead>   

<tbody>

    <?php

$sql = "SELECT idestud_asig, user, firstname, lastname, asignatura, nota FROM asignaturas 
JOIN estud_asig ON asignaturas.idasig=estud_asig.idasig 
JOIN usuarios ON estud_asig.iduser=usuarios.iduser
ORDER BY user";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }
    $confirm='"Estas seguro que desea eliminar el registro?"';
    while($row = $result->fetch_assoc()){
        echo "
        <tr>   
            <td>$row[user]</td>
            <td>$row[firstname]</td>
            <td>$row[lastname]</td>    
            <td>$row[asignatura]</td>
            <td>$row[nota]</td>
            <td> <a class='two' href='/!!!!Ingenieria/gestor_notas/modificar_nota.php?id=$row[idestud_asig]' clas='table_item_link'>Modif. Nota</a>  </td>

            </tr>   
            ";}
               
                

            


            
    ?>
      </tbody>
        </table>



<center>
      </div>

      
 
    </div>

    <div id="GRTnotas" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
       
       
       <center>
        <h1>Gestionar notas</h1>
        
        
        <table border="1" class="tabla1">

        <thead>


        <th>Usuario</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Asignaturas</th>
        <th>Nota</th> 
       
        


        </thead>   

<tbody>

    <?php

$sql = "SELECT idestud_asig, user, firstname, lastname, asignatura, nota FROM asignaturas 
JOIN estud_asig ON asignaturas.idasig=estud_asig.idasig 
JOIN usuarios ON estud_asig.iduser=usuarios.iduser
ORDER BY user";

    $result = $conn->query($sql);

    if (!$result) {
        die("Invalid query: " . $conn->error);
    }
    $confirm='"Estas seguro que desea eliminar el registro?"';
    while($row = $result->fetch_assoc()){
        echo "
        <tr>   
            <td>$row[user]</td>
            <td>$row[firstname]</td>
            <td>$row[lastname]</td>    
            <td>$row[asignatura]</td>
            <td>$row[nota]</td>
            </tr>   
            ";}
               
                

            


            
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
      
      



   
     
   


 