<?php

include 'conn.php';

$id = 0;
session_start();
if (isset($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $imgUsuario = $_SESSION["imgUsuario"];

} else {
  header("Location: ../index.php");
}

function imgUsuario($imgUsuario)
{
  if (strlen($imgUsuario) != 0) {
    echo $imgUsuario;
  } else {
    echo "/img/user-default.jpg";
  }
}

$prontoParaEnvio = 1;
//backend publicar
if (isset($_POST["titulo"]) && isset($_POST["subtitulo"]) && isset($_POST["texto"])) {
  if (strlen($_POST["titulo"]) != 0 && strlen($_POST["subtitulo"]) != 0 && strlen($_POST["texto"]) != 0 && $_FILES["imgBlog"]["tmp_name"]) {
    $arquivo = $_FILES["imgBlog"];
    $imgArtigo = "../imgBlog/" . $arquivo["name"];
    insertArticle($id, $_POST["titulo"], $_POST["subtitulo"], $_POST["texto"], $imgArtigo);
    move_uploaded_file($arquivo["tmp_name"], $imgArtigo);
    header("location: minhasPublicacoes.php");

  } else {
    $prontoParaEnvio = 0;
  }


}





?>


<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <title>Tec Blog - Publicar</title>
</head>

<body>
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
            <a class="nav-link" href="minhasPublicacoes.php">Minhas
              publicações</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Usuário
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="perfil.php">Meu perfil</a></li>
              <li><a class="dropdown-item" href="#">Publicar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="exitSession.php"><S></S>Sair</a></li>
            </ul>
          </li>
          <li class="nav-item ml-2">
            <img src="<?php imgUsuario($imgUsuario) ?>" alt="" class=" mt-1" style="width: 30px;">
          </li>
        </ul>

      </div>
    </div>
  </nav>
  <!-- Fim Menu -->



  <div class="container text-white p-5 mt-3 w-50 rounded-4" style="background-color: #17A2B8;">
    <div class="">
      <form action="publicar.php" method="post" enctype="multipart/form-data">
        <h6 for="">Título :</h6>
        <input class="form-control " type="text" placeholder="Título do blog" name="titulo">
        <br>
        <h6>Subtítulo :</h6>

        <input class="form-control " type="text" placeholder="Subtítulo do blog" name="subtitulo" maxlength="2000">
        <br>
        <h6 for="">Conteúdo :</h6>

        <textarea name="texto" id="" cols="75" rows="10" maxlength="2000"
          placeholder="Escreva aqui o conteúdo do blog"></textarea>

        <h6>Imagem para a sua publicação:</h6>
        <div class="py-2">

          <input type="file" accept="image/*" class="custom-file-input" name="imgBlog">
        </div>
        <div style="display: <?php if ($prontoParaEnvio == 1) {
          echo 'none;';
        } else {
          echo ';';
        } ?>">
          <h6 class="text-warning">Preencha todos os campos antes de publicar, inclusive imagem.</h6>
        </div>
        <div class="p-2">
          <button class="btn btn-success btn-lg btn-block" type="submit">Publicar</button>
        </div>

      </form>
    </div>


  </div>



</body>



</html>