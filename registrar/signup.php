<?php 
require_once '../inc/config.php';
require_once DBAPI;
include(HEAD_TEMPLATE);

$db= open_database();
session_start();
?>


<?php
$email=$_POST['email'];
$senha= sha1($_POST['senha']);
$codEtec=$_POST['codigo-etec'];
$tipocurso=$_POST['tipo-curso'];
$modulo=$_POST['tipo-modulo'];
?>

<?php

if(isset($_POST['botao-login'])){

    $insertUser = "INSERT INTO usuario(Email_Institucional,Senha)VALUES('" . $email . "', '" . $senha . "')";
    $query1 = mysqli_query($db, $insertUser);

    $lastId = $db->insert_id;
              
    $insertTypeUser = "INSERT INTO rel_usuario_tipo_usuario(ID_Tipo_FK,ID_Usuario_FK)VALUES(1, '" . $lastId . "')";
    $query2 = mysqli_query($db, $insertTypeUser);


    $lastId2 = $db->insert_id;
    

    $InsertUserCurso= "INSERT INTO rel_curso_usuario(ID_Rel_Etec_Curso_FK,ID_Rel_Usuario_Tipo_Usuario_FK,Data_Matricula,Modulo,Ativo) 
    VALUES((SELECT ID_Rel_Etec_Curso FROM rel_etec_curso WHERE Cod_Etec_FK = " . $codEtec . "  AND ID_Curso_FK = " . $tipocurso . " )," . $lastId2 . ", CURDATE()," . $modulo . ",FALSE)";

   $query3 = mysqli_query($db, $InsertUserCurso);


}
if($query3 == 1){
    $_SESSION['criado_registro'] = true;
    header("Location: ../index.php");
    
}else{
    $_SESSION['email_existente'] = true;
	header('Location: registra.php');
	exit();
}
 ?>
