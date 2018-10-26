<?php
$products = ProductData::getAll();
$meseros = UserData::getAllMeseros();
?>
<section class="content">
<div class="row">
	<div class="col-md-12">
	<h1>Reportes</h1>

						<form>
						<input type="hidden" name="view" value="reports">
<div class="row">
<div class="col-md-3">
<input type="hidden" name="product_id" value="" />
</div>
<div class="col-md-3">
<H3>DE:</H3> <input type="date" name="sd" value="<?php if(isset($_GET["sd"])){ echo $_GET["sd"]; }?>" class="form-control">
</div>
<div class="col-md-3">
 <h3>A:</h3> <input type="date" name="ed" value="<?php if(isset($_GET["ed"])){ echo $_GET["ed"]; }?>" class="form-control">
</div>

<div class="col-md-3">
<H3>PROCESAR</H3><input type="submit" class="btn btn-success btn-block" value="Procesar">
</div>

</div>
<a href="core/pdf/documentos/reporte.php" target="_blank" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> IMPRIMIR REPORTE DIARIO</a>
<!--
<br>
<div class="row">
<div class="col-md-4">

<select name="mesero_id" class="form-control">
	<option value="">--  MESEROS --</option>
	<?php foreach($meseros as $p):?>
	<option value="<?php echo $p->id;?>"><?php echo $p->name;?></option>
	<?php endforeach; ?>
</select>

</div>

<div class="col-md-4">

<select name="operation_type_id" class="form-control">
	<option value="1">VENTA</option>
</select>

</div>

</div>
-->
</form>

	</div>
	</div>
<br><!--- -->


 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

 <div class="col-sm-12">
                        <div class="white-box">
                        	
                            <?php if(isset($_GET["sd"]) && isset($_GET["ed"]) ):?>
							<?php if($_GET["sd"]!=""&&$_GET["ed"]!=""):?>
							<?php  $operations = array();

										if($_GET["product_id"]==""){
										$operations = OperationData::getAllByDateOfficial($_GET["sd"],$_GET["ed"]);
										}
										else{
										$operations = OperationData::getAllByDateOfficialBP($_GET["product_id"],$_GET["sd"],$_GET["ed"]);
										} 


										 ?>

							<?php if(count($operations)>0):?>
                            <div class="table-responsive"> 
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
											<th>Producto</th>
											<th>Cantidad</th>
											<th>Operacion</th>
											<th>Fecha</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                      <?php foreach($operations as $operation):?>
											<tr>
												<td><?php echo $operation->id; ?></td>
												<td><?php echo $operation->getProduct()->name; ?></td>
												<td><?php echo $operation->q; ?></td>
												<td><?php echo $operation->getOperationType()->name; ?></td>
												<td><?php echo $operation->created_at; ?></td>
											</tr>
										<?php endforeach; ?>


                                    </tbody>
                                      <?php else:
														 // si no hay operaciones
														 ?>
											<script>
												$("#wellcome").hide();
											</script>
											<div class="jumbotron">
												<h2>No hay operaciones</h2>
												<p>El rango de fechas seleccionado no proporciono ningun resultado de operaciones.</p>
											</div>

									<?php endif; ?>
                                </table>
                            </div>

                            <?php else:?>
							<script>
								$("#wellcome").hide();
							</script>
							<div class="jumbotron">
								<h2>Fecha Incorrectas</h2>
								<p>Puede ser que no selecciono un rango de fechas, o el rango seleccionado es incorrecto.</p>
							</div>
							<?php endif;?>

							<?php endif; ?>
                        </div>
                    </div>


 <!-- /#wrapper -->
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
 




<br><br><br><br>
</section>