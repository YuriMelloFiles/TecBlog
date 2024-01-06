<?php
include 'conn.php';
session_start();

//testando se o usuário está logado
if (isset($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $dadosDoUsusario = getUserData($id);
  $nome = $dadosDoUsusario[0]["Nome"];
  $celular = $dadosDoUsusario[0]["celular"];
  $email = $dadosDoUsusario[0]["email"];
  $imgUsuario = $dadosDoUsusario[0]["imgUsuario"];


} else {
  header("Location: ../index.php");
}

function imgUsuario($imgUsuario)
{
  if (strlen($imgUsuario) != 0) {
    echo $imgUsuario;
  } else {
    echo "../img/user-default.jpg";
  }
}

if ($_FILES) {
  $arquivo = $_FILES['img'];
  $resultado = getUserData($id);
  $pathImg = '../img/' . $arquivo['name'];
  if ($resultado[0]["imgUsuario"] == NULL) {
    changeInformation($id, 'imgUsuario', $pathImg);
    move_uploaded_file($arquivo["tmp_name"], $pathImg);
    header("location: perfil.php");

  } else {
    unlink($resultado[0]["imgUsuario"]);
    changeInformation($id, 'imgUsuario', $pathImg);
    move_uploaded_file($arquivo["tmp_name"], $pathImg);
    header("location: perfil.php");
  }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

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

  <title>Perfil - Tec Blog</title>
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
              <li><a class="dropdown-item" href="#">Meu perfil</a></li>
              <li><a class="dropdown-item" href="publicar.php">Publicar</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="exitSession.php"><S></S>Sair</a></li>
            </ul>
          </li>
          <li class="nav-item ml-2">
            <img src="<?php imgUsuario($imgUsuario) ?>" alt="" class="border mt-1" style="width: 30px;">
          </li>

        </ul>

      </div>
    </div>
  </nav>
  <!-- Fim Menu -->

  <div class="container bg-secondary border-white bg-gradient text-light mt-3 px-2 py-2 rounded-4 " id="perfil">
    <div class="img">
      <img src="<?php imgUsuario($imgUsuario) ?>" alt="" class="img-thumbnail">
      <br>
      <p for="">Imagem:</p>
      <form action="perfil.php" method="POST" enctype="multipart/form-data">
        <input type="file" accept="image/*" name="img">
        <div>
          <button class="btn btn-info rounded-4  m-2" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16"
              height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
              <path
                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
            </svg> Alterar imagem</button>
        </div>
      </form>


    </div>
    <div class="conteudo">
      <div class="nome">
        <label for="nome"> Nome:</label>

        <h4>
          <?php echo $nome; ?>
        </h4>

        <div>
          <button class="btn btn-info rounded-4  m-2" onclick="RedefinicaoUsuario(<?php echo $id; ?>,'Nome')"><svg
              xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
              viewBox="0 0 16 16">
              <path
                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
            </svg> Editar Nome</button>

        </div>
      </div>

      <div class="email">
        <label for="email"> Email:</label>

        <h4>
          <?php echo $email; ?>

          <div>
            <button class="btn btn-info rounded-4  m-2" onclick="RedefinicaoUsuario(<?php echo $id; ?>,'email')"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
                viewBox="0 0 16 16">
                <path
                  d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
              </svg> Editar Email</button>
          </div>

        </h4>




      </div>

      <div class="celular">
        <label for="celular">Contato:</label>
        <h4>
          <?php echo $celular; ?>

          <div>
            <button class="btn btn-info rounded-4  m-2" onclick="RedefinicaoUsuario(<?php echo $id; ?>,'celular')"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
                viewBox="0 0 16 16">
                <path
                  d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
              </svg>Editar contato</button>
          </div>

        </h4>

      </div>









      <div class="senha">
        <label for="celular">Senha:</label>
        <br>

        <button class="btn btn-warning  btn-block mx-4" onclick="RedefinicaoUsuario(<?php echo $id; ?>,'senha')">Alterar
          minha senha</button>
      </div>
    </div>

  </div>

</body>

</html>