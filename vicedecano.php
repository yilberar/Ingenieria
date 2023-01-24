<?php 

session_start();

if(!isset($_SESSION['rol'])){
    header('location: index.php');
}
else{
    if($_SESSION['rol'] !=3){
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
  <script type="text/javascript" src="usuarios/confirmacion.js"></script>
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

<title>Vicedecano</title>

</head>
<body>
 
 

   <div>
      <div class="tab">
      <button class="main" >ADMINISTRACION</button>
      <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'GUsuario')">Gestionar Usuarios</button>
      <button class="tablinks" onclick="openCity(event, 'GSolicitudes')">Gestionar Solicitudes</button>
      <button class="tablinks" onclick="openCity(event, 'GRTAsignaturas')" >GR de total de Asignaturas</button>
      <button class="tablinks" onclick="openCity(event, 'GestionarAsignaturas')">Gestionar Asignaturas</button>
      <button class="tablinks" onclick="openCity(event, 'GREsturianteAsignatura')">GR de Estudiantes por Asignaturas</button>
        <div class="topnav-right">
        
        <div class="dropdown">
        <!-- <button class="dropbtn" onclick="myFunction()">Notif</button> -->
  
            <div class="dropdown-content" id="myDropdown">
              <a href="#">Link 1</a>
              <a href="#">Link 2</a>
              <a href="#">Link 3</a>
            </div>
        </div>
          <button class="tablinks" onclick="location.href='cerrar_sesion.php'">Cerrar Sesion</button>
        </div>
      </div>

      <div id="GUsuario" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>

        <center>

        
       <div> 
        <input type="button" class="boton boton1" value="Insertar Usuario" onclick="location.href='usuarios/registrar_usuario.php'" >
        
        <div class="search">
        
        <form method="post" action="#"><input type="text" placeholder="Buscar Usuario.." name="search"><input type="submit" value="->"></form>

        </div>

    </div>
         <br><br>
        
        
        <table border="1" class="tabla1">

        <thead>
        
        
        <th>USUARIO</th>
        <th>NOMBRE</th>
        <th>APELLIDO</th>
        <th></th>
        

        </thead>   

        <tbody>

      


            <?php
          
      if (empty($_POST["search"])) {
          
            $sqls = "SELECT iduser, user, firstname, lastname FROM usuarios";
            }
            else{
              $buser= $_POST['search'];;
              
              $sqls = "SELECT iduser, user, firstname, lastname FROM usuarios WHERE user='$buser'";
            }
            $result = $conn->query($sqls);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            $confirm='"Estas seguro que desea eliminar el registro?"';
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                // $_SESSION['usermodf']=$row['iduser'];
              echo "
                <tr>   
                        <td>$row[user]</td>
                        <td>$row[firstname]</td>
                        <td>$row[lastname]</td>
                        <td> <a class='two' href='/!!!!Ingenieria/usuarios/editar_usuario.php?id=$row[iduser]' >Modificar</a> 
                             <a class='one' onclick='return confirm($confirm);' href='/!!!!Ingenieria/usuarios/eliminar.php?id=$row[iduser]' >Eliminar</a>  </td>
                </tr>
                ";
            }
          } else {
              echo "<tr>   
              <td>0resultados</td><td>0resultadoss</td><td>0resultadoss</td>
              </tr>";
            }
            ?>
        </tbody>
        </table>
          </center>


      </div>

      

      <div id="GSolicitudes" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
        <center>
        <h1>Gestionar Solicitud de Cursos</h1>
        
       
        <br><br>
        
        
        <table border="1" class="tabla1">

        <thead>
        
        
        <th>USUARIO</th>
        <th>SOLICITUD</th>
        <th></th>
        

        </thead>   

        <tbody>

<?php 

if (isset($_GET["eliminar"])){
    
  echo '<script>
  Push.create("Eliminado no satisfactorio",{
    body: "El usuario tiene informacion asociada",
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
        

      <?php

            $sql = "SELECT usuarios.user, solicitud.idsolicitud, asignaturas.asignatura, usuarios.iduser, asignaturas.idasig 
            FROM usuarios 
            JOIN solicitud ON usuarios.iduser=solicitud.iduser 
            JOIN asignaturas ON solicitud.idasig=asignaturas.idasig
            WHERE estado_solicitud='pendiente'";
            
            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            while($row = $result->fetch_assoc()){
                echo "
                <tr>   
                        <td>$row[user]</td>
                        <td>$row[asignatura]</td> 
                        <td> <a class='three' href='/!!!!Ingenieria/aceptar_solicitud.php?id=$row[iduser]&id1=$row[idasig]&id2=$row[idsolicitud]' >Aceptar</a> 
                        <a class='one' href='/!!!!Ingenieria/denegar_solicitud.php?id=$row[idsolicitud]'>Denegar</a>
                        </td>
                </tr>
                ";
            }
            ?>
        </tbody>
        </table>
          </center>
      </div>


      

      <div id="GRTAsignaturas" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
       
       <center>
        <h1>Asignaturas</h1>
        
        <table border="1" class="tabla1">

        <thead>

        <th>Asignaturas</th><th>Capacidad</th>
        
        </thead>   

        <tbody>

        <?php

        $sql = "SELECT asignatura,capacidad FROM asignaturas WHERE disponibilidad = 1";

            $result = $conn->query($sql);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            while($row = $result->fetch_assoc()){
                echo "
                <tr>   
                        <td>$row[asignatura]</td>
                        <td>$row[capacidad]</td>               </tr>";
            }
          ?>
        </tbody>
        </table>



        <center>
      
    </div>

      
    <div id="GestionarAsignaturas" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
        <center>
        
        
        <div> 
        <button class="boton boton1"  onclick="location.href='gestor_asig/registrar_asig.php'">Insertar asignatura</button>
        
        <div class="search">
        
        <form method="post" action="#"><input type="text" placeholder="Buscar Asignatura.." name="searcha"><input type="submit" value="->"></form>

        </div>

    </div>
         <br><br>
        
        
        <table border="1" class="tabla1">

        <thead>
        
        
        <th>Asignatura</th>
        
        <th></th>
        

        </thead>   

        <tbody>

      


            <?php
          
      if (empty($_POST["searcha"])) {
          
            $sqlss = "SELECT * FROM asignaturas";
            }
            else{
              $basig= $_POST['searcha'];;
              
              $sqlss = "SELECT * FROM asignaturas WHERE disponibilidad='1' AND asignatura='$basig'";
            }
            $result = $conn->query($sqlss);

            if (!$result) {
                die("Invalid query: " . $conn->error);
            }

            $confirm='"Estas seguro que desea eliminar el registro?"';
            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
               
              echo "
                <tr>   
                        <td>$row[asignatura]</td>
                       
                        <td> <a class='two' href='/!!!!Ingenieria/gestor_asig/modificar_asig.php?id=$row[idasig]' >Modificar</a>
                        <a class='one' onclick='return confirm($confirm);' href='/!!!!Ingenieria/gestor_asig/eliminar_asig.php?id=$row[idasig]' >Eliminar</a>  </td>             
                          </tr>
                ";
            }
          } else {
              echo "<tr>   
              <td>0resultados</td><td>0resultadoss</td><td>0resultadoss</td>
              </tr>";
            }
            ?>
        </tbody>
        </table>


        </center>
      </div>

      <div id="GREsturianteAsignatura" class="tabcontent">
        <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
        
        <center>
        <h1>Reporte de Estudiante por Asignatura</h1>
        
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

        $sql = "SELECT user, firstname, lastname, asignatura, nota FROM asignaturas 
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


        </center>
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
   
</body>
</html> 
