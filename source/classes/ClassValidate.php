<?php
    namespace Classes;

    use Models\ModelRegister;
    use Models\ModelLogin;
    use Classes\ClassPassword;
    use Classes\ClassSessions;


    class ClassValidate{ 

        private array $erro=[];
        private $register;
        private $password;
        private $login;       
        private $tentativas;
        private $session;

        public function __construct() 
        {
            $this->register=new ModelRegister();
            $this->password=new ClassPassword();
            $this->login   =new ModelLogin();
            $this->session =new ClassSessions();
        }

        public function getErro(){   
            return $this->erro;  
        }

        public function setErro($erro)
        {  
            array_push($this->erro,$erro);  
        }

        public function validateFields($par)
        {
            
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

         #Validação se o dado é um email
         public function validateEmail($par)
         {
            
            if(filter_var($par, FILTER_VALIDATE_EMAIL))
            { 
                return true;  
            } else { 
                $this->setErro("Email inválido!"); 
                return false;     
            }
        
        }

        #Validar se o email existe no banco de dados (action null para registro)
        public function validateIssetEmail($email, $action=null)
        {

            $b=$this->register->getIssetEmail($email);

            if($action==null){

                if($b > 0)
                { 
                    $this->setErro("Email já cadastrado!"); 
                    return false; 
                } else { 
                    return true; 
                }
            
            } else { //login 
                
                if($b > 0)
                { 
                    return true;  
                } else {
                    $this->setErro("Email não cadastrado!");
                    return false; 
                }
            }
        
        }

        #Verificar se a senha é igual a confirmação de senha
        public function validateConfirmacaoSenha($senha, $senhaConfirmacao)
        {

            if($senha === $senhaConfirmacao)
            {   
                return true;  
            } else {   
                $this->setErro("Senha diferente de confirmação de senha!");  
            }

        }

        #Verificação da senha digitada com o hash no banco de dados
        public function validateSenha($email, $senha)
        {
            if($this->password->verifyHash($email, $senha))
            {   
                return true;  
            } else {  
                $this->setErro("Usuário ou Senha Inválidos!");  
                return false;  
            }
        
        }
        
        #Validação final do Registro
        public function validateFinalReg($arrVar)
        {
            if(count($this->getErro()) > 0){
                $arrResponse=[
                    "retorno"=>"erro",
                    "erros"=>$this->getErro()
                ];
            }else{
                $arrResponse=[
                    "retorno"=>"success",
                    "erros"=>null
                ];
                $this->register->insertReg($arrVar);
            }
            return json_encode($arrResponse);
           
        }

        #Validação das tentativas
        public function validateAttemptLogin()
        {
            if($this->login->countAttempt() >= 5){

                $this->setErro("Mais 5 tentativas realizadas!\nAguarde 10 segundos.");
                $this->tentativas=true;
                return false;
            
            }else{ $this->tentativas=false; return true; }
        
        }

        #Validação final do login
        public function validateFinalLogin($email)
        {
            if(count($this->getErro()) >0)
            {
                $this->login->insertAttempt();

                $arrayResponse=[
                    "retorno"=>"erro",
                    "erros"=>$this->getErro(),
                    "tentativas"=>$this->tentativas
                ];
            }else {
               
                    $this->login->deleteAttempt();
                    $this->session->setSessions($email);
                  
                    $arrayResponse=[
                        "retorno"=>"success",
                        "page"=>"home-logado",
                        "tentativas"=>$this->tentativas
                    ];
                
            } 
            return json_encode($arrayResponse);
        }

        #Método de validação de confirmação de email 
        public function validateUserActive($email)
        {
            $user=$this->login->getDataUser($email);
            
            if($user["data"]["status"] == "confirmation")
            {
                //Condição para verificar o status do user. Se ele confirmou o email.
                if(strtotime($user["data"]["dataCreate"]) <= strtotime(date("Y-m-d H:i:s"))-432000){
                   
                    $this->setErro("Ative seu cadastro pelo link do email");
                   
                    return false;
                
                } else { 
                    return true; 
                }

            } else {  
                return true; 
            }
        
        }

        #Validação se o email é igual ao email do banco de dados
        public function validateEmailRecuperaSenha($email)
        {
            $dataDb=$this->login->getDataUser($email)["data"]["email"];

            if($email == $dataDb)
            {  
                return true; 
            } else {   
                return false;  
            }
        }

        #Validação final para Recuperação de senha
        public function validateFinalSenha($arrVar)
        {
            if(count($this->getErro())>0){

                $arrayResponse=[
                    "retorno"=>"erro", 
                    "erros"=>$this->getErro()
                ];
            
            }else{

                $this->mail->sendMail(
                    $arrVar['email'],
                    $arrVar['nome'],
                    $arrVar['token'],
                    "Link para Confirmação de Senha",
                    "
                    <strong>Redefinação da Senha</strong><br>
                    Redefina sua senha <a href='".DIRPAGE."redefinicaoSenha/{$arrVar['email']}/{$arrVar['token']}'>clicando aqui</a>.
                    "
                );
                $arrayResponse=[
                    "retorno"=>"success", 
                    "erros"=>null 
                ];
                $this->register->insConfirmation($arrVar);
            }
            return json_encode($arrayResponse);
        }
    }
    