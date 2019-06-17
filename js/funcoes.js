function confirmacaoSair() {
     var resposta = confirm("Deseja encerrar a sessão?");
     if (resposta == true) {
          location.href = "logout.php";
     }
}