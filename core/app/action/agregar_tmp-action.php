        
<?php

$session_id= session_id();

if (isset($_POST['id'])){$id=$_POST['id'];}
if (isset($_POST['cantidad'])){$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_venta'])){$precio_venta=$_POST['precio_venta'];}



if (!empty($_POST["precio_venta"]) and !empty($_POST["cantidad"]))
{
	
  $temporal = new TmpData();
	$temporal->id_producto = $_POST['id'];
  	$temporal->cantidad_tmp = $_POST['cantidad'];
	$temporal->precio_tmp = $_POST["precio_venta"];
	$temporal->sessionn_id = $session_id;
	$temporal->addTmp();
   
}




if (isset($_GET['id']))//codigo elimina un elemento del array
{
	
	$del = TmpData::getById($_GET["id"]);
	$del->del();

}



		$tmps = TmpData::getAllTemporal($session_id);
		
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover" id="recar">
			<thead style="border: 1px solid;">
			
            <th class="danger">CANTIDAD  <?php if(isset($_POST["precio_venta"])){echo $_POST["precio_venta"];} ?> </th>
            <th class="danger">DESCRIPCION/ESPECIFICACIONES TECNICAS</th>
            <th class="danger">PRECIO UNIT.</th>
            <th class="danger">PRECIO TOTAL</th>
           
            <th class="danger"></th>
			</thead>
			<tbody style="border: 1px solid;">
			<?php
			$sumador_total=0;
			foreach($tmps as $tmp): ?>
				<tr>
                
				<td><?php echo $tmp->cantidad_tmp; ?></td>
				<td><?php if($tmp->id_producto!=null){echo $tmp->getProduct()->nombre;}else{ echo "<center>----</center>"; }  ?></td>
                
                <td>$  <?php echo number_format($tmp->precio_tmp,3,'.',','); ?></td>
                <?php $sumar_t=$tmp->cantidad_tmp*$tmp->precio_tmp; ?>
                <td>$  <?php echo number_format($sumar_t,3,'.',','); ?></td>
  				<td ><span class="pull-right"><a href="#" onclick="eliminar('<?php echo $tmp->id_tmp ?>')"><i class="glyphicon glyphicon-trash"></i> Eliminar</a></span></td>
         
          
           </tr>
           
          
				
                
				<?php
				$sumador_total+=$sumar_t;
			endforeach ?>
            <tr>
                <td colspan=3><span class="pull-right">TOTAL </span></td>
                <td><span class="pull-left"><?php echo '$  '.number_format($sumador_total,2);?></span></td>
                <td></td>
            </tr>
            </tbody>
           
            </table>