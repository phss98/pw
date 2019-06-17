<?php
	session_start();
	$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
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
	if (isset($_POST['cadastrar'])){
		try{	
			$matricula = $_POST['matricula'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$tel = $_POST['tel'];
			$cel = $_POST['cel'];
			$data = $_POST['data'];
			$valor = $_POST['valor'];
			$arquivo = $_FILES['arquivo'];
			$extensao = explode(".",$_FILES['arquivo']['name']);
			$nome_final = md5(time()).".".$extensao[1];
			$pasta = "fotos/";
			
			$sql = "INSERT INTO tabela_professores (matricula,nome,email,telefone,celular,data,valor,foto) VALUES (:par1,:par2,:par3,:par4,:par5,:par6,:par7,:par8)";
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(':par1',$matricula);
			$stmt->bindParam(':par2',$nome);
			$stmt->bindParam(':par3',$email);
			$stmt->bindParam(':par4',$tel);
			$stmt->bindParam(':par5',$cel);
			$stmt->bindParam(':par6',$data);
			$stmt->bindParam(':par7',$valor);
			$stmt->bindParam(':par8',$nome_final);
			$resultado = $stmt->execute();
			if ($resultado && move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final)){
				echo "<script>alert('Dados gravados com sucesso!');</script>";
				echo "<script>location.href='form_cadastro_prof.php'</script>";	
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
<title>Formulário de cadastro de professor</title>
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
	        <form action="#" method="post" class="fonte2" enctype="multipart/form-data">
	            <p><label >Número da matrícula:</label></p>
	            <p><input type="number" name="matricula" required></p>
	            <p><label >Nome do professor:</label></p>
	            <p><input type="text" size="50" name="nome" required placeholder="Nome completo"></p>
	            <p><label >Email:</label></p>
	            <p><input type="text" size="50" name="email" required placeholder="asd@asd.com"></p>
	            <p><label >Telefone:</label>
	            <input type="text" size="12" name="tel" required placeholder="(xx)1234-1234">
	            <label >Celular:</label>
	            <input type="text" size="12" name="cel" required placeholder="(xx)91234-1234"></p>
	            <p><label >Data:</label></p>
	            <p><input type="date" name="data" required></p>
	            <p><label >Valor da contribuição:</label></p>
	            <p><input type="text" name="valor" required placeholder="Apenas números"></p>
                <p><label class="fonte2">Selecione uma imagem</label><br><br>
                <input type="file" name="arquivo"></p>
	            <button type="submit" name="cadastrar" class="btn fonte3">Confirmar</button>
	        </form>
		</fieldset>
	</section>
</main>
<footer>
	Design by Adri@ano Virgilio
</footer>

</html>