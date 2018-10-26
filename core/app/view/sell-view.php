 <?php

if (isset($_SESSION["user_id"])):

	$datos      = UserData::getById($_SESSION["user_id"]);   
  
	$is_admin   = $datos->is_admin;
	$is_mesero  = $datos->is_mesero;
	$is_cajero  = $datos->is_cajero;
  
endif;

 ?>
 <!-- ===== Plugin CSS ===== -->
    <link href="plugins/components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />


<section class="content-header">
		<h2>Venta <small>Buscar producto por nombre o por codigo:</small></h2>
</section>
<section class="content">

<div class="row">
	<div class="col-md-12">
                                        
<!--	<a href="index.php?view=selln" class="btn btn-default btn-lg pull-right">Venta sin factura <i class="glyphicon glyphicon-chevron-right"></i></a> -->

	
		<form>
		<div class="row">
			<div class="col-md-6">
				<input type="hidden" name="view" value="sell">
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
				<input type="text" name="product" class="form-control">
			</div>
			<div class="col-md-3">
			<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
			</div>
		</div>
		</form>


<?php if(isset($_GET["product"])):?>
	<?php
$products = ProductData::getActiveLike($_GET["product"]);
if(count($products)>0){
	?>
	<hr>

 <div class="white-box">
<table class="table">
	<thead>
		<th>Codigo</th>
		<th>Nombre</th>
		<th>Unidad</th>
		<th>Precio unitario</th>
		<th>Cantidad</th>
		<th style="width:100px;"></th>
	</thead>
	<?php
$products_in_cero=0;
	 foreach($products as $product):
$q= ProductData::getAllActive();
	?>
	<?php 
	if($q>0):?>
		<form method="post" action="index.php?view=addtocart&id=<?php echo $_GET['id']; ?>">
	<tr class="<?php if($q<=5){ echo "danger"; }?>">
		<td style="width:80px;"><?php echo $product->id; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->unit; ?></td>
		<td><b>$ <?php echo number_format((float)$product->price_out,2,'.',''); ?></b></td>
		<td>
		<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
		<input type="" class="form-control" required name="q" placeholder="Cantidad de producto ..."></td>

		<td style="width:183px;">
		<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Agregar a mesa</button>
		</td>
	</tr>
	</form>
<?php else:$products_in_cero++;
?>
<?php  endif; ?>
	<?php endforeach;?>
</table>
</div>




<?php if($products_in_cero>0){ echo "<p class='alert alert-warning'>Se omitieron <b>$products_in_cero productos</b> que no tienen existencias en el inventario. <a href='index.php?module=inventary'>Ir al Inventario</a>"; }?>

	<?php
}else { echo "<p class='alert alert-warning'>No hay resultados en la busqueda.</p>"; }
?>
<br><hr>
<hr><br>
<?php else:
?>

<?php endif; ?>

<?php if(isset($_SESSION["errors"])):?>
<h2>Errores</h2>
<p></p>
<table class="table table-bordered table-hover">
<tr class="danger">
	<th>Codigo</th>
	<th>Producto</th>
	<th>Mensaje</th>
</tr>
<?php foreach ($_SESSION["errors"]  as $error):
$product = ProductData::getById($error["product_id"]);
?>
<tr class="danger">
	<td><?php echo $product->id; ?></td>
	<td><?php echo $product->name; ?></td>
	<td><b><?php echo $error["message"]; ?></b></td>
</tr>

<?php endforeach; ?>
</table>
<?php
unset($_SESSION["errors"]);
 endif; ?>


<!--- Carrito de compras :) -->
<?php if(isset($_SESSION["cart"])):
$total = 0;
?>
<hr>

 <div class="white-box">
<h2>Lista de venta</h2>

