<?php
date_default_timezone_set('America/Mexico_City');

$tipoDocumento  = $_POST['tipoDocumento'];
$folio          = "";
$serie          = "";
$emisor         = $_POST['r_emisor'];
$receptor       = $_POST['r_receptor'];
$formaPago      = $_POST['forma'];
$metodoPago     = $_POST['metodo'];
$fecha          = $_POST['fecha'];
$moneda         = $_POST['moneda'];
$condicion      = $_POST['condicion'];
$idCliente      = $_POST['idCliente'];
$usoCFDI        = $_POST['usocfdi'];
$conceptoClave  = $_POST['conceptoClave'];

$factura = new FacturacionData();

$factura->tipo_documento    = $tipoDocumento;
$factura->folio             = $folio;
$factura->serie             = $serie;
$factura->rfc_emisor        = $emisor;
$factura->idCliente         = $idCliente;
$factura->rfc_receptor      = $receptor;
$factura->forma             = $formaPago;
$factura->metodo            = $metodoPago;
$factura->moneda            = $moneda;
$factura->condicionPago     = $condicion;
$factura->usuario           = $_SESSION['user_id'];
$factura->usocfdi           = $usoCFDI;
$factura->concepto_clave    = $conceptoClave;


$res = $factura->insertaFactura();


   
    
    $uuid = pruebaTimbrado($res[1]);//funcion para genera el xml
    //$uuid = pruebaTimbrado(181, $datos);//funcion para genera el xml




## **************************************************************************** ##



