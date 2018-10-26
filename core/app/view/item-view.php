
 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

 <div class="col-sm-12">
                        <div class="white-box">
                        	
                        	<div class="row page-title clearfix">
					            <!-- /.page-title-left -->
					            <div class="page-title-right d-none d-sm-inline-flex">
					                <ol class="breadcrumb">
					                	<li class="breadcrumb-item">
					                    	<h2><i class="fa fa-table"></i>  <b>Mesas</b></h2>
					                    </li>
					                    <li class="breadcrumb-item pull-right"> 
					                    	<a href="index.php?view=newitem" class="btn btn-info ripple"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Mesa</a>
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
                                            <th>Nombres</th>
		 
											<th></th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    	$products = ItemData::getAll();
										if(count($products)>0){
                                    ?>
                                    <tbody>
                                     <?php foreach($products as $product):?>
										<tr>
											<td><?php echo $product->name; ?></td>
											
											<td style="width:170px;">
											<a href="index.php?view=edititem&id=<?php echo $product->id; ?>" title="Editar Producto" class="btn tip btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
									        <a href="index.php?view=delitem&id=<?php echo $product->id; ?>" title="Editar Producto" class="btn tip btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
											</td>
										</tr>
										<?php endforeach;?>

                                    </tbody>
                                    <?php
									}else{
										?>
										<div class="jumbotron">
											<h2>No hay items</h2>
											<p>No se han agregado item a la base de datos, puedes agregar uno dando click en el boton <b>"Agregar "</b>.</p>
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
 




