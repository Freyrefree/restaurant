<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-plus'></i><b> Agregar Ingrediente</b></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addingredient" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Codigo*</label>
            <input type="text" name="code" class="form-control" id="code" placeholder="Codigo del Ingrediente" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre*</label>
            <input type="text" name="name"  class="form-control" id="name" placeholder="Nombre del Ingrediente" required>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Costo</label>
            <input type="text" name="price_in"  class="form-control " id="price_in" placeholder="Precio de entrada">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Precio</label>
            <input type="text" name="price_out"  class="form-control " id="price_out" placeholder="Precio de salida" >
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Unidad</label>
            <input type="text" name="unit" class="form-control " id="unit" placeholder="Unidad del Ingrediente">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control-label">Proveedor</label>
            <select name="proveedor_id" class="form-control " id="proveedor_id">
              <option value="">-- SELECCIONE PROVEEDOR --</option>
              <?php foreach(ProveedorData::getAll() as $cat):?>
              <option value="<?php echo $cat->id; ?>"><?php echo $cat->nombres; ?></option>
              <?php endforeach; ?>
          </select>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-12" align="right">
          <button type="submit" class="btn btn-primary">Agregar Ingrediente</button>
        </div>

      </div>


      <br>

      <div class="row">
        <div class="col-md-12">
          <div> <p class="alert alert-info">* Campos obligatorios: Código, Nombre</p></div>
        </div>
      </div>

    </form>


  </div>
</div>
