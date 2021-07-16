<?php
    namespace PRJM011\Model;
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;
    
    class Cliente extends Model {
        public static function listAll()
        {
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_persons ORDER BY idperson");
        }

        public function get($idperson) 
        {
            $sql = new Sql();
            
            $results = $sql->select("SELECT * FROM tb_persons WHERE idperson = :idperson", array(
            ":idperson"=>$idperson
            ));
            
            $data = $results[0];
            
            $this->setData($data);
        }

        public function update()
        {
            $sql = new Sql();
                                                     
            $results = $sql->select("CALL sp_persons_update_save(:idperson, :desperson, :sgcompany, :descpfcnpj, :email)", array(
                ":idperson"         => $this->getidperson(),
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
            
            $sql->query("CALL sp_persons_delete(:idperson)", array(
                ":idperson"=>$this->getidperson()
            ));
        }
    }
?>
