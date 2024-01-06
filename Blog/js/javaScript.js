//Função para alterar nome,email ou contato
function RedefinicaoUsuario(id,campo){
  window.location.href ="../php/redefinicaoUsuario.php?campo="+campo;
  
}


function RedefinicaoArtigo(idPost){
  window.location.href ="redefinicaoArtigo.php?id="+idPost;
  
}



function ExcluirOArtigo(idPost){

  if (window.confirm("Tem certeza que deseja excluir esta postagem?")) {
    window.location.href ="deletarArtigo.php?id="+idPost;
  }
  else{
    window.location.href ="minhasPublicacoes.php";
  }
  
  
}


function f(){
  console.log("div clicada!");
}

document.querySelector("#imgDaPub1").addEventListener("click", f);
