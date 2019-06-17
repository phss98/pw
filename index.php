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
    	<fieldset id="pelicula3">
		<?php echo "<img src='fotos/$foto' alt='foto' class='foto'> <p class='fonte4'>Bem vindo $user</p>";
		if($tipo == 'adm'){
		echo "<p>Tipo: Administrador</p>";
		}
		else{
		echo "<p>Tipo: Usuário comum</p>";
		}?>
        </fieldset>
	</section>
</main>
<footer>
	Design by Adri@ano Virgilio
</footer>
</body>
</html>