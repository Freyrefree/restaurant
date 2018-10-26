<?php
$proveedor = ProveedorData::getById($_GET["id"]);
if($proveedor!=null):
?>

<div class="col-12">
	<div class="white-box">

    <?php if(isset($_COOKIE["prdupd"])):?>
      <p class="alert alert-info">La informacion del proveedor se ha actualizado exitosamente.</p>
    <?php endif; ?>

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-pencil'></i><b> Editar Proveedor: </b> <?php echo $proveedor->nombres ?></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" id="addproveedor" action="index.php?view=updateproveedor" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombres*</label>
            <input type="text" name="nombres" class="form-control" id="nombres" value="<?php echo $proveedor->nombres; ?>" placeholder="Nombres" required>
            <input type="hidden" name="product_id" value="<?php echo $proveedor->id; ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Empresa</label>
            <input type="text" name="empresa" class="form-control" id="empresa" value="<?php echo $proveedor->empresa; ?>" placeholder="Empresa">
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Dirección</label>
            <textarea name="direccion" class="form-control" id="direccion" placeholder="Dirección"><?php echo $proveedor->direccion; ?></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" value="<?php echo $proveedor->telefono; ?>" placeholder="Teléfono">
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-12" align="right">
        <br>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Actualizar</button>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <div> <p class="alert alert-info">* Campos obligatorios: Nombres</p></div>
        </div>
      </div>

    </form>

  </div>
</div>


<?php endif; ?>
