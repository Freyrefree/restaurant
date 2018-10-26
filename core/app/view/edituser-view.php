<?php $usser = UserData::getById($_GET["id"]);?>

<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-pencil'></i><b> Editar Usuario: </b> <?php echo $usser->name; ?></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" action="index.php?view=updateuser" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombres*</label>
            <input type="text" class="form-control" name="name" value="<?php echo $usser->name; ?>" id="name" placeholder="Nombres" required>
            <input type="hidden" name="user_id" value="<?php echo $usser->id;?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Apellidos</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo $usser->lastname; ?>" id="lastname" placeholder="Apellidos">
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre de usuario</label>
            <input type="text" class="form-control" name="email" value="<?php echo $usser->email; ?>" id="email" placeholder="Nombre de usuario">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
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


