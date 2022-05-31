<?php
session_start(); //INICIA SESSÃO
ob_start(); //CASO O SERVIDOR ESTEJA LIMITADO, É LIMPADO O BUFFEREAD DE SAÍDA EVITANDO ERROS NO MOMENTO DO REDIRECIONAMENTO
include_once 'conexao.php'; //incluido tudo que tiver no arquivo de conexão com PHP uma única vez

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>

  <?php
    //Exemplo criptografar a senha
    //echo password_hash(123456, PASSWORD_DEFAULT);
  ?>
  <h1>Login</h1>

  <?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); //FILTER É UTILIZADO PARA RECEBER OS DADOS COMO STRING
    if(!empty($dados['sendLogin'])){ //VERIFICA SE O QUE O USUÁRIO DIGITOU ESTÁ VAZIO
      //var_dump($dados); //VERIFICA SE ALGUMA COISA FOI REALMENTE ADICIONADA
      $query_usuario = "SELECT id, nome, usuario, senha FROM usuario WHERE usuario = :usuario LIMIT 1"; // SELECT PARA PEGAR INFORMAÇÕES DO USUÁRIO
      $result_usuario = $conn->prepare($query_usuario); //PREPARA O SQL
      $result_usuario->bindParam(':usuario', $dados['usuario'], PDO::PARAM_STR); //BindParam() ele inidica que o link :usuario vai receber os seguintes valores //PDO::PARAM_STR INDICA QUE VAI RECEBER UMA STRING
      $result_usuario->execute(); //EXECUTA OS RESULTADOS 

      if(($result_usuario) AND ($result_usuario->rowCount() != 0)){ //SE O RESULTADO QUE O USUÁRIO INFORMOU E POSSUIR INFORMAÇÕES NO BANCO DE DADOS É FEITO O ACESSO
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);//PARA LER O REGISTRO É UTILIZADO O FETCH INDICA QUE ESTÁ USANDO PDO E O FETCH_ASSOC INDICA QUE ESTÁ LENDO O REGISTRO DA COLUNA
        
        //var_dump($row_usuario);

        //VERIFICA SE A SENHA INFORMADA É IDENTICA A QUE ESTÁ ARMAZENADA NO BANCO DE DADOS
        if(password_verify($dados['senha'], $row_usuario['senha'])){
          $_SESSION['id'] = $row_usuario['id']; //RECEBE O ID QUE VEM DO BANCO DE DADOS
          $_SESSION['nome'] = $row_usuario['nome']; //RECEBE O nome QUE VEM DO BANCO DE DADOS
          header("Location: dashboard.php"); //REDIRECIONA PARA A PÁGINA INFORMADA
        }else{
          $_SESSION['msg'] = "<p style='color: #ff0000'> Erro: Senha inválida!";
        }
      }else{
        $_SESSION['msg'] = "<p style='color: #ff0000'> Erro: Usuário inválido!";
      }

      /*'".$dados['usuario']."' LIMIT 1";*/ 
    }

    if(isset($_SESSION['msg'])){
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
  ?>

  <form action="" method="POST">
    <label>Usuário</label>
    <input type="text" name="usuario" placeholder= "Digite o usuário" value=<?php if(isset($dados['usuario'])) {
      echo $dados['usuario']; //MANTÉM OS VALORES CASO A SENHA ESTEJA INCORRETA OU USUÁRIO
    }?>>

    <label>Senha</label>
    <input type="password" name="senha" placeholder= "Digite a senha" value=<?php if(isset($dados['senha'])) {
      echo $dados['senha'];
    }?>>

    <input type="submit" value="Acessar" name="sendLogin">
  </form>
  
</body>
</html>