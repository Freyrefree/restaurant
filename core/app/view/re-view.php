<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-plus'></i><b> Reabastecer Inventario (Ingredientes)</b></h2>
          </li>
        </ol>
      </div>
    </div>

		<p><b>Buscar producto por nombre o por codigo:</b></p>
			<form>
			<div class="row">
				<div class="col-md-6">
					<input type="hidden" name="view" value="re">
					<input type="text" name="product" class="form-control">
				</div>
				<div class="col-md-3">
				<button type="submit" class="btn btn-primary"> Buscar</button>
				</div>
			</div>
			</form>

			<?php if(isset($_GET["product"])):?>


				<!--  -->

					<?php
					$products = IngredientData::getLike($_GET["product"]);
					if(count($products)>0){
						?>
					<h3>Resultados de la Busqueda</h3>
					<table class="table table-bordered table-hover">
						<thead>
							<th>Codigo</th>
							<th>Nombre</th>
							<th>Unidad</th>
							<th>Precio unitario</th>
							<th>En inventario</th>
							<th>Cantidad</th>
							<th style="width:100px;"></th>
						</thead>
						<?php
						$products_in_cero=0;
						foreach($products as $product):
						$q= Operation2Data::getQYesF($product->id);
						?>
						<form method="post" action="index.php?view=addtore">
							<tr class="<?php if($q<=$product->inventary_min){ echo "danger"; }?>">
								<td style="width:80px;"><?php echo $product->id; ?></td>
								<td><?php echo $product->name; ?></td>
								<td><?php echo $product->unit; ?></td>
								<td><b>$ <?php echo number_format((float)$product->price_in, 2,'.',''); ?></b></td>
								<td>
									<?php echo $q; ?>
								</td>
								<td>
								<input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
								<input type="" class="form-control" required name="q" placeholder="Cantidad de producto ..."></td>
								<td style="width:100px;">
								<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Agregar</button>
								</td>
							</tr>
						</form>
						<?php endforeach;?>
					</table>

						<?php } ?>

					<br><hr><br>

					<?php else:  ?>
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
					$product = IngredientData::getById($error["product_id"]);
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
					<?php if(isset($_SESSION["reabastecer"])):
					$total = 0;
					?>
					<h2>Lista de Reabastecimiento</h2>
					<table class="table table-bordered table-hover">
						<thead>
							<th style="width:30px;">Codigo</th>
							<th style="width:30px;">Cantidad</th>
							<th style="width:30px;">Unidad</th>
							<th>Producto</th>
							<th style="width:30px;">Precio Unitario</th>
							<th style="width:30px;">Precio Total</th>
							<th ></th>
						</thead>
						<?php foreach($_SESSION["reabastecer"] as $p):
						$product = IngredientData::getById($p["product_id"]);
						?>
						<tr >
							<td><?php echo $product->id; ?></td>
							<td ><?php echo $p["q"]; ?></td>
							<td><?php echo $product->unit; ?></td>
							<td><?php echo $product->name; ?></td>
							<td><b>$ <?php echo number_format((float)$product->price_in, 2,'.',''); ?></b></td>
							<td><b>$ <?php  $pt = $product->price_in*$p["q"]; $total +=$pt; echo number_format((float)$pt, 2,'.',''); ?></b></td>
							<td style="width:30px;"><a href="index.php?view=clearre&product_id=<?php echo $product->id; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a></td>
						</tr>
						<?php endforeach; ?>

					</table>

					<form method="post" class="form-horizontal" id="processsell" action="index.php?view=processre">
						<h2>Resumen</h2>
						<div class="row">
							<div class="col-md-6">
								<table class="table table-bordered">
									<tr>
										<td><p>Subtotal</p></td>
										<td><p><b>$ <?php echo number_format((float)($total*.84), 2,'.',''); ?></b></p></td>
									</tr>
									<tr>
										<td><p>IVA</p></td>
										<td><p><b>$ <?php echo number_format((float)($total*.16), 2,'.',''); ?></b></p></td>
									</tr>
									<tr>
										<td><p>Total</p></td>
										<td><p><b>$ <?php echo number_format((float)$total,2,'.',''); ?></b></p></td>
									</tr>
								</table>
							</div>

							<div class="col-md-6" align="right">
								<br><br><br><br><br><br><br>

								<input name="is_oficial" type="hidden" value="1">
								<a href="index.php?view=clearre" class="btn btn-lg btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
								<button class="btn btn-lg btn-primary"><i class="fa fa-refresh"></i> Procesar Reabastecimiento</button>

							</div>

						</div>
					</form>

				<!-- l -->
			<?php endif; ?>
  </div>
</div>




