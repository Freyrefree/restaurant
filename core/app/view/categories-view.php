 

<?php
$user = UserData::getById(Session::getUID());
$grades = CategoryData::getAllActive();
?>
 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

 <div class="col-sm-12">
                        <div class="white-box">
                        	
                        	<div class="row page-title clearfix">
					            <!-- /.page-title-left -->
					            <div class="page-title-right d-none d-sm-inline-flex">
					                <ol class="breadcrumb">
					                	<li class="breadcrumb-item">
					                    	<h2><i class="fa fa-glass"></i>  <b>Categorías</b></h2>
					                    </li>
					                    <li class="breadcrumb-item pull-right"> 
					                    	<a href='index.php?view=newcategory' class="btn btn-info ripple"><i class='glyphicon glyphicon-plus-sign'></i> Agregar Categoria</a>
					                    </li>
					                    
					                    
					                </ol>
					            </div>
					            <!-- /.page-title-right -->
					        </div>
					        <!-- /.page-title -->
                            <?php if(isset($_COOKIE["gradeupdated"])):?>
								<p class="alert alert-success"><i class='glyphicon glyphicon-ok-sign'></i> La categoria <b><?php echo $_COOKIE["gradeupdated"]; ?></b> ha sido actualizada exitosamente.</p>
							<?php 
							setcookie("gradeupdated","",time()-18600);
							endif; ?>

							<?php if(isset($_COOKIE["gradedeleted"])):?>
								<p class="alert alert-danger"><i class='glyphicon glyphicon-minus-sign'></i> La categoria <b><?php echo $_COOKIE["gradedeleted"]; ?></b> ha sido eliminada exitosamente.</p>
							<?php 
						
							endif; ?>
							<?php if(isset($_COOKIE["gradeadded"])):?>
								<p class="alert alert-info"><i class='glyphicon glyphicon-ok-sign'></i> La categoria <b><?php echo $_COOKIE["gradeadded"]; ?></b> ha sido agregada exitosamente.</p>
							<?php 
							setcookie("gradeadded","",time()-18600);
							endif; ?>


                            <div class="table-responsive"> 
                            	<?php if(count($grades)>0):?>
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           <th>Nombre</th>
										   <th></th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
                                      <?php foreach($grades as $career):?>
										<tr>
											<td><b><?php echo $career->name; ?></b></td>
											<td style="width:90px;">
												<a href="index.php?view=delcategory&id=<?php echo $career->id; ?>"  class="btn btn-sm btn-danger"><i class='glyphicon glyphicon-trash'></i></a>
										<!--		<a href="index.php?view=hidecategory&id=<?php echo $career->id; ?>" class="btn btn-sm btn-default tip" title="Desactivar Categoria"><i class='glyphicon glyphicon-eye-close'></i></a> -->
										<script>
											$("#del-<?php echo $career->id?>").click(function(){
												c = alert("Seguro quieres eliminar ??");
												if(c==true){
													window.location = "index.php?view=delcategory&id=<?php echo $career->id; ?>";
												}
											});
										</script>

										 <a class="btn btn-warning btn-xs" data-toggle="modal" href="#updateSell<?php echo $career->id; ?>"><i class="glyphicon glyphicon-pencil"></i> </a>

											<!--************************************** MODAL ***************************************-->
											<div class="modal fade" id="updateSell<?php echo $career->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<form class="form-horizontal" method="post" action="index.php?view=updatecategory" role="form">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Empresa | Actualizar Catgoría</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
													<h5 class="modal-title">Actualizar: <?php echo $career->name ;?></h5>

														<div class="container-fluid">
														
															<div class="row">
																<div class="col-md-12">
																	<div class="form-group">
																		<label for="" class="control">Nombre:</label>
																		<input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="<?php echo $career->name ;?>" required>
																		<input type="hidden" name="sell_id" value="<?php echo $career->id; ?>">
																	</div>
																</div>
															</div>

														</div>

													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
														<button type="submit" class="btn btn-primary">Actualizar</button>
													</div>
												</form>    
												</div>
											</div>
											</div>
											<!--********************************** END ***********************************************-->

										  
											</td>
										</tr>
										<?php endforeach; ?>
                                </table>
                                <?php else: // no careers ?>
								<div class="jumbotron">
									<h2><i class="glyphicon glyphicon-minus-sign"></i> No hay categorias </h2>
								</div>
								<?php endif; ?>
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
 




