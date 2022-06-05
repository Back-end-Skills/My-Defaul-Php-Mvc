<?php
    namespace Classes;

    use Models\ModelRegister;


    class ClassValidate{ 

        private $register;

        public function __construct() 
        {
            $this->register=new ModelRegister();
        }

        public function getErro(){   
            return $this->erro;  
        }

        public function setErro($erro){  
            array_push($this->erro,$erro);  
        }

        public function validateFields($par){
            
            $i=0;

            foreach ($par as $key => $value)
            {
                if(empty($value))
                { 
                    $i++;  
                }
            }

            if($i==0){  
                return true;  
            } else { 
                $this->setErro("Preencha todos os dados!"); 
                return false;  
            }

        }
        
        

        #Validação final do cadastro
        public function validateFinalReg($arrVar)
        {
            $this->register->insertReg($arrVar);
        }
    }