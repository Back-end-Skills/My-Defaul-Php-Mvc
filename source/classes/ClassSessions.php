<?php
    namespace Classes;
    
    use Models;
    use Traits\TraitGetIp;

    class ClassSessions{

        private $login;
        private $timeSession=10080; //tempo de sessão dentro do sistema para o usuário,logado (segundos)
        private $timeCanary=10;  // tempo para regeneracao da sessao, para o mesmo ip (segundos)

        public function __construct()
        {
            if(session_id() == ''){
                ini_set("session.save_handler","files");
                ini_set("session.use_cookies",1);
                ini_set("session.use_only_cookies",1);
                ini_set("session.cookie_domain",DOMAIN); //Apresentar erro ao ligar 
                ini_set("session.cookie_httponly",1);

                //apresenta erro no servidor online
                if(DOMAIN != "localhost"){ini_set("session.cookie_secure",1);}

                /*Criptografia das nossas sessions*/
                ini_set("session.entropy_length",512);
                ini_set("session.entropy_file",'/dev/urandom');
                ini_set("session.hash_function",'sha256');
                ini_set("session.hash_bits_per_character",5);
                session_start();
            }
            $this->login=new Models\ModelLogin();
        }

        #Proteger contra roubo de sessão
        public function setSessionCanary($par=null)
        {
            session_regenerate_id(true);
            if($par == null)
            { $_SESSION['canary']=["birth" => time(),"IP" => TraitGetIp::getUserIp()];  }
            else{ $_SESSION['canary']['birth']=time();  }
        }

        #Verificar a integridade da sessão
        public function verifyIdSessions()
        {
            if(!isset($_SESSION['canary'])) {  $this->setSessionCanary();  }
            
            //Verifica a Integridade de sessão
            if($_SESSION['canary']['IP'] !== TraitGetIp::getUserIp())
            {
                $this->destructSessions();
                $this->setSessionCanary();
            }
            
            //atualiza o tempo de sessão
            if($_SESSION['canary']['birth'] < time() - $this->timeCanary)
            {
                 $this->setSessionCanary("time");
            }
        }

        #Setar as sessões do nosso sistema, pega os dados do usuário
        public function setSessions($email)
        {
            $this->verifyIdSessions();
            $_SESSION["login"]=true;
            $_SESSION["time"]=time();

            $_SESSION["name"]=$this->login->getDataUser($email)['data']['nome'];
            $_SESSION["email"]=$this->login->getDataUser($email)['data']['email'];
            $_SESSION["status"]=$this->login->getDataUser($email)['data']['status'];
            $_SESSION["permition"]=$this->login->getDataUser($email)['data']['permissoes'];

            $_SESSION["id_account"]=$this->login->getDataUser($email)['data']['id'];
            
        }

        #Validar as páginas internas do sistema
        public function verifyInsideSession($permition)
        {
            $this->verifyIdSessions();
            if(!isset($_SESSION['login']) || !isset($_SESSION['permition']) || !isset($_SESSION['canary']))
            {
                $this->destructSessions();
                echo "<script>
                            alert('Você não está logado');
                            window.location.href='".DIRPAGE."login';
                      </script>";
            } else {
                if($_SESSION['time'] >= time() - $this->timeSession)
                {
                    $_SESSION['time']=time();

                    //START Controle de níveis de acesso
                    if($_SESSION['permition'] != 'manager' && $permition != $_SESSION['permition'])
                    {
                        echo "<script>
                                alert('Acesso Restrito!');
                                window.location.href='".DIRPAGE."login';
                             </script>
                        ";
                    }//END Controle de níveis de acesso
                     
                } else {
                    $this->destructSessions();
                    echo "<script>
                                alert('Sua sessão expirou. Faça login novamente!');
                                window.location.href='".DIRPAGE."login';
                          </script>
                    ";
                }
            }
        }

        #Destruir as sessions existentes
        public function destructSessions()
        {
            foreach (array_keys($_SESSION) as $key) {
                unset($_SESSION[$key]);
            }
        }

    }