<?php
include 'conn.php';

session_start();


if (isset($_GET["id"])) {
  $idArtigo = $_GET["id"];
  $_SESSION["idVisualizar"] = $idArtigo;

} else {
  $idArtigo = $_SESSION["idVisualizar"];

}
$resultado = getArticleData($idArtigo);

?>