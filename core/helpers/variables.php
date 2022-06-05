<?php
    $obj_password = new Classes\ClassPassword(); 

     
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
        $hashSenha= $obj_password->passwordHash($senha);    
    } else {  
        $senha=null; 
        $hashSenha=null; 
    }
    if(isset($_POST['senhaConfirmacao'])){  
        $senhaConfirmacao=$_POST['senhaConfirmacao'];  
    } else { 
        $senhaConfirmacao=null; 
    }
 
    $dataCreate=date("Y-m-d H:i:s");

    $token=bin2hex(random_bytes(64));

   $arrVar=[
        "nome"=>$nome,
        "email"=>$email,
        "senha" =>$senha,
        "hashSenha"=>$hashSenha,
        "dataCreate"=>$dataCreate,
        "token"=>$token,
    ];



   
   