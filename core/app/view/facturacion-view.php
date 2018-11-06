<?php
$sell = SellData::getById($_GET["id"]);
if($sell!=null):

$idUsuario = $_SESSION["user_id"];

$empresa = EmpresaData::getById(1);

$receptor = FacturacionData::getSellRFCReceptor($_GET["id"]);

$conceptos = FacturacionData::getSellConceptos($_GET["id"]);


if (!FacturacionData::getSellExists($_GET["id"])):

  FacturacionData::addConcepto($_GET["id"],$idUsuario);

endif;



?>

<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-pencil'></i><b> Facturación: </b></h2>
          </li>
        </ol>
      </div>
    </div>

    <form  id="formFactura" class="form-horizontal"  role="form">

      <div class="row">

        <div class="col-md-4">
          <div class="form-group">
            <label>Tipo de Comprobante</label>
            <select class="form-control" name="tc" id="tc" readonly  required>
                <option value="">-- Seleccione un tipo de comprobante</option>
                <option value="Ingreso" selected>Ingreso</option>
                <option value="Egreso">Egreso</option>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>RFC Emisor</label>
		        <input type="text" name="r_emisor" id="r_emisor" value="<?php echo $empresa->rfc ?>" class="form-control" required readonly="readonly">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>RFC Receptor</label>
			      <input type="text" name="r_receptor" id="r_receptor" value="<?php echo $receptor[0]->rfc ?>" class="form-control" placeholder="RFC Receptor" readonly>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-4">
          <div class="form-group">
          <label>Forma de Pago</label>
            <select class="form-control" name="forma" id="forma" required>
            <option value="">-- SELECCIONA UNA FORMA DE PAGO --</option>
              <?php foreach(FormaPagoSAT::getAll() as $forma):?>
              <option value="<?php echo $forma->c_formapago; ?>"><?php echo $forma->descripcion; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
          <label>Método de Pago</label>
            <select class="form-control" name="metodo" id="metodo" required>
            <option value="">-- SELECCIONA UN MÉTODO DE PAGO --</option>
              <?php foreach(MetodoPagoSAT::getAll() as $metodo):?>
              <option value="<?php echo $metodo->c_metodopago; ?>"><?php echo $metodo->descripcion; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Fecha</label>
            <input type="text" name="fecha" id="fecha" class="form-control" value="<?=date("Y-m-d")?>" readonly="readonly">     
          </div>
        </div>

      </div>

      <div class="row">

       <div class="col-md-4">
          <div class="form-group">
            <label>Moneda</label>
            <select class="form-control" id="moneda" name="moneda" required>
            <option value="">-- SELECCIONA UNA MONEDA--</option>
              <?php foreach(MonedaSAT::getAll() as $moneda):?>
                <?php if($moneda->c_moneda == "MXN"): ?>
                  <option value="<?php echo $moneda->c_moneda; ?>" selected><?php echo  $moneda->c_moneda."-".$moneda->descripcion; ?></option>
                <?php else: ?>
                  <option value="<?php echo $moneda->c_moneda; ?>"><?php echo $moneda->c_moneda."-".$moneda->descripcion; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Condiciones de pago</label>
			    	<input type="text" name="condicion" id="condicion" class="form-control" value="" >
          </div>
        </div>

         <div class="col-md-4">
          <div class="form-group">
            <label>Uso CFDI</label>
            <input type="hidden" name="usocfdi" id="usocfdi" class="form-control" value="<?php echo $receptor[0]->cfdi ?>" >
			    	<input type="text" name="Dusocfdi" id="Dusocfdi" class="form-control" value="<?php echo $receptor[0]->cfdi."-".$receptor[0]->descripcion?>" >
          </div>
        </div>

      </div>
      
      <hr>
      <h3><strong>Conceptos</strong></h3>
      <hr>

      <div class="row">
        <div class="col-md-12">

         
                        <div class="white-box">

          <div class="table-responsive"> 
            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Clave</th>
                  <th>Cantidad</th>
                  <th>Clave Unidad</th>
                  <th>Valor Unitario</th>
                  <th>Impuesto <br> Translado</th>
                  <th>Tipo <br> Factor <br> Translado</th>
                  <th>Tasa o <br> Cuota</th>
                  <th>Importe <br> Translado</th>
                  <th>Impuesto <br> Retención</th>
                  <th>Tipo <br> Factor <br> Retención</th>
                  <th>Tasa o<br> Cuota</th>
                  <th>Importe<br> Retención</th>
                  <th>Importe Total</th>
                </tr>
              </thead>
              <?php 
              
              if(count($conceptos)>0){
              ?>
              <tbody>
              <?php 
              $contador=1; 
              $total = 0;
              foreach($conceptos as $concepto):
              $total+=$concepto->cantidad*$concepto->valor_unitario;
              
              ?>
                <tr>
                  <td><?php echo $contador++; ?></td>
                  <td><?php echo $concepto->clave_sat ;?></td>
                  <td><?php echo $concepto->cantidad; ?></td>
                  <td><?php echo $concepto->nombreUnidad; ?></td>
                  <td><b>$ <?php echo number_format($concepto->valor_unitario,2,'.',''); ?></b></td>
                  <td><?php echo $concepto->tipo_traslado; ?></td>
                  <td><?php echo $concepto->tipo_factor_translado; ?></td>
                  <td><?php echo $concepto->valor_tasa_cuota_translado; ?></td>
                  <td><?php echo $concepto->importe_translado; ?></td>
                  <td><?php echo $concepto->tipo_retencion; ?></td>
                  <td><?php echo $concepto->tipo_factor_retencion; ?></td>
                  <td><?php echo $concepto->valor_tasa_cuota_retencion; ?></td>
                  <td><?php echo $concepto->importe_retencion; ?></td>
                  <td><b>$ <?php echo number_format((float)$concepto->cantidad * $concepto->valor_unitario,2,'.','');?></b></td>
                  <td></td>
                               
                </tr>
              <?php endforeach;?>

              </tbody>
              <?php
							}else { ?>

                <div class="jumbotron">
                  <h2>No hay conceptos</h2>
                </div>

							<?php } ?>
            </table>
          </div>

        </div></div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <h1>Total: $ <?php echo number_format($total, 2,'.',''); ?></h1>
        </div>

        <div class="col-md-4" align="right">
        <br>
          <button type="submit" class="btn btn-primary">Timbrar</button>
        </div>
      </div>

    </form>

    

  </div>
