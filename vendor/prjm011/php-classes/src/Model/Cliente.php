<?php
    namespace PRJM011\Model;
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;
    
    class Cliente extends Model {
        public static function listAll($act)
        {
            $sql = new Sql();
            
            $results = $sql->select("CALL prc_cliente_lista(:nrocelular, :nome)", array(
                ":nrocelular"=>$act["nrocelular"],
                ":nome"=>$act["nome"],
            ));

            if ($results == '' || $results == NULL) {
                $results[0]["MESSAGE"] = "Não há registros com a informação: ".$act['nrocelular']." ".$act['nome'].".";
            }
            
            return $results;
        }

        public static function listClassification()
        {
            $sql = new Sql();
            return $sql->select("CALL prc_classificacao_sel()");
        }

        public function get($pessoa_id) 
        {
            $sql = new Sql();
            
            $results = $sql->select("CALL prc_cliente_selectById(:pessoa_id)", array(
                ":pessoa_id"=>$pessoa_id
            ));
            
            $data = $results[0];
            
            $this->setData($data);
        }

        public function save()
        {
            $sql = new Sql();
        
            $results = $sql->select("CALL prc_cliente_save(:usuario_id, :nome, :nrocelular, :classificacao_id)", array(
                ":usuario_id"           => $this->getusuario_id(),   
                ":nome"                 => $this->getnome(),   
                ":nrocelular"           => $this->getnrocelular(),   
                ":classificacao_id"     => $this->getclassificacao_id()
            ));
           
            $this->setData($results);
            
            return $results[0]["MESSAGE"];
        }
        
        public function update()
        {
            $sql = new Sql();
                       
            $results = $sql->select("CALL prc_cliente_update(:usuario_id,:pessoa_id,:celular_id, :nome, :nrocelular,:classificacao_id,:situacao)", array(
                ":usuario_id"           => $this->getusuario_id(),   
                ":pessoa_id"            => $this->getpessoa_id(),
                ":celular_id"           => $this->getcelular_id(),
                ":nome"                 => $this->getnome(),   
                ":nrocelular"           => $this->getnrocelular(),   
                ":classificacao_id"     => $this->getclassificacao_id(),
                ":situacao"             => $this->getsituacao()
            ));
           
            $this->setData($results);
            return $results[0]["MESSAGE"];
        }

        public function delete()
        {
            $sql = new Sql();
            
            $sql->query("CALL prc_cliente_delete(:pessoa_id)", array(
                ":pessoa_id"=>$this->getpessoa_id()
            ));
        }
    }
?>
