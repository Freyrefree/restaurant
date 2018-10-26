<?php
include "../../autoload.php";
include "../../app/model/SellData.php";
include "../../app/model/UserData.php";
include "../../app/model/ProductData.php";
include "../../app/model/ClienteData.php";
include "../../app/model/OperationData.php";


	require_once(dirname(__FILE__).'/../html2pdf.class.php');
		

    
     include(dirname('__FILE__').'/factura/pedido_html.php');
    $content = ob_get_clean();

    try
    {
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
