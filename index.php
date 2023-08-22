
<?php 
require_once 'inc/config.php';
require_once DBAPI;
include(HEAD_TEMPLATE);
?>



<?php $db= open_database(); ?>

<?php if($db) : ?>

<?php session_start();?>

<link rel="stylesheet" href="inc/css/styles.css" class="rel">
<link rel="shortcut icon" href="inc\images\Logo.jpeg">
<body>
<section class="vh-100% " id="secaomenu">
<div class="container py-5 h-100" >
<div class="row d-flex justify-content-center align-items-center">
  <div class="col col-xl-10">
    <div class="card" style="border-radius: 1rem;">
      <div class="row g-0">
        <div class="col-md-6 col-lg-5 d-none d-md-block">
          <img src="inc/images/LoginImage.jpg" 
          alt="login form" class="img-fluid" id="imagemenu">
        </div>
        <div class="col-md-6 col-lg-7 d-flex align-items-center">
          <div class="card-body p-4 p-lg-5 text-black" id="Corpo">

          <?php
          
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                      <p id="n">Dados incorretos!.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>

                  <?php
                    if(isset($_SESSION['criado_registro'])):
                    ?>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                      <p id="n">Registro feito com sucesso! Aguarde a liberação.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['criado_registro']);
                    ?>


            <form action="login/login.php" method="POST">
              <div class="d-flex align-items-center mb-3 pb-1">
                <i class="fas fa-cubes fa-2x me-3"></i>
                <h1>TESTE DE GIT</h1>
                <span class="h1 fw-bold mb-0" id="Titulo">Etecademy</span>
              </div>

              <div class="form-group mb-4">
                  <label class="form-label" for="email">Email Institucional</label>
                <input type="email" name="email" id="email" required class="form-control form-control-lg" >
              </div>

              <div class="form-group mb-4">
                  <label class="form-label" for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required class="form-control form-control-lg" required>
              </div>

              
              <div class="form-group mb-4">
                  <label class="form-label text-center" for="codigo-etec"> Código da Etec </label>
                  <select class="form-select" name="codigo-etec" id="codigo-etec" required>
                <option  selected disabled value >Selecione</option>
                <?php
                 $result_locais = "SELECT Cod_Etec,Unidade FROM etec";
                 $resultado_local = mysqli_query($db, $result_locais);
                 while($row_locais = mysqli_fetch_assoc($resultado_local)){ ?>
                   <option value="<?php echo $row_locais['Cod_Etec']; ?>"><?php echo $row_locais['Unidade'];?></option> <?php
                 } ?>


              </select>
             </div>


              <div class="form-group mb-4">
              <label for="tipo-usuario">Tipo de Usuário</label>
              <select class="form-select" name="tipo-usuario" id="tipo-usuario" required>
                <option selected disabled value="">Selecione</option>
                <option value="1">Aluno</option>
                <option value="2">Professor</option>
              </select>
              </div>

              
              <div class="pt-1 mb-4">
                <button id="botao-login" type="submit" class="btn btn-dark btn-lg"> Entrar</button>
              </div>

              
              <p class="mb-5 pb-lg-2" style="color: #000000;">Não tem uma conta? <a  href="registrar/registra.php"
                  >Registre-se aqui</a></p>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>
</section>


</body>

<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>