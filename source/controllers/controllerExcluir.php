<?php 
    namespace Models;
    use Classes\ClassSessions;

    $crud=new ModelCrud();
    
    $ads_event_id = filter_input(INPUT_GET, 'ads-event-id', FILTER_SANITIZE_SPECIAL_CHARS);   // Excluir Anúncio de Event    

    if(isset($ads_event_id)){   
            
        $crud->deleteDB("ads_event", "id=?", array($ads_event_id)); #DeleteDB table Ads              
        
        $crud->deleteDB("files_event", "fk_ads_event=?", array($ads_event_id));   #Deleta a imagens
        
        echo"<script> alert('Evento deletado!'); 
                    window.location.href='".DIRM."myaccount/ads#tab-ads-event';
                    </script>
                ";
    }
    
    $ads_id = filter_input(INPUT_GET, "ads-id", FILTER_SANITIZE_SPECIAL_CHARS);     // Excluir Anúncios         
    
    if(isset($ads_id)){
        
        $crud->deleteDB("ads", "id=?", array($ads_id));    #DeleteDB table Ads   
        
        $crud->deleteDB("files", "fk_ads=?", array($ads_id));   #DeleteDB as images table files
            
        echo"<script> alert('Anúncio deletado!'); 
                    window.location.href='".DIRM."myaccount';
                </script>
                ";
    }

    $users_id=filter_input(INPUT_GET, "users-id", FILTER_SANITIZE_SPECIAL_CHARS);      // Excluir Conta
    
    if(isset($users_id)){ 
        
        $select_account=$crud->selectDB("*", "account", "WHERE id=?", array($users_id));  #Verificando o email do user
        $select_data = $select_account->fetch(\PDO::FETCH_ASSOC);
        $email= $select_data['email'];
        
        #Verifica se existe registro na table confirmation
        $select_confirmation=$crud->selectDB("*", "confirmation", "WHERE email=?", array($email)); 
        $countConfirmation =  $select_confirmation->rowCount();
        
        #Verifica se existe anúncios cadastrado ou publicado
        $select_ads=$crud->selectDB("*", "ads", "WHERE fk_account=?" , array($users_id));
        $countAds= $select_ads->rowCount();       

        #Verifica se existe anúncio de eventos cadastrado ou publicado
        $select_ads_event=$crud->selectDB("*", "ads_event", "WHERE fk_account=?" , array($users_id));
        $countEvent = $select_ads_event->rowCount(); 
            
        if($countAds > 0)
        {
            echo"<script>
                    alert('Erro! Por favor, exclua seus ANÚNCIOS');
                    window.location.href='".DIRM."myaccount/ads#tab-about';
                </script>
            ";

        } else {

            if($countEvent > 0)
            {
                echo"<script>
                        alert('Erro! Por favor, exclua seus EVENTOS');
                        window.location.href='".DIRM."myaccount/ads#tab-ads-event';
                    </script>
                ";
                
            } else {

                if($countConfirmation > 0)
                {
                    $crud->deleteDB("confirmation", "email=?", array($email)); 
                    
                    $crud->deleteDB("account", "id=?", array($users_id));
                    
                    $sesssion=new ClassSessions();
                    $sesssion->destructSessions();                                
                    echo"<script>
                            alert('Sucesso. Conta Desativada!')
                            window.location.href='".DIRPAGE."';
                        </script>
                    ";

                } else {
                
                    $crud->deleteDB("account", "id=?", array($users_id));
                    
                    $sesssion=new ClassSessions();
                    $sesssion->destructSessions();
                                
                    echo"<script>
                            alert('Sucesso. Conta Desativada!')
                            window.location.href='".DIRPAGE."';
                        </script>
                    ";
                }
            }
        }
    }
      
