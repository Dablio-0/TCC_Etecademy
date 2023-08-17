<?php require_once '../inc/config.php';
require_once DBAPI;
include (HEAD_TEMPLATE); 
$db=open_database();
session_start();

$email = $_SESSION['email'];
$tipousuario =$_SESSION['tipo-usuario']; 


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
            <a class="nav-link" href="Envios.php" id="navbarNav">Meus Envios</a>
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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">    <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../login/logout.php" id="navbarNav">Sair</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Envios.php" id="navbarNav">Meus Envios</a>
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
   



<?php if($tipousuario == 1){?>
  <body style="background-image: linear-gradient(to bottom, #3f0071, #2a1866, #1d1f57, #1a2244, #1e2230);">
<div class="container py-5 " >
<div class="row d-flex justify-content-center">
  <div class="col col-xl-10">
    <div class="card"  id="cardAL" style="border-radius: 2rem;margin-top:50;">
      <div class="row g-0">
      <div class="col-md-12 col-lg-12 col-sm-6  d-block d-md-block" style="height: 100px">
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Meus envios</h2>
      </div>
        <div class="col-md-12 col-lg-12 col-sm-6 d-block d-md-block text-center" style="height: 60px;">
       <form action='upload.php' method='POST' enctype="multipart/form-data">
                <input type='file' name="arquivos[]"  style="width: 8.8remm;padding-bottom: 10px" multiple required/>
               <select class="form-select" name="disciplina" id="disciplina" style="width: 14rem; margin:0 auto;margin-bottom: 5px;"required>
                <option  selected disabled value >Selecione a Disciplina</option>
                <?php 

                $Disciplina = "SELECT ID_Disciplina,Nome_Disciplina FROM disciplina d
                INNER JOIN curso c ON d.ID_Curso_FK = c.ID_Curso
                WHERE ID_Curso_FK = ".$row2['ID_Curso_FK']."";
                $result = $db->query($Disciplina);
                 if($result->num_rows > 0){
                  while ($row = $result->fetch_assoc()){
                    echo '<option value='.$row['ID_Disciplina'].'>'.$row['Nome_Disciplina'].'</option>';
                  }
                 }

                
                ?>
              </select>
                <button type="submit" id="ArquivoSend" name="ArquivoSend" class="btn btn-light" style="border: 1px solid black;"><i class="bi bi-file-earmark-plus-fill"></i>Enviar</button>
              </form>
<?php 
if(isset($_SESSION['erro'])):
  echo  $_SESSION['erro'];
  unset($_SESSION['erro']);
  elseif(isset($_SESSION['sucesso'])):
    echo  $_SESSION['sucesso'];
    unset($_SESSION['sucesso']);
  endif;
    ?>              
        </div>
      </div>
       <div class="table-responsive" style="margin-top:7rem;">
      <table class="table table-hover">
        <thead>
          <tr>
          <th>Nome do Arquivo</th>
          <th>Disciplina</th>
          <th>Status</th>
          <th>Baixar</th>
          </tr>
        </thead>
        <tbody>
        <?php 
                    $VerArquivo = "SELECT ID_Arquivo,Nome_Arquivo,Nome_Disciplina,Tipo_Status FROM arquivo
                    INNER JOIN disciplina d ON ID_Disciplina_FK = d.ID_Disciplina
                    INNER JOIN rel_curso_usuario rcu ON ID_Rel_Curso_Usuario_FK = rcu.ID_Rel_Curso_Usuario
                    INNER JOIN arquivo_status ArS ON ID_Status_FK = ArS.ID_Status
                    INNER JOIN rel_Usuario_tipo_usuario rutu ON ID_Rel_Usuario_Tipo_Usuario_FK = rutu.ID_Rel_Usuario_Tipo_Usuario
                    INNER JOIN usuario u ON ID_Usuario_FK = u.ID_Usuario
                    WHERE Email_Institucional ='{$email}'";
                  $querySearch = mysqli_query($db,$VerArquivo) or die(mysqli_error($db));
            
                    ?>
                <?php while($row = mysqli_fetch_array($querySearch)){?>
          <tr>  
            <td><?php echo $row['Nome_Arquivo'];?></td>
            <td><?php echo $row['Nome_Disciplina'];?></td>
            <td><?php echo $row['Tipo_Status'];?></td>
            <?php if($row['Tipo_Status'] == 2){?>
            <td><a href="download.php?file_id=<?php echo $row['ID_Arquivo']?>"><button type="submit" name="download" id="download" class="btn btn-dark">Download</button></a></td>
            <?php }?>
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
  <?php } else{?>
    <body style="background-image: linear-gradient(to bottom, #3f0071, #2a1866, #1d1f57, #1a2244, #1e2230);">
    <div class="container py-5" >
<div class="row d-flex justify-content-center">
  <div class="col col-xl-10">
    <d class="card"  id="cardAL" style="border-radius: 2rem;margin-top:50;">
      <div class="row g-0">
      <div class="col-md-12 col-lg-12 col-sm-12  d-block d-md-block" style="height: 100px">
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Meus envios</h2>
      </div>
      </div>
      <div class="row g-0">
        <div class="col-md-12 col-lg-1 col-sm-12 d-block d-md-block text-center" style="height: 40px;width:100%;">
       <form action='upload.php' method='POST' enctype="multipart/form-data">
                <input type='file' name="arquivos[]"  style="width: 8.8remm;padding-bottom: 10px" multiple required/>
               <select class="form-select" name="disciplina" id="disciplina" style="width: 14rem; margin:0 auto;margin-bottom: 5px;"required>
                <option  selected disabled value >Selecione a Disciplina</option>
                <?php 

                $Disciplina = "SELECT ID_Disciplina,Nome_Disciplina FROM disciplina d
                INNER JOIN curso c ON d.ID_Curso_FK = c.ID_Curso
                WHERE ID_Curso_FK = ".$row2['ID_Curso_FK']."";
                $result = $db->query($Disciplina);
                 if($result->num_rows > 0){
                  while ($row = $result->fetch_assoc()){
                    echo '<option value='.$row['ID_Disciplina'].'>'.$row['Nome_Disciplina'].'</option>';
                  }
                 }

                
                ?>
              </select>
                <button type="submit" id="ArquivoSend" name="ArquivoSend" class="btn btn-light" style="border: 1px solid black;"><i class="bi bi-file-earmark-plus-fill"></i>Enviar</button>
              </form>
<?php 
if(isset($_SESSION['erro'])):
  echo  $_SESSION['erro'];
  unset($_SESSION['erro']);
  elseif(isset($_SESSION['sucesso'])):
    echo  $_SESSION['sucesso'];
    unset($_SESSION['sucesso']);
  endif;
    ?>              
        </div>
      </div>
       <div class="table-responsive" style="margin-top:7rem;">
      <table class="table table-hover">
        <thead>
          <tr>
          <th>Nome do Arquivo</th>
          <th>Disciplina</th>
          <th>Status</th>
          <th>Ações</th>
          <th>-</th>
          </tr>
        </thead>
        <tbody>
        <?php 
                    $VerArquivo = "SELECT ID_Arquivo,Nome_Arquivo,Nome_Disciplina,Tipo_Status FROM arquivo
                    INNER JOIN disciplina d ON ID_Disciplina_FK = d.ID_Disciplina
                    INNER JOIN rel_curso_usuario rcu ON ID_Rel_Curso_Usuario_FK = rcu.ID_Rel_Curso_Usuario
                    INNER JOIN arquivo_status ArS ON ID_Status_FK = ArS.ID_Status
                    INNER JOIN rel_Usuario_tipo_usuario rutu ON ID_Rel_Usuario_Tipo_Usuario_FK = rutu.ID_Rel_Usuario_Tipo_Usuario
                    INNER JOIN usuario u ON ID_Usuario_FK = u.ID_Usuario
                    WHERE Email_Institucional ='{$email}'";
                  $querySearch = mysqli_query($db,$VerArquivo) or die(mysqli_error($db));
            
                    ?>
                <?php while($row = mysqli_fetch_array($querySearch)){?>
          <tr>  
            <td><?php echo $row['Nome_Arquivo'];?></td>
            <td><?php echo $row['Nome_Disciplina'];?></td>
            <td><?php echo $row['Tipo_Status'];?></td>
            <?php if($row['Tipo_Status'] == 'Liberado'){?>
            <td><a href="download.php?file_id=<?php echo $row['ID_Arquivo']?>"><button type="submit" name="download" id="download" class="btn btn-dark">Download</button></a></td>
            <td><form action='' method='POST'>
                <input type='hidden' value=<?php echo $row['ID_Arquivo'];?> name='ID_Arquivo'/>
                <button type="submit" id="DeletarArquivo" name="DeletarArquivo" class="btn btn-danger">Deletar</button>
              </form></td>
            <?php }?>
          </tr>
        </tbody>
        <?php }?>
        </table>
       </div>
       <div class="row g-0">
      <div class="col-md-12 col-lg-12 col-sm-6  d-block d-md-block" style="height: 100px">
      <h2 class="mb-4 mt-4 pb-2 pb-md-2 mb-md-5 " id="cursos">Envios Pendentes</h2>
      </div>
        <div class="table-responsive" >
      <table class="table table-hover">
        <thead>
          <tr>
          <th>Nome do Arquivo</th>
          <th>Disciplina</th>
          <th>Status</th>
          <th>Ações</th>
          <th>-</th>
          <th>-</th>
          </tr>
        </thead>
        <tbody>
        <?php 
             $ArquivosPendentes = "SELECT ID_Arquivo,Nome_Arquivo,Nome_Disciplina,Tipo_Status,ID_Status_FK FROM arquivo
             INNER JOIN disciplina d ON ID_Disciplina_FK = d.ID_Disciplina
             INNER JOIN rel_curso_usuario rcu ON ID_Rel_Curso_Usuario_FK = rcu.ID_Rel_Curso_Usuario
             INNER JOIN arquivo_status ArS ON ID_Status_FK = ArS.ID_Status
             INNER JOIN rel_Usuario_tipo_usuario rutu ON ID_Rel_Usuario_Tipo_Usuario_FK = rutu.ID_Rel_Usuario_Tipo_Usuario
             INNER JOIN usuario u ON ID_Usuario_FK = u.ID_Usuario
             AND Tipo_Status = 'Em Analise'";
              $Procurar = mysqli_query($db,$ArquivosPendentes);

                    ?>
                <?php while($row2 = mysqli_fetch_array($Procurar)){?>
          <tr>  
            <td><?php echo $row2['Nome_Arquivo'] ?></td>
            <td><?php echo $row2['Nome_Disciplina']?></td>
            <td><?php echo $row2['Tipo_Status']?></td>
            <td><a href="../arquivo/download.php?file_id=<?php echo $row2['ID_Arquivo']?>"><button type="submit" name="download" id="download" class="btn btn-dark">Download</button></a></td>
            <td><form action='' method='POST'>
                  <input type='hidden' value=<?php echo $row2['ID_Status_FK']?> name='ID_Status_FK'/>
                  <button type="submit" id="AceitarArquivo" name="AceitarArquivo" class="btn btn-dark">Aceitar</button>
                </form></td>
              <td><form action='' method='POST'>
                <input type='hidden' value=<?php echo $row2['ID_Arquivo'];?> name='ID_Arquivo'/>
                <button type="submit" id="DeletarArquivo" name="DeletarArquivo" class="btn btn-danger">Deletar</button>
              </form></td>
          </tr>
        </tbody>
        <?php }?>

      <?php  
       if (isset($_POST['AceitarArquivo'])) {
        $AceitarArquivo =  $_POST['ID_Status_FK'];
        $Editar = "UPDATE arquivo SET ID_Status_FK = 2 WHERE ID_Status_FK =".$AceitarArquivo."";
        $query2 = $db->query($Editar);  
        }
       if(isset($_POST['DeletarArquivo'])){
        $DeletarArquivo = $_POST['ID_Arquivo'];
        $Deletar = "DELETE FROM arquivo WHERE ID_Arquivo =".$DeletarArquivo."";
        $query3 = $db->query($Deletar);
       }
    
    
    }?>
    
      </table>
        </div>
       </div>
       