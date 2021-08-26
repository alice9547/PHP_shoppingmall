 <!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	

<?
	include "main_top.php";
	include "common.php";
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
			<table width="959" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<a href="product_detail.php?no=28">
						<img src="images/main_product1.jpg" width="959"
						onmouseover="this.src='images/main_product1_1.jpg'"
						onmouseout="this.src='images/main_product1.jpg'">
						</a>
					</td>
				</tr>
			</table>
<br><br>
			<!---- 화면 우측(베스트) 시작 -------------------------------------------------->	
			<table width="767" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60">						
						<img src="images/main_bestproduct.jpg" width="767" height="40">
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0">
				<!---1번째 줄-->
				<tr>
<?
	$num_col=4;   $num_row=2; // column수, row수
	
	$query="select * from product where icon_hit70=1 and status70=1 order by rand() limit 8";

	$result=mysqli_query($db,$query); 	 
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result);           // 출력할 제품 개수
	
	$icount=0;       // 출력한 제품개수 카운터
	
	echo("<table>");
	for ($ir=0; $ir<$num_row; $ir++)
	{
		 echo("<tr>");
		 for ($ic=0;  $ic<$num_col;  $ic++)
		{
			 if ($icount < $count)
			{
				 $row=mysqli_fetch_array($result);
				 $price=number_format($row[price70]);
				 $d_price=number_format(round($row[price70]*(100-$row[discount70])/100, -3) );
						echo("
						<td width='180' height='250' align='center' valign='top'>
						 <table border='0' cellpadding='0' cellspacing='0' width='150' class='cmfont'>
							<tr>
								<td align='center'> 
									<a href='product_detail.php?no=$row[no70]'><img src='product/$row[image1]' width='180' height='210' border='0'></a>	
								</td>
							</tr>
							<tr><td height='5'></td></tr>
							<tr> 
								<td height='20' align='center'>
									<a href='product_detail.php?no=$row[no70]'><font color='444444'>$row[name70]</font></a>&nbsp; ");
								
							if($row[icon_hit70]==1)	echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
							if($row[icon_new70]==1)	echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
							if($row[icon_sale70]==1) echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red'>$row[discount70]%</font>");
							
							if($row[icon_sale70]==0) echo("
								</td>
							</tr>
							
							<tr><td height='20' align='center'><b> $price 원</b></td></tr>
						</table>
						</td>");
							else echo("
								</td>
							</tr>
							<tr><td height='20' align='center'><strike>$price 원</strike><br><b> $d_price 원</b></td></tr>
						</table>
						</td>");
			 }
			 else
				 echo("<td></td>");      // 제품 없는 경우
			 $icount++;
		 }
		echo("</tr>");
	}
	echo("</table>");

							
?>
					
				</tr>
				<tr><td height="10"></td></tr>
			</table>

			<!---- 화면 우측(베스트) 끝 -------------------------------------------------->	
<br><br>
			<!---- 화면 우측(신상품) 시작 -------------------------------------------------->	
			<table width="767" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60">
						<img src="images/main_newproduct.jpg" width="767" height="40">
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0">
				<!---1번째 줄-->
				<tr>
<?
	$num_col=4;   $num_row=2; // column수, row수
	
	$query="select * from product where icon_new70=1 and status70=1 order by rand() limit 8";

	$result=mysqli_query($db,$query); 	 
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result);           // 출력할 제품 개수
	
	$icount=0;       // 출력한 제품개수 카운터
	
	echo("<table>");
	for ($ir=0; $ir<$num_row; $ir++)
	{
		 echo("<tr>");
		 for ($ic=0;  $ic<$num_col;  $ic++)
		{
			 if ($icount < $count)
			{
				 $row=mysqli_fetch_array($result);
				 $price=number_format($row[price70]);
				 $d_price=number_format(round($row[price70]*(100-$row[discount70])/100, -3) );
						echo("
						<td width='150' height='205' align='center' valign='top'>
						 <table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>
							<tr> 
								<td align='center'> 
									<a href='product_detail.php?no=$row[no70]'><img src='product/$row[image1]' width='180' height='210' border='0'></a>
								</td>
							</tr>
							<tr><td height='5'></td></tr>
							<tr> 
								<td height='20' align='center'>
									<a href='product_detail.php?no=$row[no70]'><font color='444444'>$row[name70]</font></a>&nbsp; ");
								
							if($row[icon_hit70]==1)	echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
							if($row[icon_new70]==1)	echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
							if($row[icon_sale70]==1) echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red'>$row[discount70]%</font>");
							
							if($row[icon_sale70]==0) echo("
								</td>
							</tr>
							
							<tr><td height='20' align='center'><b> $price 원</b></td></tr>
						</table>
						</td>");
							else echo("
								</td>
							</tr>
							<tr><td height='20' align='center'><strike>$price 원</strike><br><b> $d_price 원</b></td></tr>
						</table>
						</td>");
			 }
			 else
				 echo("<td></td>");      // 제품 없는 경우
			 $icount++;
		 }
		echo("</tr>");
	}
	echo("</table>");

							
?>
					
				</tr>
				<tr><td height="10"></td></tr>
			</table>
		
<br><br>
			<!---- 화면 우측(SALE) 시작 -------------------------------------------------->	
			<table width="767" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60">
						<img src="images/main_saleproduct.jpg" width="767" height="40">
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0">
				<!---1번째 줄-->
				<tr>
<?
	$num_col=4;   $num_row=2; // column수, row수
	
	$query="select * from product where icon_sale70=1 and status70=1 order by rand() limit 8";

	$result=mysqli_query($db,$query); 	 
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result);           // 출력할 제품 개수
	
	$icount=0;       // 출력한 제품개수 카운터
	
	echo("<table>");
	for ($ir=0; $ir<$num_row; $ir++)
	{
		 echo("<tr>");
		 for ($ic=0;  $ic<$num_col;  $ic++)
		{
			 if ($icount < $count)
			{
				 $row=mysqli_fetch_array($result);
				 $price=number_format($row[price70]);
				 $d_price=number_format(round($row[price70]*(100-$row[discount70])/100, -3) );
						echo("
						<td width='150' height='205' align='center' valign='top'>
						 <table border='0' cellpadding='0' cellspacing='0' width='100' class='cmfont'>
							<tr> 
								<td align='center'> 
									<a href='product_detail.php?no=$row[no70]'><img src='product/$row[image1]' width='180' height='210' border='0'></a>
								</td>
							</tr>
							<tr><td height='5'></td></tr>
							<tr> 
								<td height='20' align='center'>
									<a href='product_detail.php?no=$row[no70]'><font color='444444'>$row[name70]</font></a>&nbsp; ");
								
							if($row[icon_hit70]==1)	echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
							if($row[icon_new70]==1)	echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
							if($row[icon_sale70]==1) echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red'>$row[discount70]%</font>");
							
							if($row[icon_sale70]==0) echo("
								</td>
							</tr>
							
							<tr><td height='20' align='center'><b> $price 원</b></td></tr>
						</table>
						</td>");
							else echo("
								</td>
							</tr>
							<tr><td height='20' align='center'><strike>$price 원</strike><br><b> $d_price 원</b></td></tr>
						</table>
						</td>");
			 }
			 else
				 echo("<td></td>");      // 제품 없는 경우
			 $icount++;
		 }
		echo("</tr>");
	}
	echo("</table>");

							
?>
					
				</tr>
				<tr><td height="10"></td></tr>
			</table>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	


<?
	include "main_bottom.php";
?>