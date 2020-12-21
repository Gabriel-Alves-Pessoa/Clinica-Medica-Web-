<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "clinicou";

    $connect = mysqli_connect($servername, $username, $password, $db_name);

    if(mysqli_connect_error()){
        echo "erro".mysqli_connect_error();
    }
?>