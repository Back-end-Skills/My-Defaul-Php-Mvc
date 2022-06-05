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
}