<?php
    
    header("Content-Type: text/html; charset=utf-8");      

    require "core/config/config.php";              
    require "vendor/autoload.php";  

    echo "Minha constante config DIRPAGE para caminho da url <br> ". DIRPAGE;
    echo "<hr>";

    echo "Minha constante config DIRREQ para caminho físico<br> ". DIRREQ;
    echo "<hr>";

    echo "Minha constante config DOMAIN para caminho <br>". DOMAIN;

  



