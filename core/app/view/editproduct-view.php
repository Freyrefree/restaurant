<?php
$product = ProductData::getById($_GET["id"]);
if($product!=null):

## iniciar variables;
$codigoSATget = "";
$idCodSAT = ""; 

$claveUnitGet = "";
$idClaveUnit = "";

## Codigo producto SAT
if($product->codigoSAT != null):

  $codigoSAT = ClaveProdSAT::getById($product->codigoSAT);
  
  if($codigoSAT != null):
  $codigoSATget = $codigoSAT->clave_prodserv." ".utf8_encode($codigoSAT->descripcion);
  $idCodSAT = $codigoSAT->clave_prodserv;
  endif;

endif;

## Clave unidad SAT
if($product->unit != null):

  $ClaveUnidadSAT = ClaveUnidadSAT::getById($product->unit);

  if($ClaveUnidadSAT != null):

  $claveUnitGet = $ClaveUnidadSAT->clave_unidad." ".utf8_encode($ClaveUnidadSAT->nombre);
  $idClaveUnit = $ClaveUnidadSAT->clave_unidad;

  endif;

endif;
?>


<div class="col-12">
	<div class="white-box">

    <?php if(isset($_COOKIE["prdupd"])):?>
      <p class="alert alert-info">La informacion del producto se ha actualizado exitosamente.</p>
    <?php setcookie("prdupd","",time()-18600); endif; ?>

  <div class="row page-title clearfix">
    <div class="page-title-right d-none d-sm-inline-flex">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <h2><i class='fa fa-pencil'></i><b> Editar Producto: </b> <?php echo $product->name ?></h2>
        </li>
      </ol>
    </div>
  </div>

  <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateproduct" role="form">

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Codigo Prodcuto*</label>
          <input type="text" name="code" class="form-control" id="code"  value="<?php echo $product->code; ?>" placeholder="Codigo del Producto" >
          <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Codigo SAT</label>
          <input type="text" name="codigoSAT" class="form-control" id="codigoSAT" value="<?php echo $codigoSATget; ?>" placeholder="Codigo SAT">
          <input type="hidden" name="idCodSAT" id="idCodSAT" value="<?php echo $idCodSAT; ?>">
          <div id="searchResult" class="scrollable-menu" role="menu"></div>
        </div>
      </div>


    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Nombre Prodcuto*</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo $product->name; ?>" placeholder="Nombre del Producto" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
        <label for="" class="control">Descripcion*</label>
          <textarea name="description" class="form-control" id="description" placeholder="Descripcion del Producto"><?php echo $product->description; ?></textarea>
        </div>
      </div>

      

    </div>

    <div class="row">
      

      <div class="col-md-6">
        <div class="form-group">
        <label for="" class="control">Preparacion*</label>
          <textarea name="preparation" class="form-control" id="preparation" placeholder="Peparacion del Producto"><?php echo $product->preparation; ?></textarea>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Costo</label>
            <input type="text" name="price_in" class="form-control " id="price_in" placeholder="Precio de entrada" value="<?php echo $product->price_in; ?>"  required>
        </div>
      </div>



    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Precio*</label>
            <input type="text" name="price_out" class="form-control " id="price_out" placeholder="Precio de salida" value="<?php echo $product->price_out; ?>"  required>
        </div>
      </div>
      

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Tiempo de preparacion*</label>
            <input type="text" name="duration" class="form-control " id="duration" placeholder="Tiempo de preparacion del Producto (mins)"  value="<?php echo $product->duration; ?>">
        </div>
      </div>

    </div>


    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
        <label for="" class="control">Unidad*</label>
          <input type="text" name="unit" class="form-control " id="unit" placeholder="Unidad del Producto" value="<?php echo $claveUnitGet; ?>" required>
          <input type="hidden" name="idUnidadSAT" id="idUnidadSAT" value="<?php echo $idClaveUnit; ?>">
          <div id="searchUnit" class="scrollable-menu" role="menu"></div>
        </div>
      </div>      

      <div class="col-md-6">
        <div class="form-group">
          <label for="inputEmail1" class="control">Categoria</label>
          <select name="category_id" class="form-control" id="category_id">
            <option value="">-- SELECCIONE CATEGORIA --</option>
            <?php foreach(CategoryData::getAll() as $cat):?>
              <option value="<?php echo $cat->id; ?>" <?php if($product->category_id==$cat->id){ echo "selected";}?>><?php echo $cat->name; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

       


    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="use_ingredient" <?php if($product->use_ingredient){ echo "checked";}?>> Usar Ingredientes
            </label>
          </div>
        </div>
      </div>


      <div class="col-md-6" align="right">
        <button type="submit" class="btn btn-success">Actualizar Producto</button>
      </div>

    </div>

    
    <br>

    <div class="row">
      <div class="col-md-12">
        <div><p class="alert alert-info">* Campor obligatorios: Nombre, Precio de Salida, Unidad</p></div>
      </div>
    </div>

  </form>


  </div>
</div>



<?php endif; ?>


<!-- *************************Autocomplete Código Prodcuto SAT****************************** -->
<script>

$("#codigoSAT").keyup(function(){

    var search = $(this).val();

    if(search != ""){

      if(search.length >= 6){

        $.ajax({
            url: "index.php?view=autoCompleteCodSat",
            type: 'POST',
            data: {criterio : search},
            dataType: 'json'
        }).done(function(respuesta) {

          $("#searchResult").html("");

            $.each(respuesta, function(key, item) {

              $("#searchResult").append("<button type='button'  value='"+item.rowid+"' class='list-group-item list-group-item-action'>"+item.rowid+" "+item.descripcion+"</button>");

            });
            
            // binding click event to li
            $("#searchResult button").bind("click",function(){
                setText(this);
            });

          });

      }else{
        $("#searchResult").html("");
      }
    }

});


function setText(element)
{
  var value = $(element).text();
  var id    = $(element).val();

  $("#codigoSAT").val(value);
  $("#idCodSAT").val(id);


  $("#searchResult").html("");
}

</script>
<!-- *************************END****************************** -->

<!-- *************************Autocomplete Unidad Prodcuto SAT****************************** -->
<script>

$("#unit").keyup(function(){

    var search = $(this).val();

    if(search != ""){

      if(search.length >= 2){

        $.ajax({
            url: "index.php?view=autoCompleteClaveUnidad",
            type: 'POST',
            data: {criterio : search},
            dataType: 'json'
        }).done(function(respuesta) {

          $("#searchUnit").html("");

            $.each(respuesta, function(key, item) {

              $("#searchUnit").append("<button type='button'  value='"+item.clave_unidad+"' class='list-group-item list-group-item-action'>"+item.clave_unidad+" "+item.nombre+"</button>");

            });
            
            // binding click event to li
            $("#searchUnit button").bind("click",function(){
                setTextUnit(this);
            });

          });

      }else{
        $("#searchUnit").html("");
      }
    }

});


function setTextUnit(element)
{
  var value = $(element).text();
  var id    = $(element).val();

  $("#unit").val(value);
  $("#idUnidadSAT").val(id);


  $("#searchUnit").html("");
}

</script>
<!-- ******************************************* END ************************************************ -->


<script>
  $("#addproduct").submit(function(e){
    if($("#name").val()!="" &&  $("#price_out").val()!="" && $("#unit").val()!="" ){

    }else{
    e.preventDefault();
    alert("No debes dejar campos vacios.");
  }

  });
</script>