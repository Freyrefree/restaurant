<?php
$user = UserData::getById(Session::getUID());
?>


<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-plus'></i><b> Agregar Mesa</b></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" action="index.php?view=additem" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre*</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required>
          </div>
        </div>

        <div class="col-md-6" align="right">
        <br>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </div>

      </div>

    </form>


  </div>
</div>

