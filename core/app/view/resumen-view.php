<?php if(isset($_GET["id"]) && $_GET["id"]!=""):?>

<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-money'></i><b> Caja</b></h2>
          </li>
        </ol>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">

        <?php
        $sell = SellData::getById($_GET["id"]);
        $mesero = UserData::getById($sell->mesero_id);
        $cajero= null;
        if($sell->is_applied)
        {
          $cajero = UserData::getById($sell->cajero_id);
        }
        $operations = OperationData::getAllProductsBySellId($_GET["id"]);
        $total = 0;

        foreach($operations as $operation)
        {
          $product  = $operation->getProduct();
          number_format($operation->q*$product->price_out);$total+=$operation->q*$product->price_out;
        }
        ?>

        <table class="table table-bordered">
          <tr>
            <td colspan="2" align="center"><h4><b>Resumen</b></h4></td>
          </tr>
          <tr>
            <td><p>Mesa: #</p></td>
            <td><p><b><?php echo $sell->item_id; ?></b></p></td>
          </tr>
          <tr>
            <td><p>Mesero:</p></td>
            <td><p><b><?php echo $mesero->name." ".$mesero->lastname; ?></b></p></td>
          </tr>
          <tr>
            <td><p>Subtotal:</p></td>
            <td><p><b>$ <?php echo number_format(($total*.84), 2,'.',''); ?></b></p></td>
          </tr>
          <tr>
            <td><p>IVA:</p></td>
            <td><p><b>$ <?php echo number_format(($total*.16), 2,'.',''); ?></b></p></td>
          </tr>
          <tr>
            <td><p>Total:</p></td>
            <td><p><b>$ <?php echo number_format($total, 2,'.',''); ?></b></p></td>
          </tr>
        </table>

      </div>



      <div class="col-md-6">
        <form class="form-horizontal" id="processsell" method="post" action="index.php?view=applysell" role="form">

          <div class="form-group">
            <label for="" class="control">Cliente</label>
            <?php 
            $clients = ClienteData::getAll();
            ?>

            <div class="input-group">
              <select name="client_id" id="client_id" class="form-control" required>
                <option value="">-- NINGUNO --</option>
                <?php foreach($clients as $client):?>
                  <option value="<?php echo $client->id;?>"><?php echo utf8_encode($client->razonSocial);?></option>
                <?php endforeach;?>
              </select>
              <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-toggle="modal" data-target="#modaladdCliente"> <i class="fa fa-user-plus" aria-hidden="true"></i> Ingresar Cliente </button>
              </span>
            </div>
              
          </div>

          <div class="form-group">
            <label for="" class="control">Efectivo</label>
            <input type="hidden" name="total" value="<?php echo $total; ?>" class="form-control" placeholder="Total">
            <input type="text" name="money" required class="form-control" id="money" placeholder="Efectivo">
          </div>

          <?php if(!$sell->is_applied):?>

            <?php if(Session::getUID()):?>
              <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>" />
              <div align="right">
                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Finalizar Venta</button>
              </div>
            <?php endif; ?>

          <?php endif; ?>

          <?php if($sell->is_applied):?>
            <h4>Venta Aceptada por el Cajero: <b><?php echo $cajero->name." ".$cajero->lastname; ?></b></h4>
          <?php endif; ?>

        </form>
      </div>

    </div>
		
  </div>
</div>

<?php else:?>
  501 Internal Error
<?php endif; ?>






<!--********************************** Modal ***********************************************-->
<div class="modal fade bd-example-modal-lg" id="modaladdCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form id="formCliente">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresa | Agregar Cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="container-fluid">

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">RFC:</label>
                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Razón Social:</label>
                    <input type="text" class="form-control" name="razonSocial" id="razonSocial" placeholder="Razón Social" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" required>
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Contacto:</label>
                    <input type="text" class="form-control" name="contacto" id="contacto" placeholder="Contacto" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Correo:</label>
                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">País:</label>
                    <input type="text" class="form-control" name="pais" id="pais" placeholder="País" required>
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Estado:</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Municipio:</label>
                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Código Postal:</label>
                    <input type="text" class="form-control" name="cp" id="cp" placeholder="Código Postal" required>
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Colonia:</label>
                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Calle:</label>
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Número Exterior:</label>
                    <input type="text" class="form-control" name="numEx" id="numEx" placeholder="Número Exterior" required>
                  </div>
                </div>

              </div>

              <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="control">Número Interior:</label>
                    <input type="text" class="form-control" name="numIn" id="numIn" placeholder="Número Interior" required>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="form-group">
                    <label for="" class="control">Uso CFDI</label>

                    <?php 
                    $usoCFDI = UsoCFDI::getAllUsoCFDI();
                    ?>

                    <select name="cfdi" id="cfdi" class="form-control" required>
                      <option value = "">Elige la Categoría de CFDI</option>
                      <?php foreach($usoCFDI as $CFDI):?>
                        <option value="<?php echo $CFDI->c_UsoCFDI;?>"><?php echo utf8_encode($CFDI->descripcion);?></option>
                      <?php endforeach;?>
                    </select>
                  </div>
                </div>

              </div>

            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar Cliente</button>
          </div>
      </form>    
    </div>
  </div>
</div>
<!--********************************** END ***********************************************-->


<script>

$('#formCliente').submit(function(e) {
    e.preventDefault();
    var data = $(this).serializeArray();
    $.ajax({
        method: "POST",
        url: "index.php?view=addcliente",
        data: data,
    }).done(function(respuesta) {

        if(respuesta == 1)
        {
          $("#formCliente")[0].reset();

        }else{
        }

        $("#modaladdCliente").modal("hide");
        
        $.get(location.href).then(function(page) {
          $("#client_id").html($(page).find("#client_id").html())
        })

        
            
    });
});

</script>


<script>
	$("#processsell").submit(function(e){
		money = $("#money").val();
		if(money<(<?php echo $total;?>)){
			alert("No se puede efectuar la operacion");
			e.preventDefault();
		}else {
			
			go = confirm("Cambio: $ "+(money-(<?php echo $total;?> ) ) );
			if(go){}
				else{e.preventDefault();}
		}
	});
</script>


