<?php

$host= "localhost";
$user = "root";
$pass = "";
$dbname = "testelogin";
$port = 3307;

try{
  $conn = new PDO("mysql:host=$host;port=$port;dbname=" .$dbname, $user, $pass);
  //echo "Conexão com banco de dados realizado com sucesso!";
}catch(PDOException $err){
  //echo "Erro: Conexão com banco de dados não realizado com sucesso. Erro gerado " . $err->getMessage();
}