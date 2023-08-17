<?php
require_once '../inc/config.php'; 
require_once DBAPI;

$db = open_database();

if ($_POST['Cod_Etec']) {

    $query = "SELECT c.ID_Curso, c.Nome_Curso from curso c 
    INNER JOIN rel_etec_curso rec ON c.ID_Curso = rec.ID_Curso_FK
    WHERE rec.Cod_Etec_FK = " . $_POST['Cod_Etec'];

    $result = $db->query($query);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo '<option value='.$row['ID_Curso'].'>'.$row['Nome_Curso'].'</option>';
        }
    } else{
      echo '<option>Cursos não Encontrados!</option>';
    }

  };

  
?>