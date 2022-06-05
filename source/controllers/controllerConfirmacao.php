<?php
    /***
     * controller de confirmação pelo link do email do user 
    */
    $email=\Traits\TraitParseUrl::parseUrl(2);
    $token=\Traits\TraitParseUrl::parseUrl(3);
    
    $confirmation=new \Models\ModelRegister();

    if($confirmation->confirmationReg($email, $token)){
        echo "
            <script>
                alert('Dados confirmados com sucesso!');
                window.location.href='".DIRPAGE."sign-in';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Não foi possível confirmar seus dados!');
                window.location.href='".DIRPAGE."';
            </script>
        ";
    }