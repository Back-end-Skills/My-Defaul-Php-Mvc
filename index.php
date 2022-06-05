<?php
    
    header("Content-Type: text/html; charset=utf-8");      

    require "core/config/config.php";              
    require "vendor/autoload.php";  

    use  Traits\TraitParseUrl;
    
    class ClassTeste{
        use TraitParseUrl;
        public function __construct(){
            var_dump($this->parseUrl(2));
           

        }

    }
    $obj= new ClassTeste();

    //Opção 2
    //echo Traits\TraitParseUrl::parseUrl(2)

   
    //http://localhost/github/My-Defaul-Php-Mvc/pasta1/teste/core
     //Output string(4) "core" 
