<?php
$sell = SellData::getById($_GET["id"]);
if($sell!=null):

$empresa = EmpresaData::getById(1);

$receptor = SellData::getSellRFCReceptor($_GET["id"]);





?>

<div class="col-12">
	<div class="white-box">



    <div class="row page-title clearfix">
      <div class="page-title-right d-none d-sm-inline-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <h2><i class='fa fa-pencil'></i><b> Facturación: </b></h2>
          </li>
        </ol>
      </div>
    </div>

    <form class="form-horizontal" method="post" id="addproveedor" action="" role="form">

      <div class="row">

        <div class="col-md-4">
          <div class="form-group">
            <label>Tipo de Comprobante</label>
            <select class="form-control" name="tc" id="tc" readonly  required>
                <option value="">-- Seleccione un tipo de comprobante</option>
                <option value="Ingreso" selected>Ingreso</option>
                <option value="Egreso">Egreso</option>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>RFC Emisor</label>
		        <input type="text" name="r_emisor" id="r_emisor" value="<?php echo $empresa->rfc ?>" class="form-control" required readonly="readonly">
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>RFC Receptor</label>
			      <input type="text" name="r_receptor" id="r_receptor" value="<?php echo $receptor[0]->rfc ?>" class="form-control" placeholder="RFC Receptor" readonly>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-4">
          <div class="form-group">
          <label>Forma de Pago</label>
            <select class="form-control" name="forma" id="forma" required>
            <option value="">-- SELECCIONA UNA FORMA DE PAGO --</option>
              <?php foreach(FormaPagoSAT::getAll() as $forma):?>
              <option value="<?php echo $forma->c_formapago; ?>"><?php echo $forma->descripcion; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
          <label>Método de Pago</label>
            <select class="form-control" name="metodo" id="metodo" required>
            <option value="">-- SELECCIONA UN MÉTODO DE PAGO --</option>
              <?php foreach(MetodoPagoSAT::getAll() as $metodo):?>
              <option value="<?php echo $metodo->c_metodopago; ?>"><?php echo $metodo->descripcion; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Fecha</label>
            <input type="text" name="fecha" id="fecha" class="form-control" value="<?=date("Y-m-d")?>" readonly="readonly">     
          </div>
        </div>

      </div>

      <div class="row">

       <div class="col-md-4">
          <div class="form-group">
            <label>Moneda</label>
            <select class="form-control" id="moneda" name="moneda" required>
            <option value="">-- SELECCIONA UNA MONEDA--</option>
              <?php foreach(MonedaSAT::getAll() as $moneda):?>
                <?php if($moneda->c_moneda == "MXN"): ?>
                  <option value="<?php echo $moneda->c_moneda; ?>" selected><?php echo  $moneda->c_moneda."-".$moneda->descripcion; ?></option>
                <?php else: ?>
                  <option value="<?php echo $moneda->c_moneda; ?>"><?php echo $moneda->c_moneda."-".$moneda->descripcion; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Condiciones de pago</label>
			    	<input type="text" name="condicion" id="condicion" class="form-control" value="" >
          </div>
        </div>

         <div class="col-md-4">
          <div class="form-group">
            <label>Uso CFDI</label>
            <input type="hidden" name="usocfdi" id="usocfdi" class="form-control" value="<?php echo $receptor[0]->cfdi ?>" >
			    	<input type="text" name="Dusocfdi" id="Dusocfdi" class="form-control" value="<?php echo $receptor[0]->cfdi."-".$receptor[0]->descripcion?>" >
          </div>
        </div>
      </div>

     

      <div class="row">

        <div class="col-md-12" align="right">
        <br>
          <div class="form-group">
           
          </div>
        </div>

      </div>



    </form>

  </div>
</div>


<?php endif; ?>
