<?php   
     
    /*======= variáveis do sistema  ======*/
   
    
    if(isset($_POST['nome'])){
        $nome=filter_input(INPUT_POST,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
    } elseif(isset($_GET['nome'])){
        $nome=filter_input(INPUT_GET,'nome',FILTER_SANITIZE_SPECIAL_CHARS);
    } else { 
        $nome="";
    }

 
    if(isset($_POST['email'])){ 
        $email=filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL); 
    } elseif(isset($_GET['email'])){ 
        $email=filter_input(INPUT_GET,'email',FILTER_VALIDATE_EMAIL);  
    } else { 
        $email=""; 
    }

    if(isset($_POST['senha'])){  
        $senha=$_POST['senha'];    
    } else {  
        $senha=null; 
    }
    if(isset($_POST['senhaConf'])){  
        $senhaConf=$_POST['senhaConf'];  
    } else { 
        $senhaConf=null; 
    }
 
    $dataCreate=date("Y-m-d H:i:s");
    
    $token=bin2hex(random_bytes(64));

   
   