function pruebaTimbrado($id_doc){

  $datos = new FacturacionData();

    $rfc_emisor     = "";
    $tipo_documento = "";
  
   ## Para obtener el rfc del emisor ##
    $res_emi = $datos->getFacturaByID($id_doc); 

    $rfc_emisor      =$res_emi->rfc_emisor;
    $tipo_documento  =$res_emi->tipo_documento;
  
    $debug = 1;
  
    $numero_certificado = "";
    $archivo_cer = "";
    $archivo_pem = "";
  
    $user_id = "";
    $user_password = "";//SECL891011MN7
  
    //$rfc_emisor="ESI920427886"; //========= variable temporal para pruebas ============

    ## para obtener datos del emisor ##
    $empresa = new EmpresaData();
 
    $res = $empresa->getByRFC($rfc_emisor);
  

  
      $numero_certificado = $res->num_certificado;
      $archivo_cer = "plugins/certificados/".$res->archivo_cer;
      $archivo_pem = "plugins/certificados/".$res->archivo_pem;
     
  
      $user_id          = $res->user_id;
      $user_password    = $res->user_pass;
  
    
  
  
    //Archivos del CSD de prueba proporcionados por el SAT.
    //ver http://developers.facturacionmoderna.com/webroot/CertificadosDemo-FacturacionModerna.zip
   
    //Datos de acceso al ambiente de pruebas
    // $url_timbrado = "https://t2.facturacionmoderna.com/timbrado/wsdl"; //modificado 17112016
    // $user_id = 'SECL891011MN7';
    // $user_password = 'a9de6f6cd0654e266c3b60d7274f0d310fc9083c';  //modificado 17112016
  
    $url_timbrado = "https://t1demo.facturacionmoderna.com/timbrado/wsdl";
    // $url_timbrado = "https://t2.facturacionmoderna.com/timbrado/wsdl"; //modificado 17112016
    
    //generar y sellar un XML con los CSD de pruebas
    
    // $cfdi -> generarXML($rfc_emisor,$id_doc);
    // $cfdi= new fa($this->db);
    $cfdi= generarXML($rfc_emisor,$id_doc);
  // echo $cfdi;
  // return false;
    // $cfdi = sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem);
    // $cfdi= new fa($this->db);
    $cfdi=sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem);
  
  
    $parametros = array('emisorRFC' => $rfc_emisor,'UserID' => $user_id,'UserPass' => $user_password);
  
    $opciones = array();
    
    /**
    * Establecer el valor a true, si desea que el Web services genere el CBB en
    * formato PNG correspondiente.
    * Nota: Utilizar est� opci�n deshabilita 'generarPDF'
    */     
    $opciones['generarCBB'] = false;
    
    /**
    * Establecer el valor a true, si desea que el Web services genere la
    * representaci�n impresa del XML en formato PDF.
    * Nota: Utilizar est� opci�n deshabilita 'generarCBB'
    */
    $opciones['generarPDF'] = true;
    
    /**
    * Establecer el valor a true, si desea que el servicio genere un archivo de
    * texto simple con los datos del Nodo: TimbreFiscalDigital
    */
    $opciones['generarTXT'] = false;
    
  
    $cliente = new FacturacionModerna($url_timbrado, $parametros, $debug);
     
    //print $cfdi."<br>";
    // print $opciones."<br>";
    //exit;
  
  
    if($cliente->timbrar($cfdi, $opciones))
    {
  
      //Almacenanos en la ra�z del proyecto los archivos generados.
      $comprobante = 'comprobantesCfdi/'.$cliente->UUID;
  
      if($cliente->xml){
        //echo "XML almacenado correctamente en $comprobante.xml\n";        
        file_put_contents($comprobante.".xml", $cliente->xml);
      }

      /*if(isset($cliente->pdf)){
        //echo "PDF almacenado correctamente en $comprobante.pdf\n";
        file_put_contents($comprobante.".pdf", $cliente->pdf);
      }
      if(isset($cliente->png)){
        //echo "CBB en formato PNG almacenado correctamente en $comprobante.png\n";
        file_put_contents($comprobante.".png", $cliente->png);
      }*/
      
      //echo "Timbrado exitoso\n";4
      $folio_fiscal = str_replace('comprobantesCfdi/','', $comprobante);
      
      ///====================================== nuevo 131117
      $estatus_factura="2";//estatus de facturado

      

      $datos->folio_fiscal      =$folio_fiscal;
      $datos->estatus_factura   =$estatus_factura;

    //   $datos->set("folio_fiscal", addslashes(utf8_decode($folio_fiscal))); 
    //   $datos->set("estatus_factura", addslashes(utf8_decode($estatus_factura))); 
    //   $datos->set("id_doc", addslashes(utf8_decode($id_doc))); 
    //   $datos->set("tipo_documento", addslashes(utf8_decode($tipo_documento))); 
  
      $update_f     = $datos->update_factura($id_doc,$tipo_documento);
  
      if(!$update_f[0]){echo "error de primera modificacion";}
      
      //=============agrega datos de totales a la base de datos ===============
       //$datos->set("id_doc",addslashes(utf8_decode($id_doc)));
      $answer = $datos->buscatotal($id_doc);

      $subtotal     =0;
      $Ttraslado    =0;
      $Tretencion   =0;
      $total        =0;

      foreach($answer as $row):

      //while($row=mysqli_fetch_array($answer)){
        $subtotal   += $row->valor_unitario * $row->cantidad;
        $Ttraslado  += $row->importe_translado;
        $Tretencion += $row->importe_retencion;
      //}

    endforeach;

  
      $total    = $subtotal + $Ttraslado;
      $total    =$total - $Tretencion;
    
    //   $datos->set("id_doc",addslashes(utf8_decode($id_doc)));
    //   $datos->set("traslado",addslashes(utf8_decode(number_format($Ttraslado,2,'.',''))));
    //   $datos->set("retencion",addslashes(utf8_decode(number_format($Tretencion,2,'.',''))));
    //   $datos->set("subtotal",addslashes(utf8_decode(number_format($subtotal,2,'.',''))));
    //   $datos->set("total",addslashes(utf8_decode(number_format($total,2,'.',''))));

      $datos->traslado  = addslashes(utf8_decode(number_format($Ttraslado,2,'.','')));
      $datos->retencion = addslashes(utf8_decode(number_format($Tretencion,2,'.','')));
      $datos->subtotal  = addslashes(utf8_decode(number_format($subtotal,2,'.','')));
      $datos->total     = addslashes(utf8_decode(number_format($total,2,'.','')));

      $response = $datos->updateTotales($id_doc);
      if(!$response[0]){echo "error de primera modificacion";}
  
      //=================================
  
      //pra acutlaizar los timbres utilizados
      //$datos->set("rfc_emisor", addslashes($rfc_emisor));

      $update_timbres = $datos->update_timbresbyRFCem($rfc_emisor);
  
      if($update_timbres[0]){}
  
     
      echo "factura->".$folio_fiscal;
      return false;
      
    }else{
  
      $error_timbrar = "[".$cliente->ultimoCodigoError."] - ".$cliente->ultimoError;
      
      $ss2="";
      $ff2="";
  
     // $datos->set("serie", addslashes(utf8_decode($ss2)));
      //$datos->set("folio", addslashes(utf8_decode($ff2)));
      //$datos->set("id_doc", addslashes(utf8_decode($id_doc)));
      $datos->serie = addslashes(utf8_decode($ss2));
      $datos->folio = addslashes(utf8_decode($ff2));
      $res_f= $datos->update_f($id_doc);
  
      if($res_f[0]){}
  
     echo  "error->".$error_timbrar;
      return false;
    }  
  
  }



