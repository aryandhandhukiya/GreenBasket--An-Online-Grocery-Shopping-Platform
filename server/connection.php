<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "grocery-online";

    $conn= new mysqli($servername, $username, $password, $database);

    if($conn->connect_error){
        die($conn->connect_error);
    } 
    echo "Connection succesfully";
?>