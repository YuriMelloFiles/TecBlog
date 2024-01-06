<?php

include 'conn.php';
session_start();
$senhaIncorreta = 0;

//inicia as variáveis necessarias para a troca de dados no banco
if (isset($_SESSION["id"])) {
  $id = $_SESSION["id"];
  if (isset($_GET["campo"])) {
    $campo = $_GET["campo"];
    $_SESSION["campo"] = $campo;

  } else {
    $campo = $_SESSION["campo"];
  }

}

//atualiza no banco de dados informações que nao sejam a senha
if (isset($_POST["atualizacao"]) && strlen($_POST["senha"]) == 0) {

  $resposta = changeInformation($id, $campo, $_POST["atualizacao"]);
  unset($_SESSION["campo"]);
  header("location: perfil.php");

}

//atualiza no banco de dados a senha
if (isset($_POST["atualizacao"]) && strlen($_POST["senha"]) != 0) {

  //testar se o usuario acertou a senha atual
  $respostaDaSenha = getPassword($id, $_POST["senha"]);
  if ($respostaDaSenha == NULL) {
    $senhaIncorreta = 1;
  } else {
    $senhaHash = md5(md5(md5($_POST["atualizacao"])));
    changeInformation($id, $campo, $senhaHash);
    header("location: perfil.php");
  }
}


//personaliza o campo de input de acordo com o assunto
function campoDeAtualizacao($campo)
{

  if ($campo == 'email') {
    echo 'email';
  } elseif ($campo == 'celular') {
    echo 'number';
  } else {
    echo 'tel';
  }
}
function campoDeAtualizacaoSenha($campo)
{
  if ($campo == 'senha') {
    echo ';';
  } else {
    echo 'none;';
  }

}
function campoDeAtualizacaoSenhaIncorreta($senhaIncorreta)
{
  if ($senhaIncorreta == 0) {
    echo "none;";
  } else {
    echo ";";
  }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/javaScript.js"></script>


  <title>Redefinição - Tec Blog</title>
</head>

<body>
  <div class="container  bg-secondary border-white bg-gradient text-light mt-5  p-4 w-25 rounded-4">
    <form action="redefinicaoUsuario.php" method="POST">
      <div class="pt-2 pb-3" style="display: <?php campoDeAtualizacaoSenha($campo) ?> ">
        <h6>
          <label for="">Digite sua senha atual :</label>
        </h6>

        <input type="password" class="form-control" name="senha">
      </div>
      <div>
        <h6 for="">Redefinir
          <?php echo $campo; ?> para :
        </h6>
      </div>
      <div>
        <input type="<?php campoDeAtualizacao($campo) ?>" class="form-control" name="atualizacao">
      </div>

      <div style="display: <?php campoDeAtualizacaoSenhaIncorreta($senhaIncorreta) ?>">
        <p class="text-warning">Senha atual errada</p>
      </div>

      <div>
        <button class="btn btn-button btn-success mt-4" type="submit">Redefinir</button>
      </div>

    </form>


  </div>

</body>


</html>