<?php 
require_once '../inc/config.php';
require_once DBAPI;
include(HEAD_TEMPLATE);
?>


<?php $db= open_database(); 
session_start();
$email= $_SESSION['email'];
$senha= $_SESSION['senha'];
$tipousuario= $_SESSION['tipo-usuario'];
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
  header('location:../index.php');
  }


?>

<?php  $ProcurarPerfil=" SELECT Email_Institucional,Data_Matricula,Modulo,Unidade FROM usuario u
INNER JOIN rel_usuario_tipo_usuario rutu ON u.id_usuario = rutu.id_usuario_FK
INNER JOIN rel_curso_usuario rcu ON rutu.ID_Rel_Usuario_Tipo_Usuario = rcu.ID_Rel_Usuario_Tipo_Usuario_FK
INNER JOIN rel_etec_curso rec ON rcu.id_rel_etec_curso_fk = rec.id_rel_etec_curso
INNER JOIN etec e ON rec.Cod_Etec_FK = e.Cod_Etec
WHERE rcu.ativo IS TRUE
AND u.email_institucional ='" . $email . "'";
 ?>


   <?php $ResultPerfil = mysqli_query($db,$ProcurarPerfil); ?>

   <link rel="stylesheet" href="..\inc\css\styles.css" class="rel">
   <link rel="shortcut icon" href="..\inc\images\Logo.jpeg">
    
    <?php if($tipousuario == 2){ ?>
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
      <a class="navbar-brand" href="../professor/homePF.php" id="navbarNav">Etecademy</a>
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
            <a class="nav-link" href="../professor/addAL.php" id="navbarNav">Alunos </a>
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
<?php } else{ ?>
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
    <?php } ?>

<body style="background-image: linear-gradient(to bottom, #3f0071, #2a1866, #1d1f57, #1a2244, #1e2230);">
<div class="container py-5 " >
<div class="row d-flex justify-content-center">
  <div class="col col-xl-9">
    <div class="card"  id="cardAL" style="border-radius: 2rem;margin-top:30;">
    <h2 class="mb-2 mt-4 pb-1 pb-md-2 mb-md-2 " id="cursos">Minhas Informações</h2>
<div class="table-responsive">
    <table id="tabelaperfil" class="table">
    <thead class="table">
        <tr>
            <th>Email Institucional</th>
            <th>Etec</th>
        </tr>
    </thead>
        <?php while($row = mysqli_fetch_array($ResultPerfil)) : ?>
            <tbody>
            <tr>
         <td><?= $row['Email_Institucional']?></td>
         <td><?= $row['Unidade'] ?></td>
            </tr>
            <tr>
            <th>Modulo</th>
            <th>Data da Criação</th>
        </tr>
        <tr>
         <td><?= $row['Modulo'] ?></td>
         <td><?= date("m:d:Y", strtotime($row['Data_Matricula'])); ?></td>
         </tr>
           </tbody>
           <?php endwhile; ?>
    </table>
  
</div>

</body>

