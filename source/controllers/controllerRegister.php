<?php
    $validate=new Classes\ClassValidate();

    $validate->validateFields($_POST);               // Valida todos os campos de formulário , $_POST, vindo das variables.php 
    $validate->validateEmail($email);                // validação do email
    $validate->validateIssetEmail($email);           // verificação se o email está ou não no banco de dados
    $validate->validateConfirmacaoSenha($senha,$senhaConfirmacao); //verificação de senhas 

    echo $validate->validateFinalReg($arrVar);
   

