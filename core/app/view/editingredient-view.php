<?php $ingredient = IngredientData::getById($_GET["id"]);
if($ingredient!=null):
?>

<div class="col-12">
	<div class="white-box">


    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-pencil'></i><b> Editar Ingrediente: </b> <?php echo $ingredient->name;?></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateingrediente" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Codigo*</label>
            <input type="text" name="code" class="form-control" id="code" value="<?php echo $ingredient->code;?>" placeholder="Codigo del Ingrediente" readonly>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre*</label>
            <input type="text" name="name" value="<?php echo $ingredient->name;?>" class="form-control" id="name" placeholder="Nombre">
            <input type="hidden" name="id" value="<?php echo $ingredient->id;?>">
          </div>
        </div>

        
      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Costo</label>
            <input type="text" name="price_in" value="<?php echo $ingredient->price_in;?>" class="form-control" id="price_in" placeholder="Precio de entrada">
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Precio*</label>
            <input type="text" name="price_out" value="<?php echo $ingredient->price_out;?>" class="form-control" id="price_out" placeholder="Precio de salida">
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Unidad</label>
            <input type="text" name="unit" value="<?php echo $ingredient->unit;?>" class="form-control" id="unit" placeholder="Unidad del Ingrediente">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Proveedor*</label>
            <select name="proveedor_id" class="form-control"  id="proveedor_id">
              <option value="">-- SELECCIONE PROVEEDOR --</option>
              <?php foreach(ProveedorData::getAll() as $cat):?>
              <option value="<?php echo $cat->id; ?>" <?php if($ingredient->proveedor_id==$cat->id){ echo "selected";}?>><?php echo $cat->nombres; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

      </div>

      <div class="row">

      <div class="col-md-12" align="right">
        <button type="submit" class="btn btn-success">Actualizar Ingrediente</button>
      </div>

      </div>

      <br>

      <div class="row">
        <div class="col-md-12">
          <div> <p class="alert alert-info">* Campos obligatorios: Nombre</p></div>
        </div>
      </div>

    </form>

  </div>
</div>


<?php
endif;
?>