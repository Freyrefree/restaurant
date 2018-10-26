
<div class="col-12">
	<div class="white-box">

  <div class="row page-title clearfix">
    <div class="page-title-right d-none d-sm-inline-flex">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <h2><i class='fa fa-plus'></i><b> Agregar Producto</b></h2>
        </li>
      </ol>
    </div>
  </div>

  <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=newproduct" role="form">

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Codigo Prodcuto*</label>
          <input type="text" name="code" class="form-control" id="code" placeholder="Codigo del Producto">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Codigo SAT</label>
          <input type="text" name="codigoSAT" class="form-control" id="codigoSAT" placeholder="Codigo SAT">
          <input type="hidden" name="idCodSAT" id="idCodSAT">
          <div id="searchResult" class="scrollable-menu" role="menu"></div>
        </div>
      </div>


    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Nombre Prodcuto*</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del Producto" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
        <label for="" class="control">Descripcion*</label>
          <textarea name="description" class="form-control" id="description" placeholder="Descripcion del Producto"></textarea>
        </div>
      </div>

      

    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
        <label for="" class="control">Preparacion*</label>
          <textarea name="preparation" class="form-control" id="preparation" placeholder="Peparacion del Producto"></textarea>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Costo</label>
            <input type="text" name="price_in" class="form-control " id="price_in" placeholder="Precio de entrada" required>
        </div>
      </div>

      

    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Precio*</label>
            <input type="text" name="price_out" class="form-control " id="price_out" placeholder="Precio de salida" required>
        </div>
      </div>

      

      <div class="col-md-6">
        <div class="form-group">
          <label for="" class="control">Tiempo de preparacion*</label>
            <input type="text" name="duration" class="form-control " id="duration" placeholder="Tiempo de preparacion del Producto (mins)">
        </div>
      </div>

      

      

    </div>


    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
        <label for="" class="control">Unidad*</label>
          <input type="text" name="unit" class="form-control " id="unit" placeholder="Unidad del Producto" required>
          <input type="hidden" name="idUnidadSAT" id="idUnidadSAT">
          <div id="searchUnit" class="scrollable-menu" role="menu"></div>
        </div>
      </div>

      

      <div class="col-md-6">
        <div class="form-group">
          <label for="inputEmail1" class="control">Categoria</label>
          <select name="category_id" class="form-control " id="category_id" required>
            <option value="">-- SELECCIONE CATEGORIA --</option>
          <?php foreach(CategoryData::getAll() as $cat):?>
            <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
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
              <input type="checkbox" name="use_ingredient"> Usar Ingredientes
            </label>
          </div>
        </div>
      </div>   

      <div class="col-md-6" align="right">
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
      </div>


    </div>

    

    <br>

    <div class="row">
      <div class="col-md-12">
        <div><p class="alert alert-info">* Campos obligatorios: Nombre, Precio, Unidad, Categoria</p></div>
      </div>
    </div>

  </form>


  </div>
</div>

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



