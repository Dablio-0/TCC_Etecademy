<?php require_once '../inc/config.php'; ?>
<?php require_once DBAPI?>
<?php include (HEAD_TEMPLATE); ?>

<?php $db= open_database(); ?>
<?php session_start();?>

<?php if($db) : ?>
<?php
  $query = "SELECT * FROM etec ORDER BY Cod_Etec ";
  $result = $db->query($query);
  ?>


<script type="text/javascript" src="../js/node.js"></script>
<link rel="stylesheet" href="../inc/css/styles.css" class="rel">
<link rel="shortcut icon" href="..\inc\images\Logo.jpeg">
<section class="vh-100%" id="secaomenu">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">REGISTRAR</h3>
            <?php
                    if(isset($_SESSION['email_existente'])):
                      ?>
                      <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <p id="n">Email já cadastrado.</p>
                      </div>
                      <?php
                      endif;
                      unset($_SESSION['email_existente']);
                      ?>

            <form action="signup.php" method="POST">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                  <label class="form-label" for="email">Email Institucional</label>
                    <input type="text" id="email" name="email" class="form-control form-control-lg" required/> 
                    <div id="resposta"></div>
                  </div>

                </div>
                <div class="col-md-6 mb-4">
                <label class="form-label text-center" for="codigo-etec"> Selecione a Etec</label>
                  <select class="form-select" name="codigo-etec" id="codigo-etec" onchange="FetchCurso(this.value)" required>
                <option  selected disabled value >Selecione</option>  
                <?php 
                 if($result->num_rows > 0){
                  while ($row = $result->fetch_assoc()){
                    echo '<option value='.$row['Cod_Etec'].'>'.$row['Unidade'].'</option>';
                  }
                 }

                
                ?>
              </select>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline datepicker w-100">
                  <label class="form-label" for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control form-control-lg" onChange="onChange()" required/>
                  </div>
                </div>

              <div class="col-md-6 mb-4">
              <label class="form-label text-center" for="tipo-curso"> Selecione o Curso</label>
                  <select class="form-select" name="tipo-curso" id="tipo-curso" required>
                <option  selected disabled value >Selecione</option>
               
              </select>
              </div>
              </div>
 
              <div class="row">
                <div class="col-md-6 mb-4">
                <div class="form-outline">
                <label class="form-label" for="confirmasenha">Confirme a senha</label>
                    <input type="password" id="confirmasenha" name="confirmasenha" class="form-control form-control-lg" onChange="onChange()" required/>
                   </div>
                </div>

                <div class="col-md-6 mb-4">
              <label class="form-label text-center" for="tipo-modulo">Selecione o modulo</label>
                  <select class="form-select" name="tipo-modulo" id="tipo-modulo" required>
                <option  selected disabled value >Selecione</option>
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
              </select>
              </div>
              </div>

              <div class="mt-4 pt-2">
              <button id="botao-login" name="botao-login" type="submit" class="btn btn-dark btn-lg"> Enviar</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script class="text/javascript">
  function FetchCurso(id){
    $.ajax({
      type:'POST',
      url:'../js/ajaxdata.php',
      data:{Cod_Etec: id},
      success :function(data){
        $('#tipo-curso').html(data);
      }
    })

  }
  
</script>

<?php else : ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>

<?php endif; ?>

