<?php
	if (isset($_POST['cadastrar'])){
		try{
			$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');	
					
			$user = $_POST['user'];
			$senha = $_POST['senha'];
			$nome = $_POST['nome'];
			$tipo = $_POST['tipo'];
			$senha_cripto = md5($senha);
			$arquivo = $_FILES['arquivo'];
			$nome_img = $_FILES['arquivo']['name'];
			$extensao = explode(".",$nome_img);
			$nome_final = md5(time()).".".$extensao[1];
			$pasta = "fotos/";
			
			$sql = "INSERT INTO tabela_usuario (user,senha,nome,tipo,foto) VALUES (?,?,?,?,?)";
			
			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(1,$user);
			$stmt->bindParam(2,$senha_cripto);
			$stmt->bindParam(3,$nome);
			$stmt->bindParam(4,$tipo);
			$stmt->bindParam(5,$nome_final);
			$resultado = $stmt->execute();
			
			if ($resultado && move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final)){
				echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
				echo "<script>location.href='index.html'</script>";	
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
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" type="text/css" href="css/estilo_do_menu.css">
<title>Cadastrar</title>
</head>
<body class="bg">
	<fieldset id="pelicula2">
		<legend class="fonte1">Formulário de Cadastro</legend>
	    <form action="cadastrar.php" method="post" enctype="multipart/form-data">
	        <div>
				<label class="fonte2">Usuário:</label><br>
				<input type="text" name="user" size="20" required>
			</div>
	        <div>
				<label class="fonte2">Senha:</label><br>
				<input type="password" name="senha" size="20" required>
			</div>
	        <div>
				<label class="fonte2">Nome:</label><br>
				<input type="text" name="nome" size="20" required>
			</div>
	        <div>
				<label class="fonte2">Tipo de usuário:</label><br>
                <select name="tipo" class="alinhamento" required>
                    <option value="#" selected disabled>Selecione o tipo</option>
                    <option value="adm">Administrador</option>
    	            <option value="us">Comum</option>
                </select>
			</div><br>
            <div>
            	<label class="fonte2">Selecione uma imagem</label><br><br>
                <input type="file" name="arquivo"><br><br>
            </div>
	           <button type="submit" name="cadastrar" class="btn fonte3">Confirmar</button>
	       </form>
	</fieldset>
</body>
</html>