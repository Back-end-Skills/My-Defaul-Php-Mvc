<?php 
    namespace Classes;

    use Models\ModelCrud;
    use Classes\ClassMail; 

    

    // Capaturando o email e nome do user 
    $Email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $Nome  = filter_input(INPUT_GET, "name", FILTER_SANITIZE_SPECIAL_CHARS);      

    $crud = new ModelCrud();

    // Resgatando o token 
    $select_table = $crud->selectDB("*", "confirmation", "WHERE email=?", array($Email)); 
             
    $select_confirmation = $select_table->fetch(\PDO::FETCH_ASSOC);
    $Token = $select_confirmation['token'];
    
    //Array 
    $arr = [
      "email" =>  $Email,
      "nome" =>  $Nome,
      "token" => $Token 
    ];

    $reenviar_mail = new ClassMail();

    $reenviar_mail->sendMail(
                  $arr['email'],
                  $arr['nome'],
                  $arr['token'],
                  "Confirmação de Cadastro",
                  "<strong>Equipe Kvik</strong><br>
                  Confirme seu email <a href='".DIRPAGE."controllers/controllerConfirmacao/{$arr['email']}/{$arr['token']}'>clicando aqui</a>.
                  "
                  
    );

    /* Segunda opção com envio de anexo    
    $reenviar_mail->add(
                    $arr['email'],
                    $arr['nome'],
                    $arr['token'],
                    "Confirmação token com teste SMTP",
                    "<strong>Cadastro do Site Conexão Acará</strong><br>
                    Confirme seu email <a href='".DIRPAGE."controllers/controllerConfirmacao/{$arr['email']}/{$arr['token']}'>clicando aqui</a>.
                    "
              
    )->attach(
      "assets/images/img.png",
      "images name"
    )->send();*/
    
    if($reenviar_mail) {
      
      echo "<script>
              alert('Link enviado com sucesso!');
              window.location.href='".DIRPAGE."myaccount';
            </script>  
      ";
                  
    } else {
         echo "<script>
                alert('Erro! Tente mais tarde');
                window.location.href='".DIRPAGE."myaccount';
              </script>  
          ";
              
    }
                              
  
   
