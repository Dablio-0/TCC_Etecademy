<?php require_once '../inc/config.php';
require_once DBAPI;
include (HEAD_TEMPLATE); 
$db=open_database();
session_start();

$email = $_SESSION['email'];
$tipousuario =$_SESSION['tipo-usuario']; 

if (isset($_GET['id_disciplina'])){
  $Disciplina = $_GET['id_disciplina'];
}


$IDCurso = "SELECT ID_Curso_FK FROM usuario u
INNER JOIN rel_usuario_tipo_usuario rutu ON u.id_usuario = rutu.id_usuario_FK
INNER JOIN rel_curso_usuario rcu ON rutu.ID_Rel_Usuario_Tipo_Usuario = rcu.ID_Rel_Usuario_Tipo_Usuario_FK
INNER JOIN rel_etec_curso rec ON rcu.id_rel_etec_curso_fk = rec.id_rel_etec_curso
INNER JOIN etec e ON rec.Cod_Etec_FK = e.Cod_Etec
WHERE rcu.ativo IS TRUE
AND Email_Institucional ='" . $email . "'";

$query5 = mysqli_query($db,$IDCurso);

$row2 = mysqli_fetch_assoc($query5);



if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
  header('location:../index.php');
  }


?>  


 <link rel="stylesheet" href="..\inc\css\styles.css" class="rel">
<link rel="shortcut icon" href="..\inc\images\Logo.jpeg">

    <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="../aluno/homeAL.php" id="navbarNav">Etecademy</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">   <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../login/logout.php" id="navbarNav">Sair</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../arquivo/Envios.php" id="navbarNav">Meus Envios</a>
          </li>
          <li class="nav-item">
            <a href="../menu/perfil.php">
          <i style="color: #EEEEEE;"  class="fa-sharp fa-solid fa-user-gear fa-2x" ></a></i>
        </li>
        </ul>
      </div>
    </div>
  </nav>

<body style="background-image: linear-gradient(to bottom, #3f0071, #2a1866, #1d1f57, #1a2244, #1e2230);">

<div class="container py-5 " >
<div class="row d-flex justify-content-center">
  <div class="col col-xl-10">
    <div class="card"  id="cardAL" style="border-radius: 2rem;margin-top:50;">
      <div class="row g-0">
      <div class="col-md-12 col-lg-12 col-sm-6  d-block d-md-block" style="height: 100px">
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Arquivos</h2>
      </div>
       <div class="table-responsive" >
      <table class="table table-hover">
        <thead>
          <tr>
          <th>Nome do Arquivo</th>
          <th>Disciplina</th>
          <th>Status</th>
          <th>Modulo</th>
          <th>Baixar</th>
          </tr>
        </thead>
        <tbody>
        <?php 
                    $VerArquivo = "SELECT ID_Arquivo,Nome_Arquivo,Nome_Disciplina,Tipo_Status,Modulo FROM arquivo
                    INNER JOIN disciplina d ON ID_Disciplina_FK = d.ID_Disciplina
                    INNER JOIN rel_curso_usuario rcu ON ID_Rel_Curso_Usuario_FK = rcu.ID_Rel_Curso_Usuario
                    INNER JOIN arquivo_status ArS ON ID_Status_FK = ArS.ID_Status
                    INNER JOIN rel_usuario_tipo_usuario rutu ON ID_Rel_Usuario_Tipo_Usuario_FK = rutu.ID_Rel_Usuario_Tipo_Usuario
                    INNER JOIN usuario u ON ID_Usuario_FK = u.ID_Usuario
                    WHERE Tipo_Status = 'Liberado'
                    AND ID_Disciplina_FK =  " . $Disciplina . "
                    ORDER BY Modulo";
                  $querySearch = mysqli_query($db,$VerArquivo) or die(mysqli_error($db));
            
                    ?>
                <?php while($row = mysqli_fetch_array($querySearch)){?>
          <tr>  
            <td><?php echo $row['Nome_Arquivo'];?></td>
            <td><?php echo $row['Nome_Disciplina'];?></td>
            <td><?php echo $row['Tipo_Status'];?></td>
            <td><?php echo $row['Modulo'];?></td>
            <td><a href="../arquivo/download.php?file_id=<?php echo $row['ID_Arquivo']?>"><button type="submit" name="download" id="download" class="btn btn-dark">Download</button></a></td>
          </tr>
        </tbody>
        <?php }?>

      <?php  
      if (isset($_POST['ArquivoSend'])) {
      $AceitarPerfil =  $_POST['ID_Rel_Curso_Usuario'];
      $Editar = "UPDATE rel_curso_usuario SET Ativo = 1 WHERE ID_Rel_Curso_Usuario =".$AceitarPerfil."";
      $query2 = $db->query($Editar);  
      }
    

      ?>
      </table>
    </div>
      </div>  
      <div style="margin: 0 auto;" >
           <a href='disciplina.php?id=<?php echo $row2['ID_Curso_FK']?>' class='btn btn-dark' role='button' aria-pressed='true' style='width: 10rem'>Voltar</a>
      </div>