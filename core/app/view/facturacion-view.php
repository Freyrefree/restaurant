





<?php
$sell = SellData::getById($_GET["id"]);
if($sell!=null):

$empresa = EmpresaData::getById(1);

$receptor = SellData::getSellRFCReceptor($_GET["id"]);

$conceptos = SellData::getSellConceptos($_GET["id"]);



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

    <form class="form-horizontal" method="post" id="addproveedor" action="" role="form">

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
                  <th>Clave SAT</th>
                  <th>Descripción <br> Producto</th>
                  <th>Clave <br> Producto</th>
                  <th>Clave Unidad</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Descuento</th>
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
              $total+=$concepto->cantidad*$concepto->precio;
              
              ?>
                <tr>
                  <td><?php echo $contador++; ?></td>
                  <td><?php echo $concepto->codigoSAT.' - ' .$concepto->descripcionSAT; ?></td>
                  <td><?php echo $concepto->descripcionInterna; ?></td>
                  <td><?php echo $concepto->codigoInterno; ?></td>
                  <td><?php echo $concepto->unidad.' - '.$concepto->nombreUnidadSAT; ?></td>
                  <td><?php echo $concepto->cantidad; ?></td>
                  <td><b>$ <?php echo number_format((float)$concepto->cantidad * $concepto->precio,2,'.','');?></b></td>
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
        <div class="col-md-3">
          <h1>Total: $ <?php echo number_format($total, 2,'.',''); ?></h1>
        </div>
      </div>

      <div class="row">

        <div class="col-md-12" align="right">
        <br>
          <div class="form-group">
           
          </div>
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


