<?php
#Caminhos absolutos
$pastaInterna="";
define('DIRPAGE',"https://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");
(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?$barra="":$barra="/";
define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

#Atalhos
define('DIRCSS', DIRPAGE.'assets/css/');
define('DIRIMG', DIRPAGE.'assets/images/');
define('DIRJS', DIRPAGE.'assets/js/');
define('DIRTP', DIRPAGE.'assets/templates/');

#Acesso ao db
define('HOST',"localhost");
define('DB',"");
define('USER',"root");
define('PASS',"");




#Outros
define("DOMAIN",$_SERVER["HTTP_HOST"]);