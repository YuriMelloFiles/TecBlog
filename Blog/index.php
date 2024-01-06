<?php
include 'php/conn.php';
$id = 0;
session_start();
if (isset($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $imgUsuario = $_SESSION["imgUsuario"];

}

function imgUsuario($imgUsuario)
{
  if (strlen($imgUsuario) != 0) {
    echo $imgUsuario;
  } else {
    echo "/img/user-default.jpg";
  }
}


$resultado = getData("artigos");





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
  <link rel="stylesheet" href="css/styleMinhasPub.css">
  <script src="js/javaScript.js"></script>

  <title>Tec Blog</title>
</head>

<body>
  <!-- Menu -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><b>Tec Blog</b> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href=<?php
            if (isset($_SESSION["id"])) {
              echo "php/minhasPublicacoes.php";
            } else {
              echo "php/login.php";
            } ?>>Minhas
              publicações</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Usuário
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href=<?php
              if (isset($_SESSION["id"])) {
                echo "php/perfil.php";
              } else {
                echo "php/login.php";
              } ?>>Meu perfil</a></li>
              <li><a class="dropdown-item" href=<?php
              if (isset($_SESSION["id"])) {
                echo "php/publicar.php";
              } else {
                echo "php/login.php";
              } ?>>Publicar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="php/exitSession.php"><S></S>Sair</a></li>
            </ul>
          </li>
          <li class="nav-item ml-2">
            <img src="<?php imgUsuario($imgUsuario) ?>" alt="" class=" mt-1" style="width: 30px;">
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
  <!-- as colunas tem máximo de tamanho 12, dividi 8 para uma e 4 para outra (sm significa que quando for formato mobile elas ficarão uma por cima da outra) -->
  <?php foreach ($resultado as $key => $value):
    // teremos key = 0,1,2,...
    //teremos value = [toda info artigo 1],[toda info artigo 2],... com isso basta fazer value['titulo'], teremos o titulo de cada artigo
    //var_dump($value["titulo"]);
    $idPost = $value['id'];
    ?>

    <div class="container border">
      <!-- row a ser repetida para todos os artigos -->
      <a href="php/visualizacaoPost.php?id=<?php echo $idPost; ?>">
        <div class="row py-5">
          <div class="col-sm-4 " id="imgDaPub1">

            <img src="<?php echo $value["imgArtigo"]; ?>" alt="" class="img-thumbnail" id="imgDaPub2">
          </div>
          <div class="col-sm-8">
            <h3>
              <?php echo $value["titulo"]; ?>
            </h3>
            <h5>
              <?php echo $value["subtitulo"]; ?>
            </h5>
            <div>
              <?php echo substr($value["texto"], 0, 100) . "...<br><br>";

              ?>
            </div>
            <div class="text-muted font-italic">
              <i>
                <?php ;
                echo "Publicado em : " . $value["dataPublicacao"]; ?>
              </i>
              <p>
                <?php ;
                $autor = getUserData($value["autor"]);
                echo "Autor : " . $autor[0]["Nome"]; ?>
              </p>

            </div>

          </div>
        </div>
      </a>


    </div>

  <?php endforeach; ?>




</body>



</html>