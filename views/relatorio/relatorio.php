<?php
    //Carregando a biblioteca de gerar arquivo em PDF
    require_once("../../php/fpdf183/fpdf.php");
    function conferterDadosEmPDF(){
        $pdf = new FPDF();
    
        $date = explode(" ",date('d-m-Y H:i:s'));
        
        //Início da página
        $pdf->AddPage();
        $nomeArquivo = "relatorio".$date[0]."_".$date[1].".pdf";
    
    
        $tipo_pdf = "I";
        //Fim da página

        $pdf->OutPut($nomeArquivo,$tipo_pdf);
    }
?>
