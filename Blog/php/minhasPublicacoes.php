<?php
include 'conn.php';

$id = 0;
session_start();
if (isset($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $imgUsuario = $_SESSION["imgUsuario"];
  //buscando os artigos do usuario logado
  $resultado = getUserArticles($id);
  //var_dump($resultado);
  //como o resultado será um array com cada indice contendo outro array, sera necessario uma estrutura for, uma para percorrer o indice 




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
  <link rel="stylesheet" href="../css/styleMinhasPub.css">
  <script src="../js/javaScript.js"></script>
  <title>Tec Blog - Minhas publicações</title>
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
            <a class="nav-link active" aria-current="page" href="../index.php">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Minhas
              publicações</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Usuário
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="perfil.php">Meu perfil</a></li>
              <li><a class="dropdown-item" href="publicar.php">Publicar</a></li>
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
    $idPost = $value['id']
      ?>

    <div class="container border">
      <!-- row a ser repetida para todos os artigos -->
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
            <button class="btn btn-info rounded-4 my-3 text-white" name="editar" onclick="RedefinicaoArtigo(<?php
            echo $idPost; ?>) "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-pen" viewBox="0 0 16 16">
                <path
                  d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
              </svg> Editar artigo</button>

            <button class="btn btn-danger rounded-4  m-3" type="submit" name="excluir"
              onclick="ExcluirOArtigo(<?php echo $idPost; ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                <path
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
              </svg> Excluir</button>
          </div>
        </div>
      </div>

    </div>

  <?php endforeach; ?>


</body>



</html>