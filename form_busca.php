<?php
$con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
session_start();
if((!isset($_SESSION['login'])== true) and (!isset($_SESSION['senha'])== true))
{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location:index.html');
}
$usuario = $_SESSION['login'];
$consulta = $con->query("SELECT * FROM tabela_usuario where user = '$usuario'");
while($campo = $consulta->fetch(PDO::FETCH_ASSOC)){
	$user = $campo['user'];
	$tipo = $campo['tipo'];
	$foto = $campo['foto'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/estilo_do_menu.css">
    <script type="text/javascript" src="js/funcoes.js"></script>
</head>
<body>
<header>
	<img src="img/logo_etec_2019.png">
</header>
<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
        <?php
		if($tipo == 'adm'){
		echo "<li><a href='form_cadastro_prof.php'>Cadastrar professor</a></li>
		<li><a href='form_cadastro.php'>Cadastrar aluno</a></li>
		<li><a href='form_busca.php'>Buscar</a></li>";
		}
		?>
		<li><a href='exibir.php'>Exibir</a></li>	
        <li><a href="javascript:func()" onclick="confirmacaoSair()">Sair</a></li>
	</ul>
</nav>
<main>
	<section>
    <fieldset>
    <legend>Formulário de Pesquisa</legend>
	<form action="#" method="get">
    <p><label>Digite o nome do professor que deseja buscar:</label></p>
 	<p><input type="text" name="valor_de_busca" size="50" required> </p>
 	<p><input type="submit" name="buscar" value="Pesquisar"></p>
    </form>
    <?php
		if(isset($_GET['buscar']))
		{
			$valor = $_GET['valor_de_busca'];
			try
			{
			$con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');			
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$comando_sql = "SELECT * FROM tabela_professores WHERE nome LIKE '%$valor%'";
			$consulta = $con->query($comando_sql);
			print "<p>Resultado:</p>";
			while($registro = $consulta->fetch(PDO::FETCH_ASSOC))
				{
					print "<p>
					    {$registro['matricula']} - {$registro['nome']} - {$registro['email']} - {$registro['telefone']} - {$registro['celular']} - {$registro['data']} - {$registro['valor']} - <img src='fotos/{$registro['foto']}' alt='Foto' class='foto'>
						<a href=\"javascript:func()\" onclick=\"confirmacao('{$registro['matricula']}')\"><img src='Img/lixeira.png' title='Excluir registro'></a>
						<a href='editar.php?matricula={$registro['matricula']}'><img src='Img/editar.png' title='editar registro'></a>								
					    </p>";
					}										
				}
				catch(PDOException $e)
				{
					print "Erro ocorrido:" . $e->getMessage();					
				}	
		}else if(isset($_GET['excluir']))
		{	
			$matricula = $_GET['matricula'];
			$con = new PDO('mysql:host=localhost:3307;
			dbname=banco_apm','root','usbw');		
			$comando_sql = "DELETE FROM tabela_professores WHERE 
			matricula = :valor";
			$stmt = $con->prepare($comando_sql);
			$stmt->bindParam(':valor',$matricula);
			$stmt->execute();
			$rs = $stmt->rowCount();	
			if($rs)
			{
				echo "<script>alert('Registro apagado com sucesso!');</script>";	
			}else{
				echo "<script>alert('Não foi possível excluir!');</script>";		
			}			
		}
	?>    
    
    <script language="Javascript">
	function confirmacao(id) {
		 var resposta = confirm("Deseja remover esse registro?");
	 
		 if (resposta == true) {
			  window.location.href = "form_busca.php?excluir&matricula="+id;
		 }
	}
</script>
    </fieldset>
	</section>
</main>
<footer>
	Design by Adri@ano Virgilio
</footer>
</body>
</html>