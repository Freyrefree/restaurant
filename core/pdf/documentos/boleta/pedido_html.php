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


$sell = SellData::getById($_GET["id"]);
$cliente = ClienteData::getById($sell->cliente_id);
$cajero= null;

$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$total = 0;
?>



<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 18pt; font-family: arial" >
        
   
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 14px; margin-left:35px; ">
		<tr>
            
			<td style="width:45%; ">
            <br />
                <?php  echo "<b style='padding-left:470px;> "."</b><b style='margin-left:150px;'>".date("d")."</b><b style='margin-left:30px;'>".date("m")."</b><b style='margin-left:30px;'>".date("y")."</b>"; ?><br><br />
                <?php echo "<b style='margin-top:15px;'>".$cliente->nombres."</b>"; ?><br> <br />
				 <?php echo "<b>".$cliente->direccion."</b><b style='margin-left:85px;'>".$cliente->ruc."</b>"; ?><br><br />
                 

			</td>
			
			
			
		</tr>
	</table>
	<br>
	
    <table cellspacing="0" style="width: 60%; border: solid 0px #7f8c8d; text-align: left; font-size: 12pt;padding:1mm; padding-left:-10px;padding-top:0px;">
        <tr >
			<th style="width: 5% "></th>
            <th style="width: 50%"></th>
            <th style="width: 14%;text-align:right"></th>
            <th style="width: 10%;text-align:right"></th>
            
        </tr>
   
<?php

$operations = OperationData::getAllProductsBySellId($_GET["id"]);
$total = 0;
	foreach($operations as $operation){
		$product  = $operation->getProduct();
?>
<tr>

	<td style="width: 5% "><?php echo $operation->q ;?></td>
	<td style="width: 50%"><?php echo $product->name ;?></td>
	<td style="width: 14%"><?php echo $product->price_out ;?></td>
	<td style="width: 10%"><b> <?php echo number_format($operation->q*$product->price_out);$total+=$operation->q*$product->price_out;?></b></td>
</tr>

<?php
	}
	?>
    








	</table>


<page_footer>
        <table class="page_footer" style="padding-bottom:560px;">
        	<tr>

                <td style="width:41%; text-align: left; " >
                  
                </td>
                <td style="width: 86%; text-align: left;" c>
                   
                </td>
                
            </tr>
            
            


<tr>
	
    <td></td>
	<td><?php echo "<br>". number_format($total,2) ;?></td>
</tr>


 
           
        </table>
    </page_footer>


</page>

