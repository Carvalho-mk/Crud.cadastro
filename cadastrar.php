<?php
include "conexao.php";
$nome =  $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$aniversario = $_POST['aniversario'];
 /* //Inserção Usando Mysqli
 $sql = "INSERT INTO pessoa (nome, sobrenome, aniversario) VALUES ('$nome','$sobrenome','$aniversario')";
   if (mysqli_query($conn,$sql)) {echo "cadastrador";
   }else {echo "falha ao cadastrar".mysqli_error($conn);
 }
 */
 try {
  $stmt = $pdo->prepare('INSERT INTO pessoa (nome, sobrenome, aniversario) VALUES(:nome,:sobrenome,:aniversario)');
  $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
  $stmt->bindValue(':sobrenome', $sobrenome, PDO::PARAM_STR);
  $stmt->bindValue(':aniversario', $aniversario, PDO::PARAM_STR);
  $stmt->execute();
  if($stmt->rowCount() > 0){
    setcookie("systemInfo", "Cadastro Realizado Com Sucesso!", time()+5, "/");
  }else{
    setcookie("errorInfo", "Erro Ao Inserir Registro", time()+5, "/");
  }
  if($_SERVER["REMOTE_ADDR"] == "::1"){
    header("Location: ../empresa/");
  }else{
    header("Location: ../");
  }
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
