<?php
    
    header("Content-Type: text/html; charset=utf-8");      

    require "core/config/config.php";              
    require "vendor/autoload.php";  

    //Teste Unitário para namespace Classes
    use Classes\ClassTest;
    $obj = new ClassTest();
    echo "<hr>";

    //Teste Unitário para namespace Models
    use Models\ModelTest;
    $obj_models = new ModelTest();
    echo "<hr>";

    //Teste Unitário para namespace Traits
    //http://localhost/github/My-Defaul-Php-Mvc/string0
    use Traits\TraitParseUrl;

    class ClassTraitsTest{
        use TraitParseUrl;
        public function __construct(){
            echo "Teste Unitário namespace Traits.Tudo Ok!<br>";
            var_dump($this->parseUrl('0'));
            //Output string(7) "string0" 
        }
    }

    $obj = new ClassTraitsTest();
    echo "<hr>";

  



