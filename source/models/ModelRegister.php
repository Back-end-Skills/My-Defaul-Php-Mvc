<?php
namespace Models;

class ModelRegister extends ModelCrud{

    #Realizará a inserção no banco de dados
    public function insertReg($arrVar)
    {
        $this->insertDB(
          "account",
          "?,?,?,?,?,?,?",
                array(
                    0,
                    $arrVar['nome'],
                    $arrVar['email'],
                    $arrVar['hashSenha'],
                    $arrVar['dataCreate'],
                    'user',
                    'confirmation'
                )
        );
        $this->isConfirmation($arrVar);
    }

    public function isConfirmation($arrVar) {
        $this->insertDB(
            "confirmation",
                "?,?,?",
                array(
                    0,
                    $arrVar['email'],
                    $arrVar['token']
                )
        );
    }

    public function confirmationSenha($email, $token, $hashSenha){
            
        $b=$this->selectDB("*","confirmation", "where email=? and token=?", array($email, $token));
        $r=$b->rowCount();

        if($r >0){

            $this->deleteDB("confirmation", "email=?",array($email));

            $this->updateDB("account", "senha=?", "email=?", array($hashSenha, $email));
        
            return true;
        
        } else {  return false;   }
    }

    #Veriricar se já existe o mesmo email cadastro no db
    public function getIssetEmail($email){

        $b=$this->selectDB("*", "account", "where email=?", array($email));
        return $r=$b->rowCount();
        
    }


    #Verificar a confirmação de cadastro pelo email        
    public function confirmationReg($email, $token){

        $b=$this->selectDB("*","confirmation","where email=? and token=?",array($email, $token));
        $r=$b->rowCount();

        if($r >0){

            $this->deleteDB( "confirmation", "email=?", array($email));

            $this->updateDB("account", "status=?", "email=?", array("active", $email));
            return true;

        } else {  return false;    }

    }
}