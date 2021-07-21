<?php
    namespace PRJM011\Model;
    use \PRJM011\DB\Sql;
    use \PRJM011\Model;
    use \PRJM011\Mailer;
    
    // include autoloader
    require_once 'dompdf/autoload.inc.php';
    //require_once 'dompdf/autoload.inc.php';
    
    class Relatorio extends Model {
        //Carregando a biblioteca de gerar arquivo em PDF
        public static function converterParaPDF(){
            $pdf = new dompdf();
        
            $date = explode(" ",date('d-m-Y H:i:s'));
            
            //Início da página
            $pdf->load_html('
                <h1 style="textalign: center;">Controle de Castratro</h1>
            ');
            
            $pdf->render();

            $pdf->stream(
                "relatorio.pdf", array(
                    "Attachment"=> true
                ));
        }
    }

?>
