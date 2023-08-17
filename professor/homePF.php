<?php require_once '../inc/config.php';
require_once DBAPI;
include (HEAD_TEMPLATE); 
$db=open_database();
session_start();

$email = $_SESSION['email'];
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
  header('location:../index.php');
  }


?>

<link rel="stylesheet" href="..\inc\css\styles.css" class="rel">
<link rel="shortcut icon" href="..\inc\images\Logo.jpeg">
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="homePF.php" id="navbarNav">Etecademy</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">  <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../login/logout.php" id="navbarNav">Sair</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addAL.php" id="navbarNav">Alunos </a>
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
      <div class="col-md-12 col-lg-12 col-sm-6  d-block d-md-block" style="height:100px">
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Meus cursos</h2>
    </div>
      </div>
      <div class="row g-0">
        <div class="table-responsive">
        <table style="border-radius: 20px;" class="table table-hover text-center"id="tabelamenu">
        <?php 
    
      $result_curso = "SELECT ID_Curso,Nome_Curso FROM curso c 
      INNER JOIN Rel_etec_curso rec ON c.ID_Curso = rec.ID_Curso_FK 
      INNER JOIN Rel_curso_usuario rcu ON rec.ID_Rel_Etec_Curso = rcu.ID_Rel_Etec_Curso_FK 
      INNER JOIN Rel_usuario_tipo_usuario rutu ON rcu.ID_Rel_Usuario_Tipo_Usuario_FK = rutu.ID_Rel_Usuario_Tipo_Usuario 
      INNER JOIN usuario u ON rutu.ID_Usuario_FK = u.ID_Usuario 
      WHERE rcu.ativo IS TRUE 
      AND u.email_institucional = '" . $email . "'"; 
      $query = mysqli_query($db,$result_curso);
      ?>
      <?php while($dado = mysqli_fetch_array($query)){?>
        <tr>
          <td scope=<?php echo $dado['ID_Curso'];?>>
          <a href="disciplina.php?id=<?php echo $dado['ID_Curso'];?>" style="font-size: 18px;" class="link-secondary">
          <?php echo $dado['Nome_Curso'];?>
        </a>
              </td>
              </tr>            
            <?php }?>
          </table>
          </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </body>


