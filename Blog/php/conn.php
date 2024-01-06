<?php

function connection()
{
  $con = new PDO("mysql:host=localhost;dbname=blog", "root", "");
  return $con;

}

function getData($tabela)
{

  $conexao = connection();
  $result = $conexao->query("SELECT * FROM $tabela ORDER BY STR_TO_DATE(dataPublicacao, '%d/%m/%Y') DESC");
  return $result->fetchAll();

}

//login e senha
function getLogin($email, $senha)
{
  $senhaHash = md5(md5(md5($senha)));
  $conexao = connection();
  $result = $conexao->query("SELECT * FROM `usuarios` WHERE `senha` = '$senhaHash' AND `email` = '$email'");
  return $result->fetchAll();


}

//apenas para mudança de senha
function getPassword($id, $senha)
{
  $senhaHash = md5(md5(md5($senha)));
  $conexao = connection();
  $result = $conexao->query("SELECT * FROM `usuarios` WHERE `senha` = '$senhaHash' AND `id` = '$id'");
  return $result->fetchAll();


}

function getUserData($id)
{
  $conexao = connection();
  $result = $conexao->query("SELECT * FROM `usuarios` WHERE `id` = '$id' ");
  return $result->fetchAll();
}

//redefinição de informações do usuario
function changeInformation($id, $coluna, $novoValor)
{
  $conexao = connection();
  $result = $conexao->query("UPDATE `usuarios` SET `$coluna`='$novoValor' WHERE `id` = '$id' ");
  return $result->fetchAll();

}


function insertArticle($autor, $titulo, $subtitulo, $texto, $imgArtigo)
{
  $today = date("d/m/Y");

  // Obtém a conexão PDO
  $conexao = connection();

  // Prepara a declaração SQL com espaços reservados (:placeholders)
  $stmt = $conexao->prepare("INSERT INTO `artigos`(`autor`, `titulo`, `subtitulo`, `texto`, `imgArtigo`, `dataPublicacao`) VALUES (:autor, :titulo, :subtitulo, :texto, :imgArtigo, :today)");

  // Vincula os parâmetros
  $stmt->bindParam(':autor', $autor);
  $stmt->bindParam(':titulo', $titulo);
  $stmt->bindParam(':subtitulo', $subtitulo);
  $stmt->bindParam(':texto', $texto);
  $stmt->bindParam(':imgArtigo', $imgArtigo);
  $stmt->bindParam(':today', $today);

  // Executa a consulta preparada
  $result = $stmt->execute();


}


function getUserArticles($id)
{
  $conexao = connection();
  $result = $conexao->query("SELECT * FROM `artigos` WHERE `autor` = '$id' ");
  return $result->fetchAll();
}


function getArticleData($id)
{
  $conexao = connection();
  $result = $conexao->query("SELECT * FROM `artigos` WHERE `id` = '$id' ");
  return $result->fetchAll();
}




function changeArticleInformation($id, $coluna, $novoValor)
{
  $conexao = connection();
  $result = $conexao->query("UPDATE `artigos` SET `$coluna`='$novoValor' WHERE `id` = '$id' ");
  return $result->fetchAll();

}

function deleteArticle($id)
{
  $conexao = connection();
  $result = $conexao->query("DELETE FROM `artigos` WHERE `id` = '$id' ");
  return $result->fetchAll();

}


?>