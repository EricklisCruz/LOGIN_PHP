<?php
session_start(); //INICIA SESSÃO
ob_start(); //CASO O SERVIDOR ESTEJA LIMITADO, É LIMPADO O BUFFEREAD DE SAÍDA EVITANDO ERROS NO MOMENTO DO REDIRECIONAMENTO
include_once 'conexao.php'; //incluido tudo que tiver no arquivo de conexão com PHP uma única vez

//VERIFICA SE USUÁRIO ESTÁ LOGADO, CASO NÃO SEU ACESSO É NEGADO
if((!isset($_SESSION['id'])) AND (!isset($_SESSION['nome']))){
  $_SESSION['msg'] = "Necessário fazer login para acessar a página";
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agência-Esthe</title>
</head>
<body>

  <h1>Olá! Seja muito bem vindo, <?php echo $_SESSION['nome'];?></h1>
  <a href="sair.php">Sair</a>
</body>
</html>