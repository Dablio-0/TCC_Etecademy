<?php

require_once '../inc/config.php'; 
require_once DBAPI;
$db= open_database();
session_start();



$email = mysqli_real_escape_string($db, $_POST['email']);
$senha = mysqli_real_escape_string($db, sha1($_POST['senha']));
$codetec = mysqli_real_escape_string($db, $_POST['codigo-etec']);
$tipousuario = mysqli_real_escape_string($db, $_POST['tipo-usuario']);


$query = "SELECT 1 FROM usuario u
INNER JOIN rel_usuario_tipo_usuario rutu ON u.id_usuario = rutu.id_usuario_FK
INNER JOIN rel_curso_usuario rcu ON rutu.ID_Rel_Usuario_Tipo_Usuario = rcu.ID_Rel_Usuario_Tipo_Usuario_FK
INNER JOIN rel_etec_curso rec ON rcu.id_rel_etec_curso_fk = rec.id_rel_etec_curso
INNER JOIN etec e ON rec.Cod_Etec_FK = e.Cod_Etec
WHERE rcu.ativo IS TRUE
AND u.email_institucional = '{$email}'
AND u.senha = '{$senha}'
AND e.cod_etec = '{$codetec}'
AND rutu.id_tipo_fk = '{$tipousuario}'";

$result = mysqli_query($db, $query);

$row = mysqli_num_rows($result);

if($row == 1 && $tipousuario == 1) {
	
	$_SESSION['email'] = $email;
	$_SESSION['senha'] = $senha;
	$_SESSION['codigo-etec'] = $codetec;
	$_SESSION['tipo-usuario'] = $tipousuario;
	header('Location: ../aluno/homeAL.php');
	exit();
} elseif ($row == 1 && $tipousuario == 2){
	$_SESSION['email'] = $email;
	$_SESSION['senha'] = $senha;
	$_SESSION['codigo-etec'] = $codetec;
	$_SESSION['tipo-usuario'] = $tipousuario;
	header('Location: ../professor/homePF.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: ../index.php');
	exit();
}