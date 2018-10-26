 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

 <div class="col-sm-12">
                        <div class="white-box">
                        	
                        	<div class="row page-title clearfix">
					            <!-- /.page-title-left -->
					            <div class="page-title-right d-none d-sm-inline-flex">
					                <ol class="breadcrumb">
					                	<li class="breadcrumb-item">
					                    	<h2><i class="glyphicon glyphicon-stats"></i>   <b> Inventario de Ingredientes</b></h2>
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
                                            <th>Codigo</th>
											<th>Nombre</th>
											<th>Unidad</th>
											<th>Disponible</th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    	$curr_products = IngredientData::getAll();
										if(count($curr_products)>0){
                                    ?>
                                    <tbody>
                                      <?php foreach($curr_products as $product):
										$q=Operation2Data::getQYesF($product->id);
										?>
										<tr class="<?php if($q<=$product->inventary_min/2){ echo "danger";}else if($q<=$product->inventary_min){ echo "warning";}?>">
											<td style="width:100px;"><?php echo $product->code; ?></td>
											<td><?php echo $product->name; ?></td>
											<td><?php echo $product->unit; ?></td>
											<td>
												
												<?php echo $q; ?>

											</td>
											<td style="width:93px;">
									<!--		<a href="index.php?view=input&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-circle-arrow-up"></i> Alta</a>-->
											<a href="index.php?view=history&product_id=<?php echo $product->id; ?>" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-time"></i> Historial</a>
											</td>
										</tr>
										<?php endforeach;?>

                                    </tbody>
                                    <?php
									}else{
										?>
										<div class="jumbotron">
											<h2>No hay productos</h2>
											<p>No se han agregado productos a la base de datos, puedes agregar uno dando click en el boton <b>"Agregar Producto"</b>.</p>
										</div>
										<?php
									}

									?>
                                </table>
                            </div>
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
 






