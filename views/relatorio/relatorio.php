<?php
    namespace PRJM011\Model;
    //require_once("../../vendor/prjm011/php-classes/src/DB/Sql.php")
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;

    class Relatorio extends Model {
        public static function listAll($list)
        {
            $sql = new Sql();
            
            $list["start"] = 0;
            $pg = isset($_GET["pg"]) ? $_GET["pg"] : 1;
            $list["limit"] = (isset($list["limit"]) && $list["limit"] != '') ? $list["limit"] : 10;
            $list["start"] = ($pg - 1) * $list["limit"];
            
            $results = $sql->select("CALL prc_cliente_lista(:nrocelular, :nome,:start,:limit)", array(
                ":nrocelular"=>$list["nrocelular"],
                ":nome"=>$list["nome"],
                ":start"=> $list["start"],
                ":limit"=>$list["limit"],
            ));

            if ($results == '' || $results == NULL) {
                $results[0]["MESSAGE"] = "Não há registros com a informação: ".$list['nrocelular']." ".$list['nome'].".";
            }
            return $results;
        }
?>


