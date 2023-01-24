<?php 

    session_start();

    if (isset($_GET["id"])){

        $idasig = $_GET["id"];
        echo $idasig;

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
        $sql0 = "SELECT * FROM solicitud WHERE idasig='$idasig' AND iduser='$_SESSION[iduser]'";
        $result = $conn->query($sql0);

        if ($result->num_rows > 0) {
            header("location: /!!!!Ingenieria/estudiante.php?solicden=1");
        } 
        else{

            $sql = "INSERT INTO solicitud ( idasig, iduser)
            VALUES ('$idasig', '$_SESSION[iduser]')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                echo "solicitud asig ". $idasig;
            } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

             $conn->close();
    
        

            header("location: /!!!!Ingenieria/estudiante.php?solic=1");
            exit;
        }

}


?>