</div>


<?php endif; ?>

<link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- jQuery -->
<script src="plugins/components/jquery/dist/jquery.min.js"></script>
<script src="plugins/components/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="css/1.2.2/js/dataTables.buttons.min.js"></script>


<script>
    
        $('#example23').DataTable({
            "pageLength": 8,
            "ordering": false,
            "lengthMenu": [[8, 15, 25, 50, -1], [8, 15, 25, 50, "Todos"]],
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            }
        });
  


</script>


<script>

$('#formFactura').submit(function(e) {
  e.preventDefault();
  var data = $(this).serializeArray();
  //data.push({name: 'tag', value: 'login'});
  $.ajax({
      method: "POST",
      url: "index.php?view=lla_agregafactura",
      data: data
  }).done(function(respuesta) {
      
      alert(respuesta);
      
      });
  
});

</script>


<script>
function timbrar(){
  var id = "<?php echo $_GET["id"]; ?>"
  var parametros ="id="+ id;  


     $.ajax({
      data:  parametros,
      url: '../controllers/controller.facturacion.class.php',
      type: 'post',
      beforeSend: function () {  
      $("#procesando").show("slow");                                    
          //$('#myMensajeG').modal('show');
          //$('#mensajesGif').html('<img src="../img/loader1.gif"/>');
          //$("#mensajesC").html("Procesando, espere por favor...");
      },
      success: function(data){ 
      	$("#procesando").hide("slow");
      	console.log("respuesta");
        console.log(data);
          $('#myMensajeG').modal('hide');

          var dato=data;
          var separador= "->";

          var re = dato.split(separador);

          var mensaje=re[0];
          var devuelto=re[1];

          if(mensaje=="factura"){
             borrar_pre(id);//funcion para borrar la prefactura

             $("#id_xml").val(id);
             $("#uuid_xml").val(devuelto);

            // document.getElementById("btnpdf").style.display="block";
             
             downloadxml(devuelto);
          }
          if(mensaje=="error"){
             $('#myModalMensajes').modal('show');
             $('#mensaje10').text(devuelto);            
          }
       }

    });  
 
}
</script>


