<?php
session_start(); //INICIA A SESSÃO
ob_start(); //LIMPA BUFERREAD DE SAÍDA
unset($_SESSION['id'], $_SESSION['nome']); //SESSÕES QUE FORAM ABERTAS SÃO DESTRUÍDAS QUANDO CLICAR EM SAIR
$_SESSION['msg'] = "<p style='color: green'> Deslogado com sucesso!</p>";
header("Location: index.php"); //DESLOGA USUÁRIO