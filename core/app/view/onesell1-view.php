<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>
<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-list'></i><b> Resumen de Venta</b></h2>
          </li>
        </ol>
      </div>
    </div>

    <?php
    $sell     = SellData::getById($_GET["id"]);
    $cliente  = ClienteData::getById($sell->cliente_id);
    $cajero   = null;

    if($sell->is_applied){
      $cajero = UserData::getById($sell->cajero_id);
    }

    $operations = OperationData::getAllProductsBySellId($_GET["id"]);
    $total = 0;
    ?>

    <div class="row">
      <div class="col-md-6">
        <h3>Mesa: <?php echo $sell->item_id; ?></h3>
        <h3>Cliente: <?php echo utf8_encode($cliente->razonSocial)." ".$cliente->rfc; ?></h3>
      </div>
    </div>


    <?php if(!$sell->is_applied):?>
      <a data-toggle="modal" href="#hola" class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Producto</a>

      <?php if(Session::getUID()):?>
        <a href="index.php?view=resumen&id=<?php echo $_GET["id"]; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Finalizar Venta</a>
        <a href="core/pdf/documentos/cotizacion_lista.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Imprimir comanda</a>
      <?php endif; ?>

      
        <!-- Modal -->
        <div class="modal fade" id="hola" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Agregar Producto</h4>
              </div>
              <div class="modal-body">
              <form class="form-horizontal" method="post" action="index.php?view=addoperation" role="form">
                <div class="form-group">
                  <label for="inputEmail1" class="col-lg-2 control-label">Producto</label>
                  <div class="col-lg-10">
                    <select name="product_id" class="form-control" required>
                    <option value="">-- SELECCIONA UN PRODUCTO -- </option>
                    <?php foreach(ProductData::getAllActive() as $product):?>
                    <option value="<?php echo $product->id; ?>" ><?php echo $product->name; ?></option>
                    <?php endforeach ; ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputPassword1" class="col-lg-2 control-label">Cantidad</label>
                  <div class="col-lg-10">
                    <input type="number" class="form-control" name="q" id="inputPassword1" required placeholder="Cantidad">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-offset-2 col-lg-10">
                  <input type="hidden" name="sell_id" value="<?php echo $_GET["id"];?>">
                    <button type="submit" class="btn btn-primary">Agregar Producto</button>
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
        <!-- END -->

    <?php endif; ?>


    <?php if($sell->is_applied==0):?>
      <p class="alert alert-warning"><i class="glyphicon glyphicon-time"></i> Esta venta esta pendiente</p>
    <?php else: ?>
      <p class="alert alert-info"><i class="glyphicon glyphicon-ok-sign"></i> Esta venta esta completada</p>
    <?php endif; ?>

    <table class="table table-bordered table-hover">
      <thead>
        <th>Codigo</th>
        <th>Cantidad</th>
        <th>Nombre del Producto</th>
        <th>Precio Unitario</th>
        <th>Total</th>
      </thead>

      <?php
        foreach($operations as $operation){
        $product  = $operation->getProduct();
      ?>
      <tr>
        <td><?php echo $product->id ;?></td>
        <td><?php echo $operation->q ;?></td>
        <td><?php echo $product->name ;?></td>
        <td><?php echo $product->price_out ;?></td>
        <td><b>$ <?php echo number_format(($operation->q*$product->price_out), 2,'.','');$total+=$operation->q*$product->price_out;?></b></td>
      </tr>

      <?php } ?>
    </table>

      <div class="row">
        <div class="col-md-3">
          <h4>Subtotal: $ <?php echo number_format(($total*0.84), 2,'.',''); ?></h4>
          <h4>IVA: $ <?php echo number_format(($total*0.16), 2,'.',''); ?></h4>
          <h4>Total: $ <?php echo number_format($total, 2,'.',''); ?></h4>
        </div>

        <div class="col-md-4"  align="left">
        <br><br>

          <?php if($sell->is_applied):?>
          <h4>
            <!-- <a href="core/pdf/documentos/factura.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-warning"><i class="glyphicon glyphicon-print"></i> Imprimir Factura</a> -->
            <a href="index.php?view=facturacion&id=<?php echo $_GET['id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-file"></i>Facturar</a>
            <a href="core/pdf/documentos/boleta.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Imprimir Boleta</a>
          </h4>
          <?php endif; ?>
          
        </div>
      </div>





  </div>
</div>

<?php else:?>
	501 Internal Error
<?php endif; ?>

