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
	<title>Exibir</title>
</head>
<style type="text/css">
	tr:nth-child(even) {
  			background-color: #C7C7C7;
		}
	fieldset{text-align: center; margin: 30px 35%; padding:1em;}
}
</style>
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
			<legend class="fonte1">Escolha a categoria</legend>
			<form action="#" method="get">
				<div>
				<p>Escolha a categoria desejada:</p>
				<label><input name="escolha" type="radio" value="tabela_aluno" required><span>Alunos</span></label>
				<label><input name="escolha" type="radio" value="tabela_professores" required><span>Professores</span></label>
				</div><br>
				<button type="submit" name="enviar">Ver contribuiçoes</button>
			</form>
		</fieldset>
		<?php
		$escolha=$_GET['escolha'];
		if(isset($_GET['enviar'])){
			try{
					$consulta = $con->query("SELECT * FROM $escolha");			
					echo "<table border='1px' align='center'>
						<tr><th colspan='7'>RELATÓRIO</th></tr>
						<tr>
						 <th>Matricula</th>
						 <th>Nome</th>
						 <th>Email</th>
						 <th>Telefone</th>";
						 if($escolha=="tabela_professores"){echo"<th>Celular</th>";}
						 echo"<th>Data</th>
						 <th>Valor</th>
						</tr>";
					while($campo = $consulta->fetch(PDO::FETCH_ASSOC)){
					echo "<tr>";
						echo "<td>".$campo['matricula']."</td>";
						echo "<td>".$campo['nome']."</td>";
						echo "<td>".$campo['email']."</td>";
						echo "<td>".$campo['telefone']."</td>";
						if($escolha=="tabela_professores"){echo "<td>".$campo['celular']."</td>";}
						echo "<td>".implode("/",array_reverse(explode("-",$campo['data'])))."</td>";
						echo "<td>".$campo['valor']."</td>";
					echo "</tr>";	
					}
					echo "</table>";
			}catch(PDOException $e)
			{
				echo "ERRO:".$e->getMessage();
			}
		}
		?>
	</section>
</main>	
<footer>
	Design by Adri@ano Virgilio
</footer>
</body>
</html>