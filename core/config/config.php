<?php
#Caminhos absolutos
$pastaInterna="github/My-Defaul-Php-Mvc/";
define('DIRPAGE',"http://{$_SERVER['HTTP_HOST']}/{$pastaInterna}");
(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?$barra="":$barra="/";
define('DIRREQ',"{$_SERVER['DOCUMENT_ROOT']}{$barra}{$pastaInterna}");

#Atalhos
define('DIRCSS', DIRPAGE.'assets/css/');
define('DIRIMG', DIRPAGE.'assets/images/');
define('DIRJS', DIRPAGE.'assets/js/');
define('DIRTP', DIRPAGE.'assets/templates/');

#Acesso ao db
define('HOST',"localhost");
define('DATABASE',"teste_mvc");
define('USER',"root");
define('PASSWORD',"");




#Outros
define("DOMAIN",$_SERVER["HTTP_HOST"]);