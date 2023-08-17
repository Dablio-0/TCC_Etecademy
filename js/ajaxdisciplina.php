<?php
require_once '../inc/config.php'; 
require_once DBAPI;

$db = open_database();

if($_POST['ID_Curso']){
    $query2 = "SELECT * FROM disciplina d
    INNER JOIN curso c ON d.ID_Curso_FK = c.ID_Curso
    WHERE ID_Curso_FK = " . $_POST['ID_Curso'];

    $result2 = $db->query($query2);
    if ($result2->num_rows > 0){
      while($row2 = $result2->fetch_assoc()){
          echo '<td scope='.$row2['ID_Disciplina'].'>'.$row2['Nome_Disciplina'].'</td>';

      }
  } else{
    echo '<option>Cursos não Encontrados!</option>';
  }
  };
  ?>