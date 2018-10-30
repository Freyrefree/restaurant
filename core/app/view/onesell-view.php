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
    $sell = SellData::getById($_GET["id"]);
    $mesero = UserData::getById($sell->mesero_id);
    $cajero= null;

    if($sell->is_applied){
      $cajero = UserData::getById($sell->cajero_id);
    }

    $operations = OperationData::getAllProductsBySellId($_GET["id"]);
    $total = 0;
    ?>

    <div class="row">
      <div class="col-md-6">
        <h3>Mesa: <?php echo $sell->item_id; ?></h3>
        <h3>Mesero: <?php echo $mesero->name." ".$mesero->lastname; ?></h3>
      </div>
    </div>

    <?php if(!$sell->is_applied):?>
      <a data-toggle="modal" href="#hola" class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Agregar Producto</a>
    <?php if(Session::getUID()):?>
      <a href="index.php?view=resumen&id=<?php echo $_GET["id"]; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Finalizar Venta</a>
      <a href="core/pdf/documentos/cotizacion_lista.php?id=<?php echo $_GET['id']; ?>" target="_blank" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Imprimir Comanda</a>
    <?php endif; ?>


    <!--**************** Modal ***********************-->
    
    <div class="modal fade" id="hola" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Agregar Pedido</h4>
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

              <input type="hidden" value="1" class="form-control" name="q" id="inputPassword1" required placeholder="Cantidad">            
              <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                <input type="hidden" name="sell_id" value="<?php echo $_GET["id"];?>">
                  <button type="submit" class="btn btn-primary">Agregar Servicio</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--**************** END ***********************-->
    <?php endif; ?>

    <?php if($sell->is_applied==0):?>
      <p class="alert alert-warning"><i class="glyphicon glyphicon-time"></i> Esta venta esta pendiente</p>
    <?php else: ?>
      <p class="alert alert-info"><i class="glyphicon glyphicon-ok-sign"></i> Esta venta esta completada</p>
    <?php endif; ?>


    <table class="table table-bordered table-hover">
      <thead>
        <th>Codigo</th>
        <th>Nombre del servicio</th>
        <th>Precio Unitario</th>
        <th>Total</th>
        <th></th>
      </thead>

      <?php
        foreach($operations as $operation){
        $product  = $operation->getProduct();
      ?>
      <tr>
        <td><?php echo $product->id ;?></td>
        <td><?php echo $product->name ;?></td>
        <td><?php echo $product->price_out ;?></td>
        <td><b>$ <?php echo number_format(($operation->q*$product->price_out), 2,'.','');$total+=$operation->q*$product->price_out;?></b></td>
        <td style="width:90px;">
          <a class="btn btn-warning btn-xs" data-toggle="modal" href="#updateSell<?php echo $product->id; ?>"><i class="glyphicon glyphicon-pencil"></i> </a>
          <?php if(Session::getUID()):?>
          <a href="index.php?view=deletesellitem&operation_id=<?php echo $operation->id; ?>&sell_id=<?php echo $_GET["id"]; ?>" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
          <?php endif; ?>
          <!-- Button trigger modal -->

          <!--**************** Modal ***********************-->
          <div class="modal fade" id="updateSell<?php echo $product->id; ?>" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Actualizar: <?php echo $product->name ;?></h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" method="post" action="index.php?view=updatesellitem" role="form">
                    <div class="form-group">
                      <label for="inputEmail1" class="col-lg-2 control-label">Servicio</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail1" placeholder="Servicio" value="<?php echo $product->name ;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword1" class="col-lg-2 control-label">Cantidad</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputPassword1" name="q" placeholder="Cantidad" value="<?php echo $operation->q ;?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                        <input type="hidden" name="operation_id" value="<?php echo $operation->id; ?>">
                        <input type="hidden" name="sell_id" value="<?php echo $_GET["id"]; ?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </td>
      </tr>
      <?php } ?>
    </table>

    <div class="row">

      <div class="col-md-3">
        <h1>Total: $ <?php echo number_format($total, 2,'.',''); ?></h1>
        <?php if($sell->is_applied):?>
        <h2>Cajero: <?php echo $cajero->name." ".$cajero->lastname; ?></h2>
        <?php endif; ?>
      </div>

      <div class="col-md-3">
      <br><br><br><br>
        <?php if(Session::getUID()):?>
          <?php 
          $user = UserData::getById(Session::getUID());
          if($user->is_admin):?>
            <a href="index.php?view=removesell&id=<?php echo $_GET["id"]; ?>" class="btn pull-right btn-danger"><i class="glyphicon glyphicon-remove"></i> Cancelar servicio</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>

    </div>

  </div>
</div>
<?php else:?>
	501 Internal Error
<?php endif; ?>


