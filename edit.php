<?php
require_once("./conexao.php");
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newName']) && isset($_POST['newSurname']) && isset($_POST['newBirthday']) && isset($_POST['recordID'])){
	$newName = $_POST['newName'];
	$newSurname = $_POST['newSurname'];
	$newBirthday = $_POST['newBirthday'];
	$recordID = $_POST['recordID'];
	try{
		$sql = "UPDATE pessoa SET nome = :nome, sobrenome = :sobrenome, aniversario = :aniversario WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nome', $newName, PDO::PARAM_STR);
		$stmt->bindValue(':sobrenome', $newSurname, PDO::PARAM_STR);
		$stmt->bindValue(':aniversario', $newBirthday, PDO::PARAM_STR);
		$stmt->bindValue(':id', $recordID, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			setcookie("systemInfo", "Update Realizado Com Sucesso!", time()+5, "/");
		}else{
			setcookie("errorInfo", "Erro Ao Atualizar Registro", time()+5, "/");
		}
		if($_SERVER["REMOTE_ADDR"] == "::1"){
			header("Location: ../empresa/");
		}else{
			header("Location: ../");
		}
	}catch(PDOException $e){
		echo "Error: ".$e->getMessage();
	}
}
?>