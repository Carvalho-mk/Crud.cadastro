<?php
require_once("./conexao.php");
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteRecord'])){
	$deleteID = $_POST['deleteRecord'];
	$sql = "DELETE FROM pessoa WHERE id = :id";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":id", $deleteID, PDO::PARAM_INT);
	$stmt->execute();
	if($stmt->rowCount() > 0){
		setcookie("systemInfo", "Registro Deletado Com Sucesso!", time()+5, "/");
	}else{
		setcookie("errorInfo", "Erro Ao Deletar Registro", time()+5, "/");
	}
	if($_SERVER["REMOTE_ADDR"] == "::1"){
		header("Location: ../empresa/");
	}else{
		header("Location: ../");
	}
}
?>