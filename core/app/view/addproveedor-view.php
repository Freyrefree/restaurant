<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-plus'></i><b> Agregar Proveedor</b></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" id="addproveedor" action="index.php?view=newproveedor" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombres*</label>
            <input type="text" name="nombres" class="form-control" id="nombres" placeholder="Nombres" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Empresa</label>
            <input type="text" name="empresa" class="form-control" id="empresa" placeholder="Empresa"  >
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Dirección</label>
            <textarea name="direccion" class="form-control" id="direccion" placeholder="Dirección"></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Teléfono</label>
            <input type="text" name="telefono" class="form-control "  id="telefono" placeholder="Teléfono" >
          </div>
        </div>

      </div>

      
      <div class="row">

        <div class="col-md-12" align="right">
          <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
        </div>

      </div>


      <br>

      <div class="row">
        <div class="col-md-12">
          <div> <p class="alert alert-info">* Campos obligatorios: Nombres</p></div>
        </div>
      </div>

    </form>


  </div>
</div>

