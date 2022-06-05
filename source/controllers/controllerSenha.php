<?php
    $validate=new Classes\ClassValidate();

    // Valida todos os campos de formulário , $_POST, vindo das variables.php  
    $validate->validateFields($_POST);             

    // validação do email, , vindo das variables.php
    $validate->validateEmail($Email);    

    // verificação se o email está ou não no banco de dados, , vindo das variables.php
    $validate->validateIssetEmail($Email, "senha");  

    //verificação de senhas dígitas são iguais 
    $validate->validateConfSenha($senha,$senhaConf); 
    
    //--recuperacao de senha, , vindo das variables.php
    $validate->validateEmailRecuperaSenha($Email);  
    
    //Verificação Final de Senha 
    echo $validate->validateFinalSen($arrayVar);