## ************************************************************************************************  ##
  function generarXML($rfc_emisor,$id_doc){
  
    $razon_social="";
    $regimen_fiscal="";
    $cp="";//tomado como lugar de expedicion de la factura
  
    //para obtener datos del emisor
    $empresa = new EmpresaData();
    $resEmpresa = $empresa->getByRFC($rfc_emisor);
  
    $razon_social     =$resEmpresa->razon_social;
    $regimen_fiscal   =$resEmpresa->regimen_fiscal;

    if($regimen_fiscal == "621"){
    $n_regimen_fiscal="Incorporaci�n Fiscal.";
    }else{
    $n_regimen_fiscal="";
    }
    $cp=$resEmpresa->cp;
    
  
    //para obtener el id y rfc del cliente ismael 111117
    //paa obtener datos del receptor
    $id_client="";
    $rfc_cliente="";


    $factura = new FacturacionData();
    $res = $factura->getFacturaByID($id_doc);
    $u_usocfdi="";
    
    $id_client    =$res->idCliente;
    $rfc_cliente  =$res->rfc_receptor;
    $u_usocfdi    =$res->usocfdi;

    //para obtener datos del cliente
    $cliente = new ClienteData();
    $nombre_cliente="";
    $tax_id="";



    // $datos->set("id", addslashes(utf8_decode($id_client)));
    // $datos->set("rfc", addslashes(utf8_decode($rfc_cliente)));

    $resCl= $cliente->getById($id_client);
    $nombre_cliente    =$resCl->razonSocial;
    $rfc_cliente       =$resCl->rfc;

    // $tax_id=$rowC["tax_id"];//campo opcional

  
  
  $rfc_receptor=remplazar($rfc_cliente);
  $rfc_receptor=$rfc_receptor;
  
  $nombre_receptor2=remplazar($nombre_cliente);    
  $nombre_receptor=utf8_encode($nombre_receptor2); 
      
  //====================================================
  
    
    $r_concepto         = "";
    $ImpuestosRetenidos = 0.00;
    $retencion          = null;
    $Traslado           = null;
  
    $tipoDeComprobante  ="";
    $tipo_documento     ="";
  
    $Serie              ="";
    $Folio              ="";
  
  
## **** ##
    $tipo_documento2 = $res->tipo_documento;      
    
    if($tipo_documento2=="Ingreso"){

      $tipo_documento="I";

    }else if($tipo_documento2=="Egreso"){

      $tipo_documento="E";

    }
  
    $tipoDeComprobante = 'TipoDeComprobante="'.$tipo_documento.'"'; //tipo de comprobante
  
    $ff     ="";
    $ss2    ="";
    $ff2    ="";  
    $totF   =0;
  
    $ss     =""; //serie
    $f      ="";  //folio
    
  
    ## para saber cuantos timpos de documentos hay y poner el folio y serie  correspondinte ##
    //$datos->set("rfc",$_SESSION['fa_rfc']);
    //$datos->set("documento", addslashes(utf8_decode($tipo_documento2)));



    $datos = $factura->getUltimoFolio($rfc_emisor,$tipo_documento2);

    $folio=$datos->folio;
    $serie=$datos->serie;
  
    if(($folio==null or $folio=="") or ($serie==null or $serie=="")){
      //$datos->set("rfc",$_SESSION['fa_rfc']);
      //$datos->set('documento', addslashes(utf8_decode($tipo_documento2)));

        $dataSeriFolio->$factura->getSerieFolio($rfc_emisor,$tipo_documento2);
        $ss =$dataSeriFolio->serie;
        $f  =$dataSeriFolio->folio;

    }else{
      $ss=$serie;
      $f=$folio;
    }
   
    $ss2= $ss;
    $ff2=$f;
  
    if(isset($ss2)){
        $Serie='Serie="'.$ss2.'"';
    }else{
      $Serie="";
    }
    if(isset($ff2)){
      $Folio='Folio="'.$ff2.'"';
    }else{
      $Folio="";
    }
  
  
    
    //=======================checar este punto
    // $datos->set("serie", addslashes(utf8_decode($ss2)));
    // $datos->set("folio", addslashes(utf8_decode($ff2)));
    // $datos->set("id_doc", addslashes(utf8_decode($id_doc)));

    $res_f= $factura->updateSerieFolio($ss2,$ff2,$id_doc);
  
    if($res_f){}
     ///================= 
  
    $fecha_actual = substr( date('c'), 0, 19);//fecha que aparecera en la factura
  
    $subtotal=0.00;
    $iva= 0.00;
    $total=0.00;
  
    $Moneda="";//divisa
    $TipoCambio="";//mexicana es 1.000000
   
    $formaDePago="";//PAGO EN UNA SOLA EXHIBICION
    $condicionesDePago="";
    $metodoDePago="";//03
    $metodoDePago2="";//03
    $servicios_f="";
    $sumaTraslado=0;
    $sumaRetencion=0;
    $m="";
  
    $uso_cfdi=$u_usocfdi;//checar si coincide
  
    //====================================================================================
    //$datos->set("id_doc", addslashes(utf8_decode($id_doc)));   
    //$resD= $datos->select_rfactura();
  
    //while($rowD = mysqli_fetch_array($resD, MYSQLI_ASSOC)){
      $formaDePago      =$res->forma;
      $condicionesDePago=$res->condicionPago;
      $metodoDePago     =$res->metodo;
      // $uso_cfdi2=$rowD['usocfdi'];
      $Moneda='Moneda="'.$res->moneda.'"';
  
      if($res->moneda=="MXN"){
        $TipoCambio="";
      }
  
    //}
  
    if(isset($condicionesDePago)){
      $condicionesDePago='CondicionesDePago="'.$condicionesDePago.'"';
      $condicionesDePago = $condicionesDePago;
    }else{
      $condicionesDePago="";
    }
  
  
  
  
    $conceptos=" ";   //almacena la estructura de los conceptos cuando se arman
  
    //almacena los total de los importes de 16, 4, 0
    $importe16 =0.00;
    $importe4 =0.00;
    $importe0 =0.00;
  
    $importe  =0.00;//nuevo agregado para el importe total del iva
  
    ///total de la factura
    $subtotal=0.00;
    /// subtotan de la factura
    $total_factura=0.00;
  
  
    $bandera_tasa16=0;
    $bandera_tasa4=0;
  
  
  
    //$datos->set("id_doc", addslashes(utf8_decode($id_doc)));   
    //$res_F= $datos->select_rfactura();
    //while($row_F = mysqli_fetch_array($res_F, MYSQLI_ASSOC)){
      $concepto_clave =$res->concepto_clave;
//}
  
  
    $id_prod_serv="";
    $cantidad=0;
    $num_identificacion="";
    $clave_unidad="";
    $clave_sat="";
    $tipo_traslado="";
    $t_factor_t="";
    $varlor_tc_traslado="";
    $importe_translado="";
    $tipo_retencion="";
    $t_factor_r="";
    $varlor_tc_retencion="";
    $importe_retencion="";
  
    $valor_unitario="";
    $importe_total="";
  
    //$datos->set("concepto_clave", addslashes(utf8_decode($concepto_clave)));   
    $res_c = $factura->getConceptos($concepto_clave);
  
    // print_r($res_c);
    // exit;
    
//while($row = mysqli_fetch_array($res_c, MYSQLI_ASSOC)){
foreach($res_c as $concepto):
          
          $id_prod_serv ="";
          $cantidad=0;
          $num_identificacion="";
          $clave_unidad="";
          $clave_sat="";
          $tipo_traslado="";
          $t_factor_t="";
          $varlor_tc_traslado="";
          $importe_translado="";
          $tipo_retencion="";
          $t_factor_r="";
          $varlor_tc_retencion="";
          $importe_retencion="";
          $valor_unitario="";
          $importe_total="";
  
            
          $id_prod_serv         =$concepto->id_prod_serv; //id del producto
          $cantidad             =$concepto->cantidad;          
          $num_identificacion   ="";
          $clave_unidad         =$concepto->clave_unidad;
          $clave_sat            =$concepto->clave_sat;
          $valor_unitario       =$concepto->valor_unitario;
          $importe_total        =$concepto->importe_total;
          $descuento            ="0.00";
          $tipo_traslado        =$concepto->tipo_traslado;  //ISR-IVA-IEPS        
          $t_factor_t           =$concepto->tipo_factor_translado; //Tasa Cuota
          $varlor_tc_traslado   =$concepto->valor_tasa_cuota_translado; //
          $importe_translado    =$concepto->importe_translado;  //
          // =======================
          $tipo_retencion       =$concepto->tipo_retencion; //ISR-IVA-IEPS        
          $t_factor_r           =$concepto->tipo_factor_retencion; //Tasa Cuota
          $varlor_tc_retencion  =$concepto->valor_tasa_cuota_retencion; //
          $importe_retencion    =$concepto->importe_retencion;  //
          //=====================================
          $descripcionConcepto  =$concepto->descripcionProd;

  
          $producto = new Productdata();

          //$datos->set("id", addslashes(utf8_decode($id_prod_serv)));   
          //$res_p= $datos->select_producto();

          $dataProducto = $producto->getByIdInfoSAT($id_prod_serv);
  
          $p_clave_interna      ="";
          $p_clave_sat          ="";
          $p_descripcion_sat    ="";
          $p_descripcion_empresa="";
  
          //while($rowp = mysqli_fetch_array($res_p, MYSQLI_ASSOC)){
            $p_clave_interna        ="";
            $p_clave_sat            ="";
            $p_descripcion_sat      ="";
            $p_descripcion_empresa  ="";
  
            $p_clave_interna        =$dataProducto->code;
            $p_clave_sat            =$dataProducto->codigoSAT;
            $p_descripcion_sat      =utf8_decode($dataProducto->descripcionSAT);
            $p_descripcion_empresa  =utf8_decode($dataProducto->description);
          //}
  
          //===========================================
          
          //$subtotal= $subtotal + $importe_total;
          $subtotal = $subtotal + ($valor_unitario * $cantidad);
  
  
          //para colocar los decimales que se necesitan
          
          if($valor_unitario>0){
            $valor_unitario =number_format($valor_unitario, 2, '.', '');
          }else{ $valor_unitario =0.00; }
  
          if($importe_total>0){
            $importe_total =number_format($importe_total, 2, '.', '');
          }else{ $importe_total =0.00; }
  
          if($importe_translado>0){
            $importe_translado =number_format($importe_translado, 2, '.', '');
          }else{ $importe_translado =0.00; }
  
          if($importe_retencion>0){
            $importe_retencion =number_format($importe_retencion, 2, '.', '');
          }else{ $importe_retencion =0.00; }
        
     
            //movido de luggar facturacio 3.3 ismael 231017
            $tasaocuota="";
            $tasaocuota_r="";
  
            $importe_im="";
            $importe_re="";
  
            $importe_nodo="";
            $importe_nodo_r="";
  
            //////////
            // tipo_traslado
            // t_factor_t
            // varlor_tc_traslado
  
            // importe_translado
            
            // tipo_retencion
            // t_factor_r
            // varlor_tc_retencion
            
            // importe_retencion
  
        
          //===============para los traslados
            // if($varlor_tc_traslado == 16){
  
               $tasaocuota=$varlor_tc_traslado;
               $importe_nodo="";
     
               $importe = $importe + $importe_translado; //modificado ismael 160517
               $importe16 = $importe16 + $importe_translado;
               //$retencioniva  =   ($importe_total*$tasaocuota); 
               $retencioniva=$importe_translado;
  
              // $importe_nodo=($importe_total*$tasaocuota);//nuevo agreagdo ismael 231017
               $importe_nodo=$importe_translado;
  
               $bandera_tasa16=1;   
            // }
  
            
  
             
  
  
  
           //====================================par la retencion
            
            if($varlor_tc_retencion >0)
            {
              //$tasaocuota_r="0.040000";//nuevo agragdo ismael 231017 facturacion 3.3. 
              $tasaocuota_r=$varlor_tc_retencion;
              //$ImpuestosRetenidos = $ImpuestosRetenidos + ($retencioniva*.25); 
              $ImpuestosRetenidos += $importe_retencion;
             // $importe_nodo_r=$retencioniva*.25; //nuevo agragdo ismael 231017 facturacion 3.3.          
              $importe_nodo_r=$importe_retencion;
             // $retencioniva=0.00;
            }   
            //modificado ismael 231017
            if($varlor_tc_retencion == 0)
            {
              $tasaocuota_r="0.000000";//nuevo agragdo ismael 231017 facturacion 3.3. 
  
              $importe_nodo_r="0.00"; //nuevo agragdo ismael 231017 facturacion 3.3.        
              $retencioniva=0.00;
            } 
  
             
            //agreagdo ismael facturacion 3.3. 
            if($importe_nodo>0){
              $importe_nodo =number_format($importe_nodo, 2, '.', '');            
            }else{
              $importe_nodo ="0.00";           
            }
  
            if($importe_nodo_r>0){
              $importe_nodo_r =number_format($importe_nodo_r, 2, '.', '');            
            }else{
              $importe_nodo_r ="0.00";            
            }
  
           if($num_identificacion==""){
              $num_identificacion="NA";
           }
        $importe_total2=$valor_unitario * $cantidad;
        $importe_total2=number_format($importe_total2,2,'.','');
  
          if(($importe_nodo==0 && $importe_nodo_r==0) || ($importe_nodo=="" && $importe_nodo_r=="")) {
             $conceptos .= '<cfdi:Concepto ClaveProdServ="'.$clave_sat.'" NoIdentificacion="'.$num_identificacion.'" Cantidad="'.$cantidad.'" ClaveUnidad="'.$clave_unidad.'" Unidad="'.$clave_unidad.'" Descripcion="'.$descripcionConcepto.'" ValorUnitario="'.$valor_unitario.'"  Importe="'.$importe_total2.'" Descuento="'.$descuento.'">
             </cfdi:Concepto>';
          }
  
          if($importe_nodo>0 && ($importe_nodo_r=="" || $importe_nodo_r==0)){
            $conceptos .= '<cfdi:Concepto ClaveProdServ="'.$clave_sat.'" NoIdentificacion="'.$num_identificacion.'" Cantidad="'.$cantidad.'" ClaveUnidad="'.$clave_unidad.'" Unidad="'.$clave_unidad.'" Descripcion="'.$descripcionConcepto.'" ValorUnitario="'.$valor_unitario.'"  Importe="'.$importe_total2.'" Descuento="'.$descuento.'">
              <cfdi:Impuestos>
                <cfdi:Traslados>
                  <cfdi:Traslado Base="'.$importe_total2.'" Impuesto="'.$tipo_traslado.'" TipoFactor="'.$t_factor_t.'"  TasaOCuota="'.$tasaocuota.'" Importe="'.$importe_nodo.'" />
                </cfdi:Traslados>            
              </cfdi:Impuestos>
            </cfdi:Concepto>';
          
          }
  
          if($importe_nodo_r>0 && ($importe_nodo=="" || $importe_nodo==0)){
            $conceptos .= '<cfdi:Concepto ClaveProdServ="'.$clave_sat.'" NoIdentificacion="'.$num_identificacion.'" Cantidad="'.$cantidad.'" ClaveUnidad="'.$clave_unidad.'" Unidad="'.$clave_unidad.'" Descripcion="'.$descripcionConcepto.'" ValorUnitario="'.$valor_unitario.'"  Importe="'.$importe_total2.'" Descuento="'.$descuento.'">
              <cfdi:Impuestos>              
                <cfdi:Retenciones>
                  <cfdi:Retencion Base="'.$importe_total2.'" Impuesto="'.$tipo_retencion.'" TipoFactor="'.$t_factor_r.'" TasaOCuota="'.number_format($tasaocuota_r,6,'.','').'" Importe="'.$importe_nodo_r.'" />
                </cfdi:Retenciones>
              </cfdi:Impuestos>
            </cfdi:Concepto>';
          
          }
  
          if($importe_nodo_r>0 && $importe_nodo>0){
            $conceptos .= '<cfdi:Concepto ClaveProdServ="'.$clave_sat.'" NoIdentificacion="'.$num_identificacion.'" Cantidad="'.$cantidad.'" ClaveUnidad="'.$clave_unidad.'" Unidad="'.$clave_unidad.'" Descripcion="'.$descripcionConcepto.'" ValorUnitario="'.$valor_unitario.'"  Importe="'.$importe_total2.'" Descuento="'.$descuento.'">
              <cfdi:Impuestos>
                <cfdi:Traslados>
                  <cfdi:Traslado Base="'.$importe_total2.'" Impuesto="'.$tipo_traslado.'" TipoFactor="'.$t_factor_t.'"  TasaOCuota="'.$tasaocuota.'" Importe="'.$importe_nodo.'" />
                </cfdi:Traslados>
                <cfdi:Retenciones>
                  <cfdi:Retencion Base="'.$importe_total2.'" Impuesto="'.$tipo_retencion.'" TipoFactor="'.$t_factor_r.'" TasaOCuota="'.number_format($tasaocuota_r,6,'.','').'" Importe="'.$importe_nodo_r.'" />
                </cfdi:Retenciones>
              </cfdi:Impuestos>
            </cfdi:Concepto>';        
          }
  
  
  $sumaTraslado += $importe_nodo;
  $sumaRetencion += $importe_nodo_r;
  
//} ///para la parte de conceptos
endforeach;


  $ImpuestosRetenidos=number_format($sumaRetencion,2,'.','');
  $iva=number_format($sumaTraslado,2,'.',',');
    $iva=$importe;//toma el valor total del iva
  
  
    //$impuesto = "002";
    $impuesto=$tipo_traslado;
  
    $tasa="0.00";
  
    $translados="";//nuevo agrgado ismael
    $translados2="";//nuevo agrgado ismael
  
  
    if($importe > 0){
  
      $translados="<cfdi:Traslados>";
  
     if($bandera_tasa4 == 1){
           $tasa = "0.040000";
           $importe4 = $importe4; //este dato cambia 
           $importe4 =number_format($importe4, 2, '.', '');       
           $Traslado .='<cfdi:Traslado Impuesto="'.$impuesto.'" TipoFactor="Tasa" TasaOCuota="'.$tasa.'" Importe="'.$importe4.'"></cfdi:Traslado>';
  
      }
      //if($bandera_tasa16 == 1){
  
         //$tasa = "0.160000";
      $tasa=$tasaocuota;
  
         $importe16 = $iva;  //este dato cambia 
         $importe16 =number_format($importe16, 2, '.', '');       
         $Traslado .='<cfdi:Traslado Impuesto="'.$impuesto.'" TipoFactor="Tasa" TasaOCuota="'.$tasa.'" Importe="'.$importe16.'"></cfdi:Traslado>';
      //}
  
     $translados2="</cfdi:Traslados>";
  
    }else{
      $translados="";
      $translados2="";
      $Traslado="";
     // $importe = "0.00";
     // $tasa = "0.00";
     // $Traslado .='<cfdi:Traslado Impuesto="'.$impuesto.'" TipoFactor="Tasa" TasaOCuota="'.$tasa.'" Importe="'.$importe.'"></cfdi:Traslado>';
    }
  
  // <!-- $cfdi = <<<XML
  // < ?xml version="1.0" encoding="UTF-8"? >
  // <!-- // <cfdi:Comprobante  xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" $Serie $Folio Fecha="$fecha_actual" Sello="" FormaPago="$formaDePago" NoCertificado="" Certificado="" SubTotal="$subtotal" Total="$total" $tipoDeComprobante MetodoPago="$metodoDePago" $condicionesDePago LugarExpedicion="$cp" $TipoCambio $Moneda Descuento="0.00"> -->
  // <!-- // <cfdi:Emisor Rfc="$rfc_emisor" Nombre="$razon_social" RegimenFiscal="$regimen_fiscal"/> -->
  // <!-- // <cfdi:Receptor Rfc="$rfc_receptor" Nombre="$nombre_receptor" UsoCFDI="$uso_cfdi"/> -->
  // <!-- // <cfdi:Conceptos> -->
  // <!-- //   $conceptos -->
  // <!-- // </cfdi:Conceptos> -->
  // <!-- // <cfdi:Impuestos TotalImpuestosRetenidos="$ImpuestosRetenidos" TotalImpuestosTrasladados="$iva"> -->
  // <!-- //   $retencion        -->
  // <!-- // <cfdi:Traslados>   -->
  // <!-- //   $Traslado -->
  // <!-- // </cfdi:Traslados> -->
  // <!-- // </cfdi:Impuestos> -->
  // <!-- // </cfdi:Comprobante> -->
  // <!-- // XML; -->
  // <!-- //  --> 
  
    $r_concepto = "002";
    //$r_concepto=$tipo_retencion;
  
  
    if($ImpuestosRetenidos > 0){
  
      $ImpuestosRetenidos = $ImpuestosRetenidos;
      $ImpuestosRetenidos =number_format($ImpuestosRetenidos, 2, '.', '');
  
      $retencion = '<cfdi:Retenciones><cfdi:Retencion Impuesto="'.$r_concepto.'" Importe="'.$ImpuestosRetenidos.'" /></cfdi:Retenciones>';
  
    }else{
      // $ImpuestosRetenidos = "0.00";
  
      // $retencion = '<cfdi:Retenciones><cfdi:Retencion Impuesto="'.$r_concepto.'" Importe="'.$ImpuestosRetenidos.'"/></cfdi:Retenciones>';
       $retencion = '';
    }     
  
  
  
    $total2= $subtotal + $iva;
    $total=($total2-$ImpuestosRetenidos);
  
    $iva =number_format($iva, 2, '.', '');
  
      // if ($Traslado == "") {
      //   $Traslado .='<cfdi:Traslado Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.00" Importe="0.00"/>';;        
      // }
      
         
    $subtotal =number_format($subtotal, 2, '.', ''); 
    $total =number_format($total, 2, '.', ''); 
  
 
  
$cfdi = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante  xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" $Serie $Folio Fecha="$fecha_actual" Sello="" FormaPago="$formaDePago" NoCertificado="" Certificado="" SubTotal="$subtotal" Total="$total" $tipoDeComprobante MetodoPago="$metodoDePago" $condicionesDePago LugarExpedicion="$cp" $TipoCambio $Moneda Descuento="0.00">
<cfdi:Emisor Rfc="$rfc_emisor" Nombre="$razon_social" RegimenFiscal="$regimen_fiscal"/>
<cfdi:Receptor Rfc="$rfc_receptor" Nombre="$nombre_receptor" UsoCFDI="$u_usocfdi"/>
<cfdi:Conceptos>
$conceptos
</cfdi:Conceptos>
<cfdi:Impuestos TotalImpuestosRetenidos="$ImpuestosRetenidos" TotalImpuestosTrasladados="$iva">
$retencion 
$translados
$Traslado
$translados2

</cfdi:Impuestos>
</cfdi:Comprobante>
XML;

  //$cfdi = utf8_encode($cfdi);
  
  return $cfdi;


  }//geneara xml