<form method="post" action="index.php?view=processsell" class="form-horizontal" id="process">
  <div class="form-group">
    <div class="col-lg-3">
    <label for="inputEmail1" class="control-label">Personas</label>
	<input type="number" min="1" value="1" name="q" id="theq" class="form-control" placeholder="Personas">

    </div>
    <div class="col-lg-3">
    <label for="inputEmail1" class="control-label">No. Mesa</label>
	<select class="form-control" required name="mesa" id="mesa"> 
			<option value=""> -- No. MESA -- </option>
		<?php foreach(ItemData::getAll() as $item):?>
			<option value="<?php echo $item->id; ?>" <?php if($item->id!=null&& $item->id==$_GET['id']){ echo "selected";}?> > <?php echo $item->name; ?> </option>
		<?php endforeach; ?>
			</select>

    </div>
    <div class="col-lg-3">
    <label for="inputPassword1" class="control-label">Mesero</label>
	<select class="form-control" id="mesero" name="mesero_id" required>
			<option value=""> -- SELECCIONE MESERO-- </option>

				<?php if($is_mesero == 1): $mesero = UserData::getById($_SESSION["user_id"]); ?>

					<option value="<?php echo $mesero->id; ?>" selected> <?php echo $mesero->name." ".$mesero->lastname; ?> </option>
				
				<?php else: ?>


					<?php foreach (Userdata::getAllMeseros() as $mesero):?>
						<option value="<?php echo $mesero->id; ?>"> <?php echo $mesero->name." ".$mesero->lastname; ?> </option>
					<?php endforeach; ?>

				<?php endif; ?>

			</select>
    </div>
    <div class="col-lg-3">
    <label for="inputEmail1" class="control-label">Finalizar</label><br>
        <button class="btn btn-primary" type="submit"> Finalizar Venta</button>
        </div>


  </div>
</form>

<div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                </div>
                                <div class="box-body table-responsive">
<table class="table table-bordered table-hover datatable">
<thead>
	<th style="width:50px; padding: 1px 1px;font-size: 14px;">Codigo</th>
	<th style="width:50px; padding: 1px 1px;font-size: 14px;">Cantidad</th>
	<th style="width:50px; padding: 1px 1px;font-size: 14px;">Unidad</th>
	<th>Producto</th>
	<th style="width:190px; padding: 1px 1px;font-size: 14px;">Precio Unitario</th>
	<th style="width:190px; padding: 1px 1px;font-size: 14px;">Precio Total</th>
	<th ></th>
</thead>
<?php foreach($_SESSION["cart"] as $p):
$product = ProductData::getById($p["product_id"]);
?>
<tr >
	<td style="padding: 1px 1px;font-size: 14px;"><?php echo $product->id; ?></td>
	<td style="padding: 1px 1px;font-size: 14px;"><?php echo $p["q"]; ?></td> 
	<td style="padding: 1px 1px;font-size: 14px;"><?php echo $product->unit; ?></td>
	<td style="padding: 1px 1px;font-size: 14px;"><?php echo $product->name; ?></td>
	<td style="padding: 1px 1px;font-size: 14px;"><b>$ <?php echo number_format((float)$product->price_out, 2, '.', ''); ?></b></td>
	
	<td style="padding: 1px 1px;font-size: 14px;"><b>$ <?php  $pt = $product->price_out*$p["q"]; $total +=$pt; echo number_format((float)$pt, 2,'.',''); ?></b></td>
	<td style="width:30px;padding: 1px 1px;font-size: 14px;"><a href="index.php?view=clearcart&product_id=<?php echo $product->id; ?>" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
</tr>

<?php endforeach; ?>
</table>
</div>
</div>
<h2>Resumen</h2>
<div class="row">
<div class="col-md-6 col-md-offset-6">

<div class="table-responsive">
<table class="table">
<tr>
	<td style="padding: 1px 1px;font-size: 14px;"><p>Subtotal</p></td>
	<td style="padding: 1px 1px; font-size: 14px;"><p><b>$ <?php echo number_format(($total * .84), 2,'.',''); ?></b></p></td>
</tr>
<tr>
	<td style="padding: 1px 1px; font-size: 14px;"> <p>IVA</p></td>
	<td style="padding: 1px 1px; font-size: 14px;"><p><b>$ <?php echo number_format(($total * .16), 2,'.',''); ?></b></p></td>
</tr>
<tr>
	<td style="padding: 1px 1px; font-size: 14px;"><p>Total</p></td>
	<td style="padding: 1px 1px; font-size: 14px;"><p><b>$ <?php echo number_format($total,2); ?></b></p></td>
</tr>

</table>
</div>

<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
   
        <label>
		<a href="index.php?view=clearcart" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar todo el pedido</a>
        </label>
     
    </div>
  </div>
</form>

</div>
</div>

<br><br><br><br><br>
<?php endif; ?>

</div>
	</div>
</div>
</section>

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
