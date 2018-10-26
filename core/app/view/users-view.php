
 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

 <div class="col-sm-12">
                        <div class="white-box">
                        	
                        	<div class="row page-title clearfix">
					            <!-- /.page-title-left -->
					            <div class="page-title-right d-none d-sm-inline-flex">
					                <ol class="breadcrumb">
					                	<li class="breadcrumb-item">
					                    	<h2><i class="fa fa-user"></i>  <b>Lista de Usuarios</b></h2>
					                    </li>
					                    <li class="breadcrumb-item pull-right"> 
					                    	<div class="btn-group">
											  <button type="button" class="btn btn-info ripple dropdown-toggle" data-toggle="dropdown">
											    <i class='glyphicon glyphicon-user'></i> Nuevo Usuario
											  </button>
											  <ul class="dropdown-menu" role="menu">
											<!--    <li><a href="index.php?view=newadmin">Nuevo Administrador</a></li> -->
											    <li><a href="index.php?view=newcajero">Nuevo Cajero</a></li>
											    <li><a href="index.php?view=newmesero">Nuevo Mesero</a></li>
											  </ul>
											</div>
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
                                            <th>Nombre completo</th>
											<th>Email</th>
											<th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    	$users = UserData::getAll();
										if(count($users)>0){
                                    ?>
                                    <tbody>
                                      <?php foreach($users as $user){
										?>
										<tr>
										<td><?php echo $user->name." ".$user->lastname; ?></td>
										<td><?php echo $user->email; ?></td>
										<td>
											<?php 
											if($user->is_admin){ echo "Adminsitrador"; }
											else if($user->is_mesero){ echo "Mesero"; }
											else if($user->is_cajero){ echo "Cajero"; }
											?>

										</td>
										<td style="width:90px;">
											<a href="index.php?view=edituser&id=<?php echo $user->id; ?>" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
											<a href="index.php?view=deluser&id=<?php echo $user->id; ?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>

										</td>
										</tr>
										<?php

									} ?>

                                    </tbody>
                                    <?php
									}else{
											// no hay usuarios
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
 



