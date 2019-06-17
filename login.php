<?php
$con = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');

session_start();
$login = $_POST['login'];
$senha = $_POST['senha'];
$senha_cripto = md5($senha);

$cmd_sql = "SELECT * FROM tabela_usuario where user = ? AND senha = ?";
$busca = $con->prepare($cmd_sql);
$busca->bindParam(1,$login);
$busca->bindParam(2,$senha_cripto);
$busca->execute();
if ($busca->rowCount()>0) {
	$_SESSION['login'] = $login;
	$_SESSION['senha'] = $senha;
	header('location:index.php');
}
else{
	unset($_SESSION['login']);
	unset($_SESSION['senha']);
	header('location:index.html');
}
?>