

<?php
if(isset($_GET["product_id"])):
$product = IngredientData::getById($_GET["product_id"]);
$operations = Operation2Data::getAllByProductId($product->id);
?>

<div class="row">
                    <div class="col-md-4 col-sm-12">
                    	<?php $itotal = Operation2Data::GetInputQYesF($product->id);?>

                        <div class="white-box bg-primary color-box">
                            <h1 class="text-white font-light m-b-0"><?php echo $itotal; ?></h1>
                            <span class="hr-line"></span>
                            <h2 class="cb-text">Entradas</h2>
                            
                            <div class="chart">
                                <b><i class="fa fa-arrow-down" style="font-size: 65px;"></i></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                    	<?php $total = Operation2Data::GetQYesF($product->id); ?>
                        <div class="white-box bg-success color-box">
                            <h1 class="text-white font-light m-b-0"><?php echo $total; ?></h1>
                            <span class="hr-line"></span>
                            <h2 class="cb-text">Disponibles</h2>
                            <div class="chart">
                                <b><i class="fa fa-check" style="font-size: 65px;"></i></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                    	<?php $ototal = -1*Operation2Data::GetOutputQYesF($product->id); ?>
                        <div class="white-box bg-danger color-box">
                            <h1 class="text-white font-light m-b-0"><?php echo $ototal; ?></h1>
                            <span class="hr-line"></span>
                            <h2 class="cb-text">Salidas</h2>
                            <div class="chart">
                                <b><i class="fa fa-arrow-up" style="font-size: 65px;"></i></b>
                            </div>
                        </div>
                    </div>
                </div>





 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

 <div class="col-sm-12">
                        <div class="white-box">
                        	
                        	<div class="row page-title clearfix">
					            <!-- /.page-title-left -->
					            <div class="page-title-right d-none d-sm-inline-flex">
					                <ol class="breadcrumb">
					                	<li class="breadcrumb-item">
					                    	<h2><i class="fa fa-glass"></i>  <b><?php echo $product->name;; ?> <small>Historial</small></b></h2>
					                    </li>

					                </ol>
					            </div>
					            <!-- /.page-title-right -->
					        </div>
					        <!-- /.page-title -->
                            
                            <div class="table-responsive"> 
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           <th></th>
											<th>Cantidad</th>
											<th>Tipo</th>
											<th>Fecha</th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    if(count($operations)>0):
                                    ?>
                                    <tbody>
                                      <?php foreach($operations as $operation):?>
										<tr>
										<td></td>
										<td><?php echo $operation->q; ?></td>
										<td><?php echo $operation->getOperationType()->name; ?></td>
										<td><?php echo $operation->created_at; ?></td>
										<td style="width:40px;"><a href="#" id="oper-<?php echo $operation->id; ?>" class="btn tip btn-xs btn-danger" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a> </td>
										<script>
										$("#oper-"+<?php echo $operation->id; ?>).click(function(){
											x = confirm("Estas seguro que quieres eliminar esto ??");
											if(x==true){
												window.location = "index.php?view=deleteoperation&ref=history&pid=<?php echo $operation->product_id;?>&opid=<?php echo $operation->id;?>";
											}
										});

										</script>
										</tr>
										<?php endforeach; ?>

                                    </tbody>
									<?php endif; ?>
                                   
                                </table>
                            </div>
                        </div>
                    </div>

<?php endif; ?>

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
 


