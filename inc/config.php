<?php
/** O nome do banco */
define('DB_NAME', 'Etecademy');
/** Usuário do banco */
define('DB_USER', 'root');
/** Senha do banco */
define('DB_PASSWORD', '');
/** Nome do host */
define('DB_HOST', 'localhost');
/** Caminho unico para a pasta do sistema **/
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Caminho no servidor para o sistema*/
if( !defined('BASEURL'))
 define('BASEURL', '/Etecademy/');

 /** Caminho para o banco */
 if( !defined('DBAPI'))
  define('DBAPI', ABSPATH . 'database.php');
	
  /** Caminho dos Templates: Header/Footer */
  define('HEAD_TEMPLATE', ABSPATH . 'head.html');
  
?>