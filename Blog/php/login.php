<?php
include 'conn.php';
$logado = 1;
if (isset($_POST['senha']) && isset($_POST['email']) && strlen($_POST['senha']) != 0 && strlen($_POST['email']) != 0) {
  $senha = $_POST['senha'];
  $email = $_POST['email'];
  $respostaLogin = getLogin($email, $senha);
  if (isset($respostaLogin[0])) {

    session_start();
    $_SESSION["id"] = $respostaLogin[0]["id"];
    $_SESSION["imgUsuario"] = $respostaLogin[0]["imgUsuario"];
    //echo $_SESSION["id"];
    header("Location: ../index.php");


  } else {

    $logado = 0;
  }
}



?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tec Blog</title>
</head>

<body style="background-color: #17A2B8;">
  <!-- Menu -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php"><b>Tec Blog</b> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Minhas publicações</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Usuário
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Meu perfil</a></li>
              <li><a class="dropdown-item" href="#">Publicar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#"><S></S>Sair</a></li>
            </ul>
          </li>

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Busque aqui" aria-label="Search">
          <button class="btn btn-success" type="submit">Pesquisar</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- Fim Menu -->

  <div>
    <section class="vh-100">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <h3 class="mb-5">Entre na sua conta</h3>
                <form action="#" method="POST">
                  <div class="form-outline mb-4">
                    <input type="email" id="typeEmailX-2" class="form-control form-control-lg" name="email"
                      placeholder="Email" />

                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="senha"
                      placeholder="Senha" />

                  </div>

                  <!-- Checkbox -->
                  <div class="form-check d-flex justify-content-start mb-4 py-3">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Lembre minha senha </label>
                    <a href="" class="mx-3">Esqueci minha senha</a>
                  </div>
                  <div>
                    <label for="" style="display:<?php if ($logado == 1) {
                      echo 'none;';
                    } else {
                      echo ';';
                    } ?> color: red;" class="p-2">Senha ou
                      email
                      incorreto</label>
                  </div>

                  <div>
                    <button class="btn btn-primary btn-lg btn-block px-5" type="submit">Entrar</button>

                  </div>
                  <div class="pt-4">
                    <label for="">Ainda não possui uma conta?</label>
                    <button class="btn btn-success btn btn-block" type="submit">Cadastre-se</button>

                  </div>
                </form>


                <hr class="my-4">



              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>




</body>

</html>