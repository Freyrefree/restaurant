<?php $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';?>

<?php $productos = ProductoData::getAll();
                if(count($productos)>0){
                  // si hay usuarios
                  ?>
                  <table id="example1" class="table table-bordered table-hover">

                  <thead style="color: white; background-color: #dd4b39;">
                        <th>CÓDIGO</th> 
                        <th>NOMBRE</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO VENTA</th>
                        <th></th>  
                  </thead>
                   <?php foreach($productos as $producto):?>
                      <tr>
                        <td><?php echo $producto->codigo; ?></td>
                        <td><?php echo $producto->nombre; ?></td>
                        <td class='col-xs-1'>
						<div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $producto->id; ?>"  value="1" >
						</div></td>
                       
                        <td class='col-xs-2'><div class="pull-right">
						<input type="text" class="form-control" style="text-align:right" id="precio_venta_<?php echo $producto->id; ?>"  value="<?php echo $producto->precio_venta;?>" >
						</div>
						</td>
                        
                        <td><span class="pull-right"><a href="#" onclick="agregar('<?php echo $producto->id; ?>')" class="btn btn-success"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</a></span></td>
                        
                      </tr> 
                    <?php endforeach; ?>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>


<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
   
  });
</script>
