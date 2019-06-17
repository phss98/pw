<?php
$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
	session_start();
	if((!isset($_SESSION['login'])== true) and (!isset($_SESSION['senha'])== true))
	{
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:index.html');
	}
	$usuario = $_SESSION['login'];
	$consulta = $conexao->query("SELECT * FROM tabela_usuario where user = '$usuario'");
	while($campo = $consulta->fetch(PDO::FETCH_ASSOC)){
		$user = $campo['user'];
		$tipo = $campo['tipo'];
		$foto = $campo['foto'];
	}
	if (isset($_GET['cadastrar'])){
		try{			
			$matricula = $_GET['matricula'];
			$nome = $_GET['nome'];
			$email = $_GET['email'];
			$tel = $_GET['tel'];
			$data = $_GET['data'];
			$valor = $_GET['valor'];
			$sql = "INSERT INTO tabela_aluno (matricula,nome,email,telefone,data,valor) VALUES (:par1,:par2,:par3,:par4,:par5,:par6)";
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(':par1',$matricula);
			$stmt->bindParam(':par2',$nome);
			$stmt->bindParam(':par3',$email);
			$stmt->bindParam(':par4',$tel);
			$stmt->bindParam(':par5',$data);
			$stmt->bindParam(':par6',$valor);
			$resultado = $stmt->execute();
			if ($resultado){
				echo "<script>alert('Dados gravados com sucesso!');</script>";
				echo "<script>location.href='form_cadastro.php'</script>";	
			}
			else{
				echo var_dump($stmt->errorInfo());	
			}
		}catch(PDOException $e){
			echo "ERRO:".$e->getMessage();
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="css/estilo.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/estilo_do_menu.css">
<script type="text/javascript" src="js/funcoes.js"></script>
<title>Formulário de cadastro de alunos</title>
</head>
<style type="text/css">
	.bg1{
	background-image:url(img/bg1.jpg);
	background-size:cover;
	background-repeat:no-repeat;
	align-content: center;	
	border-radius: 5px;
	padding: 0px 0px 10px 0px;
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
	<section class="bg1">
		<fieldset id="pelicula">
			<legend class="fonte1">Registro de contibuição</legend>
	        <form action="#" method="get" class="fonte2">
	            <p><label >Número da matrícula:</label></p>
	            <p><input type="number" name="matricula" required></p>
	            <p><label >Nome do aluno:</label></p>
	            <p><input type="text" size="50" name="nome" required placeholder="Nome completo"></p>
	            <p><label >Email:</label></p>
	            <p><input type="text" size="50" name="email" required placeholder="asd@asd.com"></p>
	            <p><label >Telefone:</label></p>
	            <p><input type="text" size="14" name="tel" required placeholder="(xx)1234-1234"></p>
	            <p><label >Data:</label></p>
	            <p><input type="date" name="data" required></p>
	            <p><label >Valor da contribuição:</label></p>
	            <p><input type="text" name="valor" required placeholder="Apenas números"></p>
	            <button type="submit" name="cadastrar" class="btn fonte3">Confirmar</button>
	        </form>
		</fieldset>
	</section>
</main>
<footer>
	Design by Adri@ano Virgilio
</footer>
</body>
</html>