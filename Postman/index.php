<?php
require("conexion.php");
$nombre= "";
$edad = "";

if(isset($_POST["nombre"])){
    $nombre = $_POST["nombre"];
}

if(isset($_POST["edad"])){
    $edad = $_POST["edad"];
}

$sql = "INSERT INTO weyes (id,nombre,edad) VALUES (' ','$nombre','$edad')";

if(mysqli_query($conn,$sql)){
    echo "new recod created succefuly";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>