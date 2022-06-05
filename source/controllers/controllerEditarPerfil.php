<?php  
    namespace Models;

    $crud=new ModelCrud();
    
    if($Acao == 'Editar')
    {
        $validate=$crud->updateDB("account", 
                                    "nome=?, 
                                     contato=?, 
                                     cidade=?, 
                                     bairro=?", 
                                     "id=?",
                                array($Nome, 
                                        $Contato, 
                                        $Cidade, 
                                        $Bairro, 
                                        $Id
                                     )
                            );
   
        if($validate->rowCount() > 0 )
        {
            echo "<script>
                    alert('Perfil atualizado com Sucesso!');
                    window.location.href='".DIRPAGE."myaccount';      
                </script>
            ";
        }else{
            echo "<script>
                    alert('Erro! Tente depois.');
                    window.location.href='".DIRPAGE."myaccount';      
                </script>
            ";                
        }
    }
    
    
    