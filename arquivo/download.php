<?php

require_once '../inc/config.php'; 

require_once DBAPI;
$db= open_database();
session_start();
$email = $_SESSION['email'];
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
{
  header('location:../index.php');
  }
?>

<?php if(isset($_GET['file_id'])){
    $id = $_GET['file_id'];


    $AcharArquivo = "SELECT * FROM arquivo WHERE ID_Arquivo = $id";
    $result = mysqli_query($db,$AcharArquivo);

    var_dump($AcharArquivo);
    $file = mysqli_fetch_assoc($result);
    $filepath = $file['Caminho'] .'/'.$file['Nome_Arquivo'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize( $file['Caminho'] .$file['Nome_Arquivo']));
        readfile( $file['Caminho'] .$file['Nome_Arquivo']);
   
    }
 
}



?>