<?php
$host="localhost";
$usuario= 'root'; 
$senha= '';
$database= 'login';


$mysqli = new mysqli($host, $usuario, $senha, $database);


if($mysqli->connect_errno){
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}