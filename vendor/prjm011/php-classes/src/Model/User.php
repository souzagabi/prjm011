<?php
    namespace PRJM011\Model;
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;
    
    class User extends Model {
        const SESSION = "User";
        const SECRET  = "ADJ-SIG_SistemasTi";
        const SECRET2 = "1234567899876543";

        public static function login($login, $password)
        {
            $sql = new Sql();

            $results = $sql->select("SELECT PRJM002.pessoa_id, PRJM002.nome, PRJM002.classificacao_id,
                                        PRJM004.usuario_id, PRJM004.senha, PRJM004.inadmin 
                                        FROM PRJM011002 PRJM002 
                                        INNER JOIN PRJM011004 PRJM004 ON PRJM004.pessoa_id = PRJM002.pessoa_id 
                                        WHERE PRJM004.login = :LOGIN", array(
                ":LOGIN"=>$login
            ));
            
            if (count($results) === 0) {
                $msg = "ERROR: 1- Usuário ou senha inválida!";
                header("Location: /admin/login?msg=$msg");
			    exit;
            }
            $data = $results[0];
            
            User::passwordVerity($password, $data );
            
        }
        public static function passwordVerity($passUser, $data = array() )
        {
            if (password_verify($passUser, $data["senha"]) === true) {
                $user = new User;
                
                $user->setData($data);

                $_SESSION[User::SESSION] = $user->getValues();
                
                return $user;
            } else{
                $msg = "ERROR: 2- Usuário ou senha inválida!";
                header("Location: /admin/login?msg=$msg");
			    exit;
            }
        }

        public static function verifyLogin($inadmin = true)
        {
            if (!isset($_SESSION[User::SESSION]) || !(int)$_SESSION[User::SESSION]["usuario_id"] > 0  ) {
                
                $msg = "ERROR: É necessário fazer login!";
                header("Location: /admin/login?msg=$msg");
			    exit;
            } 
            
        }

        public static function logout()
        {
            $_SESSION[User::SESSION] = NULL;
        }

        public static function listAll()
        {
            $sql = new Sql();
            $list["start"] = 0;
            $pg = isset($_GET["pg"]) ? $_GET["pg"] : 1;
            $list["limit"] = (isset($list["limit"]) && $list["limit"] != '') ? $list["limit"] : 10;
            $list["start"] = ($pg - 1) * $list["limit"];

            $results = $sql->select("CALL prc_usuario_lista(:start,:limit)",array(
                ":start"=>$list["start"],
                ":limit"=>$list["limit"]
            ));

            if ($results == '' || $results == NULL) {
                $results[0]["MESSAGE"] = "Não há registros a ser visualizado!!";
            }
            return $results;
        }

        public function get($pessoa_id) 
        {
            $sql = new Sql();
            
            $results = $sql->select("SELECT * FROM PRJM011001 PRJM001 
                                    INNER JOIN PRJM011004 PRJM004 ON PRJM004.pessoa_id = PRJM001.pessoa_id 
                                    INNER JOIN PRJM011002 PRJM002 ON PRJM002.pessoa_id = PRJM001.pessoa_id 
                                    INNER JOIN PRJM011003 PRJM003 ON PRJM003.pessoa_id = PRJM001.pessoa_id
                                    WHERE PRJM001.pessoa_id = :pessoa_id", array(
            ":pessoa_id"=>$pessoa_id
            ));
            
            $data = $results[0];
            
            $this->setData($data);
            
        }

        public function save()
        {
            $sql = new Sql();
           
            $results = $sql->select("CALL prc_pessoa_save(:usuario_id,:nome,:nrocelular,:email,:classificacao_id,:login, :senha, :inadmin)", array(
                ":usuario_id"           => $this->getusuario_id(),
                ":nome"                 => $this->getnome(),
                ":nrocelular"           => $this->getnrocelular(),
                ":email"                => $this->getemail(),
                ":classificacao_id"     => $this->getclassificacao_id(),
                ":login"                => $this->getlogin(),
                ":senha"                => $this->getsenha(),
                ":inadmin"              => $this->getinadmin()
            ));
            $this->setData($results);
            return $results[0]["MESSAGE"];
        }
        
        public function update()
        {
            $sql = new Sql();
            
            $results = $sql->select("CALL prc_pessoa_update(:usuario_id,:pessoa_id,:nome,:nrocelular,:email,:classificacao_id,:login,:senha,:inadmin,:situacao)", array(
                ":usuario_id"           => $this->getusuario_id(),
                ":pessoa_id"            => $this->getpessoa_id(),
                ":nome"                 => $this->getnome(),
                ":nrocelular"           => $this->getnrocelular(),
                ":email"                => $this->getemail(),
                ":classificacao_id"     => $this->getclassificacao_id(),
                ":login"                => $this->getlogin(),
                ":senha"                => $this->getsenha(),
                ":inadmin"              => $this->getinadmin(),
                ":situacao"             => $this->getsituacao()
            ));
           
            $this->setData($results);
            
            return $results[0]["MESSAGE"];
        }

        public function delete()
        {
            $sql = new Sql();
            $results = $sql->select("CALL prc_pessoa_delete(:pessoa_id)", array(
                ":pessoa_id"=>(int)$this->getpessoa_id()
            ));
           
            $this->setData($results);
            return $results[0]["MESSAGE"];
        }
        
        public static function getForgot($email)
        {
            $sql = new Sql();
            
            $results = $sql->select("SELECT * FROM PRJM011010 PRJM011
                INNER JOIN PRJM011013 PRJM013 ON PRJM013.pessoa_id = PRJM011.pessoa_id
                WHERE PRJM011.email = :email",
                 array(
                     ":email"=>$email
            ));
            
            if(count($results) === 0){
                $msg = "ERROR: 1 - Não foi pssível recuperar a senha.";
                header("Location: /admin/forgot?msg=$msg");
			    exit;
            } else {
                $data = $results[0];
                $results2 = $sql->select("CALL prc_passwordsrecoveries_create(:user_id, :desip)", array(
                    ":user_id"=>$data["user_id"],
                    ":desip"=>$_SERVER["REMOTE_ADDR"]
                ));
              
                if (count($results2) === 0) {
                    $msg = "ERROR: 2 - Não foi pssível recuperar a senha.";
                    header("Location: /admin/forgot?msg=$msg");
                    exit;
                } else {
                    
                    $dataRecovery = $results2[0];
                    $method = "aes-256-ctr";
                    $ivlen = openssl_cipher_iv_length($method);
                    $iv = USER::SECRET2;
                    
                    $code = base64_encode(openssl_encrypt($dataRecovery["recovery_id"], $method, USER::SECRET, 0, $iv));

                    $link = "http://www.gbsuporte.com.br:99/admin/forgot/reset?code=$code";
                    
                    $mailer = new Mailer($data["email"], $data["nome"], "Redefinir senha", "forgot", 
                    array(
                        "name"=>$data["nome"],
                        "link"=>$link
                    ));
                   
                    $mailer->send();

                    return $data;
                }
            }
        }

        public static function validForgotDecrypt($code)
        {
            $method = "aes-256-ctr";
            $ivlen = openssl_cipher_iv_length($method);
            $iv = USER::SECRET2;
            $code2 = base64_decode($code);
            $recovery_id = openssl_decrypt($code2, $method, USER::SECRET, 0, $iv);
            
            $sql = new Sql();
            $results = $sql->select("SELECT *
                FROM PRJM011009 PRJM009
                INNER JOIN PRJM011013 PRJM013 ON PRJM013.user_id = PRJM009.user_id
                INNER JOIN PRJM011010 PRJM011 ON PRJM011.pessoa_id = PRJM013.pessoa_id
                WHERE
                    PRJM009.recovery_id = :recovery_id
                    AND
                    PRJM009.dtrecovery IS NULL
                    AND
                    DATE_ADD(PRJM009.dtregister, INTERVAL 5 MINUTE) >= NOW();
            ", array(
                ":recovery_id"=>$recovery_id
            ));

            if (count($results) === 0) {
                $msg = "ERROR: 3 - Não foi pssível recuperar a senha.";
                header("Location: /admin/forgot?msg=$msg");
                exit;
            } else {
                return $results[0];
            }
        }

        public static function setForgotUsed($recovery_id)
        {
            $sql = new Sql();
            $sql->query("UPDATE PRJM011009 SET dtrecovery = NOW() WHERE recovery_id = :recovery_id", array(
                ":recovery_id"=>$recovery_id
            ));
        }

        public function setPassword($pass)
        {
            $sql = new Sql();
            $sql->query("UPDATE PRJM011013 SET pass = :pass WHERE user_id = :user_id", array(
                ":pass" =>$pass,
                ":user_id"  =>$this->getuser_id()
            ));
        }
    }

?>
