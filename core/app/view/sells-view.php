 <!-- ===== Plugin CSS ===== -->
<link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<style>
	.dataTables_filter input {
	background-color: #f5f5f5;
	border : solid 1px rgba(0,0,0,0.3);
	}

</style>

 <div class="col-sm-12">
	<div class="white-box">
		
		<div class="row page-title clearfix">
			<!-- /.page-title-left -->
			<div class="page-title-right d-none d-sm-inline-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<h2><i class='fa fa-shopping-cart'></i> <b>Ventas</b></h2>
					</li>
					<li class="breadcrumb-item">
						<a  class="btn btn-info ripple" href="index.php?view=sells&t=0"> <?php if(isset($_GET["t"]) && $_GET["t"]=="0" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> Pendientes</a>
					</li>
					<li class="breadcrumb-item">
						<a class="btn btn-info ripple" href="index.php?view=sells&t=1"> <?php if(isset($_GET["t"]) && $_GET["t"]=="1" ):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?> Finalizados</a>
					</li>
					<li class="breadcrumb-item">
						<a class="btn btn-info ripple" href="index.php?view=sells"> <?php if(!isset($_GET["t"])):?><i class="glyphicon glyphicon-ok-sign"></i> <?php endif; ?>Todos</a>
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
						<th>Id</th>
						<th>Mesa</th>
						<th>Mesero</th>
						<th>Productos</th>
						<th>Total</th>
						<th>Status</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<?php 
					$products=null;
					if(!isset($_GET["t"])){
					$products = SellData::getAll();
					}else  if(isset($_GET["t"]) && $_GET["t"]=="0" ){
					$products = SellData::getAllUnApplied();
					}
					else  if(isset($_GET["t"]) && $_GET["t"]=="1" ){
					$products = SellData::getAllApplied();
					}
					if(count($products)>0){
				?>
				<tbody>
					<?php foreach($products as $sell):?>
					<tr>
						<td style="width:30px;"><a href="index.php?view=onesell&id=<?php echo $sell->id; ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a></td>
						<td style="width:60px;">#<?php echo $sell->id;?></td>
						<td style="width:60px;"><?php echo $sell->item_id;?></td>

						<td>
							<?php
							$mesero = UserData::getById($sell->mesero_id);
							echo $mesero->name." ".$mesero->lastname;
							?>
						</td>

						<td>
							<?php
							$operations = OperationData::getAllProductsBySellId($sell->id);
								$rx = 0;
								foreach($operations as $operation){
									$rx += $operation->q;
								}
							echo $rx;
							?>
						</td>
					
						<td>
							<?php
							$total=0;
								foreach($operations as $operation){
									$product  = $operation->getProduct();
									$total += $operation->q*$product->price_out;
								}
							echo "<b>$ ".number_format((float)$total, 2, '.', '')."</b>";
							?>			
						</td>

						<td style="width:100px;" align="center">	
							<?php  
								if($sell->is_applied) { echo "<p class='label label-primary'><i class='glyphicon glyphicon-ok'></i> Finalizado</p>"; }
								else { echo "<p class='label label-warning'><i class='glyphicon glyphicon-time'></i> Pendiente</p>"; }
							?>
						</td>

						<td style="width:180px;"><?php echo  $sell->created_at;  ?></td>

					</tr>
					<?php endforeach; ?>

				</tbody>
				<?php }; ?>
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
 

