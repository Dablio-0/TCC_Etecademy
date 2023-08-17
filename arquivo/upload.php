<?php require_once '../inc/config.php';
require_once DBAPI;
include (HEAD_TEMPLATE); 
$db=open_database();
session_start();

$email = $_SESSION['email'];
$tipousuario =$_SESSION['tipo-usuario']; 


$RelCursoUSuario = "SELECT ID_Rel_Curso_Usuario FROM rel_Curso_Usuario
INNER JOIN rel_etec_curso rec ON ID_Rel_Etec_Curso_FK = rec.ID_Rel_Etec_Curso
INNER JOIN rel_usuario_tipo_usuario rutu ON ID_Rel_Usuario_Tipo_Usuario_FK = rutu.ID_Rel_Usuario_Tipo_Usuario
INNER JOIN usuario u ON ID_Usuario_Fk = u.ID_Usuario
WHERE Email_Institucional ='" . $email . "'";

$query = mysqli_query($db,$RelCursoUSuario);

$row = mysqli_fetch_assoc($query);





if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
  header('location:../index.php');
  }


?>  


 <link rel="stylesheet" href="..\inc\css\styles.css" class="rel">
<link rel="shortcut icon" href="..\inc\images\Logo.jpeg">

<?php

$ArquivosPermitidos = ['docx','doc','pptx','pdf'];

$Arquivos = $_FILES['arquivos'];
$Disciplina = $_POST['disciplina'];
$nomes = $Arquivos['name'];
$upload_dir = '../uploads/';
$dir = 1;
while(file_exists($upload_dir.$dir) and is_dir($upload_dir.$dir)){
  $dir++;
}
mkdir($upload_dir.$dir, 0777);



for($i = 0; $i < count($nomes); $i++):
  $extensao = explode('.',$nomes[$i]);
  $extensao = end($extensao); 

  if(in_array($extensao,$ArquivosPermitidos)):
    $InserirArquivo = "INSERT INTO arquivo(ID_Rel_Curso_Usuario_FK,ID_Disciplina_FK,ID_Status_FK,Caminho,Nome_Arquivo)VALUES
    (".$row['ID_Rel_Curso_Usuario'].",".$Disciplina.",1,'".$upload_dir.$dir."','$nomes[$i]')";
    $query2 = mysqli_query($db,$InserirArquivo);

if(mysqli_affected_rows($db) > 0):
  $mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i],$upload_dir.$dir.'/'.$nomes[$i]);
    $_SESSION['sucesso'] = 'Arquivo(s) enviado(s) com sucesso, aguardando verificação!';
    $destino = header("location:Envios.php");
  endif;

else:
    $_SESSION['erro'] = "Existem arquivos não enviados aguardando permissão para serem publicados.";
    $destino = header("location:Envios.php");
endif;

endfor;


