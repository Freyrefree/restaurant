<?php $item = ItemData::getById($_GET["id"]);?>

<div class="col-12">
	<div class="white-box">

    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-pencil'></i><b> Editar Mesa: </b> <?php echo $item->name ?></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateitem" role="form">

      <div class="row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control">Nombre*</label>
            <input type="text" name="name" value="<?php echo $item->name;?>" class="form-control" id="name" placeholder="Nombre" required>
            <input type="hidden" name="user_id" value="<?php echo $item->id;?>">
          </div>
        </div>

        <div class="col-md-6" align="right">
        <br>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Actualizar</button>
          </div>
        </div>

      </div>

    </form>


  </div>
</div>