## ************************************************************************************************* ##

function remplazar($campo){//agregado30112016

    $resultado="";
    $cadena_original = $campo;  
    $cadena_buscada1 = '&amp;';

    $cadena_buscada2 = '&';
    $posicion_Con = strpos($cadena_original, $cadena_buscada1);

    if ($posicion_Con !== false) {    
            $resultado = $cadena_original;    
    }else{

            $posicion_Con2 = strpos($cadena_original, $cadena_buscada2); 
            if($posicion_Con2 !== false){    
                $resultado = str_replace("&", "&amp;", $cadena_original);//cadena original

            }else{
            $resultado=$cadena_original;
            }
    }

return $resultado; 
}//fin agreagdo 30112016 //para remplazar el caracter especial &


## **************************************************************************************************** ##

function sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem){
  
    $private = openssl_pkey_get_private(file_get_contents($archivo_pem));
    $certificado = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents($archivo_cer)));
    
    $xdoc = new DomDocument();
    $xdoc->loadXML($cfdi) or die("XML invalido");
  
    // $XSL = new DOMDocument();
    // $XSL->load('../../archivos_fac/utilerias/xslt32/cadenaoriginal_3_2.xslt');
    // 
    $c = $xdoc->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0); //modificado 17112016
    $c->setAttribute('Certificado', $certificado);
    $c->setAttribute('NoCertificado', $numero_certificado);
  
    
     $XSL = new DOMDocument();
     $XSL->load('plugins/xslt33/cadenaoriginal_3_3.xslt');
    
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($XSL);
  
    $cadena_original = $proc->transformToXML($xdoc);    
    openssl_sign($cadena_original, $sig, $private, OPENSSL_ALGO_SHA256);
    $sello = base64_encode($sig);
  
    $c->setAttribute('Sello', $sello);
  
   
    return $xdoc->saveXML();
  
  }

## **************************************************************************************************** ##


  


?>