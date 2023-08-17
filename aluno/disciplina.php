<?php require_once '../inc/config.php';
require_once DBAPI;
include (HEAD_TEMPLATE); 
$db=open_database();
session_start();

$tipousuario= $_SESSION['tipo-usuario'];
if (isset($_GET['id'])){
  $IDCurso = $_GET['id'];
}

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
      <a class="navbar-brand" href="homeAL.php" id="navbarNav">Etecademy</a>
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
      <div class="col-md-12 col-lg-12 col-sm-6  d-block d-md-block" style="height:80px">
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Disciplinas</h2>
    </div>
   
      </div>
      <div class="row g-0">
        <div class="table-responsive">
        <table style="border-radius: 20px;" class="table table-hover text-center"id="tabelamenu">
        
          <?php 
              $resultDisciplina = "SELECT ID_Disciplina,Nome_Disciplina FROM disciplina d
              INNER JOIN curso c ON d.ID_Curso_FK = c.ID_Curso
              WHERE ID_Curso_FK =  " . $IDCurso . "" ; 
              $query2 = mysqli_query($db,$resultDisciplina); 

          ?>
          <?php while($dado2 = mysqli_fetch_array($query2)){?>
            <tr>
              <td scope=<?php echo $dado2['ID_Disciplina'];?>>
              <a href="arquivos.php?id_disciplina=<?php echo $dado2['ID_Disciplina'];?>" style="font-size: 18px;" class="link-secondary">
              <?php echo $dado2['Nome_Disciplina'];?>
              </a>
            </td>
            </tr>            
          <?php }?>
        </table>
        </div>
           <a href='homeAL.php' class='btn btn-dark' role='button' aria-pressed='true' style='width: 10rem;margin: 0 auto;'>Voltar</a>
      </div>
    </div>
  </div>
</div>
</div>
</body>

