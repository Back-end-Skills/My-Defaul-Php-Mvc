<?php
    
    header("Content-Type: text/html; charset=utf-8");      

    require "core/config/config.php";              
    require "vendor/autoload.php";  

    $dispatch=new Classes\ClassDispatch();
    include($dispatch->getInclusao());

   