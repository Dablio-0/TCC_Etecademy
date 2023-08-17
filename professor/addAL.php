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
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Contas Pendentes</h2>
    </div>
      </div>
      <div class="row g-0">
      <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
          <th>Email Institucional</th>
          <th>Data Matricula</th>
          <th>Cidade</th>
          <th>Unidade</th>
          <th>Ações</th>
          <th>-</th>
          </tr>
        </thead>
        <tbody>
              <?php 
                $ProcurarCadastro = "SELECT ID_Usuario,ID_Rel_Curso_Usuario,Email_Institucional,Data_Matricula,Unidade,Cidade FROM usuario u
      INNER JOIN rel_usuario_tipo_usuario rutu ON u.id_usuario = rutu.id_usuario_FK
      INNER JOIN rel_curso_usuario rcu ON rutu.ID_Rel_Usuario_Tipo_Usuario = rcu.ID_Rel_Usuario_Tipo_Usuario_FK
      INNER JOIN rel_etec_curso rec ON rcu.id_rel_etec_curso_fk = rec.id_rel_etec_curso
      INNER JOIN etec e ON rec.Cod_Etec_FK = e.Cod_Etec
      WHERE rcu.ativo IS FALSE
      AND rutu.ID_Tipo_FK = 1;";
      $querySearch = mysqli_query($db,$ProcurarCadastro);
                ?>
                <?php while($dado2 = mysqli_fetch_array($querySearch)){?>
          <tr>  
            <td><?php echo $dado2['Email_Institucional'];?></td>
            <td><?php echo date("m:d:Y", strtotime($dado2['Data_Matricula']));?></td>
            <td><?php echo $dado2['Cidade'];?></td>
            <td><?php echo $dado2['Unidade'];?></td>
            <td><form action='' method='POST'>
                  <input type='hidden' value=<?php echo $dado2['ID_Rel_Curso_Usuario'];?> name='ID_Rel_Curso_Usuario'/>
                  <button type="submit" id="AceitarSubmit" name="AceitarSubmit" class="btn btn-dark">Aceitar</button>
                </form></td>
              <td><form action='' method='POST'>
                <input type='hidden' value=<?php echo $dado2['ID_Usuario'];?> name='ID_Usuario'/>
                <button type="submit" id="DeletarSubmit" name="DeletarSubmit" class="btn btn-danger">Deletar</button>
              </form></td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
     <?php   
     if (isset($_POST['AceitarSubmit'])) {
      $AceitarPerfil =  $_POST['ID_Rel_Curso_Usuario'];
      $Editar = "UPDATE rel_curso_usuario SET Ativo = 1 WHERE ID_Rel_Curso_Usuario =".$AceitarPerfil."";
      $query2 = $db->query($Editar);  
      }
     if(isset($_POST['DeletarSubmit'])){
      $DeletarPerfil = $_POST['ID_Usuario'];
      $Deletar = "DELETE FROM usuario WHERE ID_Usuario =".$DeletarPerfil."";
      $query3 = $db->query($Deletar);
     }
  
    ?>