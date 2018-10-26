
<?php $user = UserData::getById(Session::getUID()); ?>


<div class="white-box">
<div class="row page-title clearfix">
    <!-- /.page-title-left -->
    <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <h2><i class="fa fa-desktop"></i>  <b>Monitor</b></h2>
            </li>
        </ol>
    </div>
    <!-- /.page-title-right -->
</div>
<!-- /.page-title -->


<div class="row colorbox-group-widget">
    
<?php foreach(ItemData::getAll() as $career):?>

<a href="" data-toggle="modal" data-target="#myModal<?php echo $career->id; ?>">
        <div class="col-md-2 col-sm-3 info-color-box">
            <div class="white-box">
            
            <?php $sells = SellData::getAllUnAppliedByItemId($career->id);?>
            <?php if(count($sells)>0){ ?>
                            <div class="media bg-danger">
                                <div class="media-body">
                                    <h3 class="info-count"><b><?php echo $career->name; ?></b> <span class="pull-right"><img src="img/ocupado.png" width="30%" class="pull-right" style="margin-top: -30px;"></span></h3>
                                    <p class="info-ot font-15">Ocupado</p>
                                </div>
                            </div>
     

            <?php } else { ?>
                            <a href="index.php?view=sell&id=<?php echo $career->id; ?>&product=">
                            <div class="media bg-primary">
                                <div class="media-body">
                                    <h3 class="info-count"><b><?php echo $career->name; ?></b> <span class="pull-right"><img src="img/libre.png" width="30%" class="pull-right" style="margin-top: -30px;"></span></h3>
                                    <p class="info-ot font-15">Disponible</p>
                                </div>
                            </div>
                            </a>
            <?php } ?>
          </div>
          <!-- /.info-box -->
        </div>
</a>
    
    <div class="modal fade bs-example-modal-lg" id="myModal<?php echo $career->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">MOSTRAR DATOS</h4>
                  </div>
                  <div class="modal-body">
                    
                    <?php
$sells = SellData::getAllUnAppliedByItemId($career->id);
?>
<?php if(count($sells)>0){?>
    <?php foreach($sells as $s):?>
    <?php 
    $operations = OperationData::getAllProductsBySellId($s->id);
    $mesero = UserData::getById($s->mesero_id);

    ?>
        <?php if(count($operations)>0):?>
            <table class="table table-bordered">
            <tr>
                <td><a href="./?view=onesell&id=<?php echo $s->id;?>" class="btn  btn-primary">Id: <?php echo $s->id; ?></a></td>
                <td>Mesero: <?php echo $mesero->name." ".$mesero->lastname;?></td>
                <td></td>
            </tr>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Tiempo (mins)</th>
            </tr>
                <?php 
                $np=0;$nd=0;
                foreach($operations as $operation):
                $product = ProductData::getById($operation->product_id); ?>
                    <tr>
                        <td><?php echo $product->name;?></td>
                        <td><?php echo $operation->q;?></td>
                        <td><?php echo $product->duration*$operation->q;?></td>
                    </tr>
                <?php
                $np += $operation->q;
                $nd += $operation->q*$product->duration;
                 endforeach; ?>
                    <tr>
                        <td></td>
                        <td><?php echo $np;?></td>
                        <td><?php echo $nd;?></td>
                    </tr>

            </table>
        <?php endif; ?>
    <?php endforeach; ?>
<?php }else { ?>
<p class="alert alert-info"> NINGUN PEDIDO QUE MOSTRAR</p>
<?php } ?>


                    
                   </div>
            
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                    
                  </div>
                </div>
              </div>
            </div>


<?php endforeach; ?>
</div>
</div>

