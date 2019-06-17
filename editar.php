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

	if (isset($_GET['matricula'])){
	$matricula = $_GET['matricula'];			
	$sql = "SELECT * FROM tabela_professores WHERE matricula = ?";
	$busca = $conexao->prepare($sql);
	$busca->bindParam(1,$matricula);
	$busca->execute();
	$registro = $busca->fetch(PDO::FETCH_ASSOC);
	}
	if (isset($_POST['atualizar'])){
		try{	
			$matricula = $_POST['matricula'];
			$nome = $_POST['nome'];
			$email = $_POST['email'];
			$tel = $_POST['tel'];
			$cel = $_POST['cel'];
			$data = $_POST['data'];
			$valor = $_POST['valor'];
			$arquivo = $_FILES['arquivo'];
			$nome_img = $_FILES['arquivo']['name'];
			$extensao = explode(".",$nome_img);
			$nome_final = md5(time()).".".$extensao[1];
			$pasta = "fotos/";
			
			$sql = "UPDATE tabela_professores SET nome = ?,email = ?,telefone = ?,celular = ?,data = ?,valor = ?,foto = ? WHERE matricula='$matricula'";
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(1,$nome);
			$stmt->bindParam(2,$email);
			$stmt->bindParam(3,$tel);
			$stmt->bindParam(4,$cel);
			$stmt->bindParam(5,$data);
			$stmt->bindParam(6,$valor);
			$stmt->bindParam(7,$nome_final);
			$resultado = $stmt->execute();
			if ($resultado && move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final)){
				echo "<script>alert('Dados atualizados com sucesso!');</script>";
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
<main>
	<section class="bg1">
		<fieldset id="pelicula">
			<legend class="fonte1">Registro de contibuição</legend>
	        <form action="#" method="post" enctype="multipart/form-data" class="fonte2">
	            <p><label >Número da matrícula:</label></p>
	            <p><input type="number" name="matricula" required value="<?php echo $registro['matricula'];?>" readonly></p>
	            <p><label >Nome do professor:</label></p>
	            <p><input type="text" size="50" name="nome" required placeholder="Nome completo" value="<?php echo $registro['nome'];?>"></p>
	            <p><label >Email:</label></p>
	            <p><input type="text" size="50" name="email" required placeholder="asd@asd.com" value="<?php echo $registro['email'];?>"></p>
	            <p><label >Telefone:</label>
	            <input type="text" size="12" name="tel" required placeholder="(xx)1234-1234" value="<?php echo $registro['telefone'];?>">
	            <label >Celular:</label>
	            <input type="text" size="12" name="cel" required placeholder="(xx)91234-1234" value="<?php echo $registro['celular'];?>"></p>
	            <p><label >Data:</label></p>
	            <p><input type="date" name="data" required value="<?php echo $registro['data'];?>"></p>
	            <p><label >Valor da contribuição:</label></p>
	            <p><input type="text" name="valor" required placeholder="Apenas números" value="<?php echo $registro['valor'];?>"></p>
                <p><label class="fonte2">Selecione uma imagem</label>
                <p><img src="fotos/<?php echo $registro['foto'];?>" class="foto" id="vizualizar_imagem"></p><br><br>
                <input type="file" name="arquivo" id="arquivo"></p>
                <script>
                	function carregaImagem()
					{
						if (this.files && this.files[0])
						{
							var file = new FileReader();
							file.onload = function(e)
							{
								document.getElementById("vizualizar_imagem").src = e.target.result;
							};	
							file.readAsDataURL(this.files[0]);
						}
					}
					document.getElementById("arquivo").addEventListener("change",carregaImagem, false);
                </script>
	            <button type="submit" name="atualizar" class="btn fonte3">Atualizar</button>
	        </form>
		</fieldset>
	</section>
</main>
<footer>
	Design by Adri@ano Virgilio
</footer>

</html>