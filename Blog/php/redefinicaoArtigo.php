<?php

include 'conn.php';

$id = 0;
session_start();
if (isset($_SESSION["id"])) {
  $id = $_SESSION["id"];
  if (isset($_GET["id"])) {
    $idArtigo = $_GET["id"];
    $_SESSION["idArtigo"] = $idArtigo;

  } else {
    $idArtigo = $_SESSION["idArtigo"];
  }


} else {
  echo 'to errado';
  //header("Location: ../index.php");
}



$resultadoArtigo = getArticleData($_SESSION["idArtigo"]);
//titulo do artigo antigo
$tituloAntigoArtigo = $resultadoArtigo[0]["titulo"];

//subtitulo do artigo antigo
$subtituloAntigoArtigo = $resultadoArtigo[0]["subtitulo"];

//texto do artigo antigo
$textoAntigoArtigo = $resultadoArtigo[0]["texto"];

//imagem do artigo antigo
$imgAntigoArtigo = $resultadoArtigo[0]["imgArtigo"];




//backend publicar
if (isset($_POST["titulo"]) or isset($_POST["subtitulo"]) or isset($_POST["texot"]) or isset($_FILES["imgBlog"]["tmp_name"])) {
  if (isset($_POST["titulo"]) && strlen($_POST["titulo"]) != 0) {
    changeArticleInformation($idArtigo, 'titulo', $_POST["titulo"]);

  }
  if (isset($_POST["subtitulo"]) && strlen($_POST["subtitulo"]) != 0) {
    changeArticleInformation($idArtigo, 'subtitulo', $_POST["subtitulo"]);
  }
  if (isset($_POST["texto"]) && strlen($_POST["texto"]) != 0) {
    changeArticleInformation($idArtigo, 'texto', $_POST["texto"]);
  }

  if ($_FILES["imgBlog"]["tmp_name"]) {

    $arquivo = $_FILES['imgBlog'];

    $pathImgBlog = '../imgBlog/' . $arquivo['name'];

    unlink($imgAntigoArtigo);
    changeArticleInformation($idArtigo, 'imgArtigo', $pathImgBlog);
    move_uploaded_file($arquivo["tmp_name"], $pathImgBlog);
    header("Location: minhasPublicacoes.php");
  }
  header("Location: minhasPublicacoes.php");
  //unset($_SESSION["campo"]);
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




  <div class="container text-white p-5 mt-3 w-50 rounded-4" style="background-color: #E1BB32;">
    <div class="">
      <h3>Edição de publicação</h3>
      <form action="redefinicaoArtigo.php" method="post" enctype="multipart/form-data">
        <h6 for="">Título :</h6>
        <input class="form-control " type="text" placeholder="<?php echo $tituloAntigoArtigo; ?>" name="titulo"
          maxlength="200">
        <br>
        <h6>Subtítulo :</h6>

        <input class="form-control " type="text" placeholder="<?php echo $subtituloAntigoArtigo; ?>" name="subtitulo"
          maxlength="400">
        <br>
        <h6 for="">Conteúdo :</h6>

        <textarea name="texto" id="" cols="75" rows="10" maxlength="2000"
          placeholder="<?php echo $textoAntigoArtigo; ?>"></textarea>

        <h6>Imagem para a sua publicação (caso queira mudar a imagem):</h6>
        <div class="py-2">

          <input type="file" accept="image/*" class="custom-file-input" name="imgBlog">
        </div>

        <div class="p-2">
          <button class="btn btn-success btn-lg btn-block" type="submit">Publicar</button>
        </div>

      </form>
    </div>


  </div>



</body>



</html>