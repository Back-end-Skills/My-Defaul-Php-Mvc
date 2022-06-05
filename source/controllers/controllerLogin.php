<?php
    $validate=new Classes\ClassValidate();

    //valida se todos os campos via post estão preechidos
    $validate->validateFields($_POST);              
    
    // validação do email
    $validate->validateEmail($email);   
    
    // verificação se o email está no banco de dados para o login
    $validate->validateIssetEmail($email, "login");
    
    //verificação de senhas
    $validate->validateSenha($email, $senha); 
    
    //controle d tentativas de login do usuário
    $validate->validateAttemptLogin();              
    
    //Validação Final
    echo $validate->validateFinalLogin($email);     
    
    
