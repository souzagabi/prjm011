<?php
    namespace PRJM011\Model;
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;
    
    class Cliente extends Model {
        public static function listAll($list)
        {
            $sql = new Sql();
            
            if (!isset($list["report"])) {
                $list["start"] = 0;
                $pg = isset($_GET["pg"]) ? $_GET["pg"] : 1;
                $list["limit"] = (isset($list["limit"]) && $list["limit"] != '') ? $list["limit"] : 10;
                $list["start"] = ($pg - 1) * $list["limit"];
            } else {
                $list["limit"] = 0;
                $list["start"] = 0;
            }
            
            $results = $sql->select("CALL prc_cliente_lista(:nrocelular, :nome,:start,:limit)", array(
                ":nrocelular"=>$list["nrocelular"],
                ":nome"=>$list["nome"],
                ":start"=> $list["start"],
                ":limit"=>$list["limit"]
            ));

            if ($results == '' || $results == NULL) {
                $results[0]["MESSAGE"] = "Não há registros com a informação: ".$list['nrocelular']." ".$list['nome'].".";
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
            
            $results = $sql->select("CALL prc_pessoa_delete(:pessoa_id)", array(
                ":pessoa_id"=>$this->getpessoa_id()
            ));
            
            $this->setData($results);
            return $results[0]["MESSAGE"];
        }
    }
?>
