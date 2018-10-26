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


$operations = OperationData::getAllByTodoOfficial();
$total = 0;
?>



<page backtop="6mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 18pt; font-family: arial" >
        
   
    <br>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 26px;">
		<tr>
            
			<td style="width:100%; ">
            <br />
            <?php echo "<b>REPORTE</b>"; ?><br><br />
                <?php  echo "<b style='font-size:14px; text-aling:left;'>".date("d-m-y")."</b>"; ?><br><br />
				 

			</td>
			
			
			
		</tr>
	</table>
	<br>
	
    <table cellspacing="0" style="width: 100%; border: solid 0px #7f8c8d; text-align: left; font-size: 14pt;padding:1mm; padding-left:0px;padding-top:-10px;">
        <tr >
			<th class="pumpkin" style="width: 21% "> CANTIDAD</th>
            <th  class="pumpkin" style="width: 55%">PRODUCTO</th>
            <th class="pumpkin" style="width: 14%;text-align:right">PRECIO</th>
            <th class="pumpkin" style="width: 10%;text-align:right">TOTAL</th>
            
        </tr>
   
<?php

$operations = OperationData::getAllByTodoOfficial();
$total = 0;
	foreach($operations as $operation){
		$product  = $operation->getProduct();
?>
<tr>

	<td style="width: 15% "><?php echo $operation->q ;?></td>
	<td style="width: 55%"><?php echo $product->name ;?></td>
	<td style="width: 14%"><?php echo $product->price_out ;?></td>
	<td style="width: 16%"><b>S/. <?php echo number_format($operation->q*$product->price_out);$total+=$operation->q*$product->price_out;?></b></td>
</tr>

<?php
	}
	?>

<tr>

	<td style="width: 21% "><?php echo "."; ;?></td>

	
</tr>

<tr>

	<td style="width: 15% "><?php echo "" ;?></td>
	<td style="width: 55%"><?php echo  "" ;?></td>
    <td style="width: 14% "><?php echo "TOTAL: " ;?></td>
	<td style="width: 16%"><?php echo "S/. ". number_format($total,2) ;?></td>
	
</tr>

	</table>


<page_footer>
        <table class="page_footer" style="padding-bottom:10px;">
        	<tr>

                <td style="width:85%; text-align: left; " >
                  
                </td>
                <td style="width: 86%; text-align: left;" c>
                   
                </td>
                
            </tr>

 
           
        </table>
    </page_footer>


</page>

