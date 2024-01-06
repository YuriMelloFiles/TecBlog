<?php

include 'conn.php';

$idArtigo = $_GET["id"];

deleteArticle($idArtigo);

header("Location: minhasPublicacoes.php");

?>