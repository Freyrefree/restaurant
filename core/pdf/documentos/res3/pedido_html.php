<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.pumpkin{
	background:#8BC34A;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:#bdc3c7;
	padding: 3px 4px 3px;
	border-bottom: black 1px solid;
	border-left:black 1px solid;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
	border-bottom: black 1px solid;
	border-left:black 1px solid;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}

table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}
-->
</style>

<?php 


$sell = SellData::getById($_GET["id"]);
$mesero = UserData::getById($sell->mesero_id);

?>

<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 18pt; font-family: arial" >
        <page_footer>
        <table class="page_footer" style="padding-bottom:40px;">
        	<tr>

                <td style="width: 50%; text-align: left; height:6px;" class="pumpkin">
                   
                </td>
                <td style="width: 50%; text-align: left; height:6px;" class="pumpkin">
                   
                </td>
                
            </tr>
           
        </table>
    </page_footer>
    <table cellspacing="0" style="width: 100%;">
       
      
        <tr>
			<td style="width: 100%;text-align:center;font-size:42px;color:#2c3e50">
            <br /><br />
			<b style="text-decoration:underline; font-family:Arial, Helvetica, sans-serif;" >COMANDA Nº <?php echo $_GET['id'] ?></b>
			</td>
			
        </tr>
    </table>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 26px;">
		<tr>
            
			<td style="width:45%; ">
            <br />
				MESA: # <?php echo $sell->item_id; ?><br><br />
                MESERO: <?php echo $mesero->name." ".$mesero->lastname; ?><br> <br />

			</td>
			<td  style="width:55%; text-align:right; "><?php echo date("d/m/Y"); ?></td>
			
			
		</tr>
	</table>
	<br>
	
       
  
    <table cellspacing="0" style="width: 100%; border: solid 0px #7f8c8d; text-align: center; font-size: 22pt;padding:1mm;">
        <tr >
			<th class="pumpkin" style="width: 21% ">CANTIDAD.</th>
            <th class="pumpkin" style="width: 55%">DESCRIPCION</th>
            <th class="pumpkin" style="width: 14%;text-align:right">PRECIO</th>
            <th class="pumpkin" style="width: 10%;text-align:right">TOTAL</th>
            
        </tr>
   
<?php

$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$total = 0;
	foreach($operations as $operation){
		$product  = $operation->getProduct();
?>
<tr>

	<td><?php echo $operation->q ;?></td>
	<td><?php echo $product->name ;?></td>
	<td><?php echo $product->price_out ;?></td>
	<td><b>S/. <?php echo number_format($operation->q*$product->price_out);$total+=$operation->q*$product->price_out;?></b></td>
</tr>

<?php
	}
	?>


	</table>


	
	

</page>

