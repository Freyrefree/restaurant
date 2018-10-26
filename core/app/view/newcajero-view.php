<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-plus'></i><b> Agregar cajero</b></h2>
          </li>
        </ol>
      </div>
    </div>

  <form class="form-horizontal" method="post" action="index.php?view=adduser" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre*</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
            <input type="hidden" name="is_cajero" value="1">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Apellidos</label>
            <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellidos">
          </div>
        </div>

      </div>


      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre de usuario</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Nombre de usuario">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          </div>
        </div>

      </div>

      

      <div class="row">
        <div class="col-md-12" align="right">
          <br>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Agregar Cajero</button>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div> <p class="alert alert-info">* Campos obligatorios: Nombre, Contraseña</p></div>
        </div>
      </div>

  </form>


  </div>
</div>
