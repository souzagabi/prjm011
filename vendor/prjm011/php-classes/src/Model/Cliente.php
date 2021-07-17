<?php
    namespace PRJM011\Model;
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;
    
    class Cliente extends Model {
        public static function listAll()
        {
            $sql = new Sql();
            return $sql->select("SELECT * FROM PRJM011002 PRJM002 
                                INNER JOIN PRJM011004 PRJM004 ON PRJM004.pessoa_id = PRJM002.pessoa_id 
                                INNER JOIN PRJM011003 PRJM003 ON PRJM003.pessoa_id = PRJM002.pessoa_id
                                INNER JOIN PRJM011005 PRJM005 ON PRJM005.classificacao_id = PRJM002.classificacao_id
                            WHERE PRJM005.classificacao_id > 0 ORDER BY PRJM002.pessoa_id");
        }

        public function get($pessoa_id) 
        {
            $sql = new Sql();
            
            $results = $sql->select("SELECT * FROM PRJM011002 WHERE pessoa_id = :pessoa_id", array(
            ":pessoa_id"=>$pessoa_id
            ));
            
            $data = $results[0];
            
            $this->setData($data);
        }

        public function update()
        {
            $sql = new Sql();
                                                     
            $results = $sql->select("CALL sp_persons_update_save(:pessoa_id, :desperson, :sgcompany, :descpfcnpj, :email)", array(
                ":pessoa_id"         => $this->getpessoa_id(),
                ":desperson"        => $this->getdesperson(),   
                ":sgcompany"        => $this->getsgcompany(),   
                ":descpfcnpj"       => $this->getdescpfcnpj(),
                ":email"            => $this->getemail()
            ));
           
            $this->setData($results);
        }

        public function delete()
        {
            $sql = new Sql();
            
            $sql->query("CALL sp_persons_delete(:pessoa_id)", array(
                ":pessoa_id"=>$this->getpessoa_id()
            ));
        }
    }
?>
