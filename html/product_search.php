<?
	include "main_top.php";
	include "common.php";
	
	$findtext=$_REQUEST[findtext];
	
	$query = "select * from product where name70 like '%$findtext%' order by name70";
	$result=mysqli_query($db,$query); 	 
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result);
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">
				function SearchProduct() {
					form2.submit();
				}
			</script>

			<table border="0" cellpadding="0" cellspacing="0" width="747">
			  <tr><td height="13"></td></tr>
			  <tr>
			    <td height="30" align="center"><p><img src="images/search_title.gif" width="746" height="30" border="0" /></p></td>
			  </tr>
			  <tr><td height="13"></td></tr>
			</table>

			<table width="730" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center" valign="middle" colspan="3" height="5">
						<table border="0" cellpadding="0" cellspacing="0" width="690">
							<tr><td class="cmfont"><img src="images/search_title1.gif" border="0"></td></tr>
      			  <tr><td height="10"></td></tr>
			      </table>
					</td>
				</tr>
				<tr>
					<td width="730" align="center" valign="top" bgcolor="#FFFFFF"> 

        
						<table width="686" border="0" cellpadding=0 cellspacing=0 class="cmfont">
							<tr bgcolor="8B9CBF"><td height="3" colspan="5"></td></tr>
							<tr height="29" bgcolor="EEEEEE"> 
								<td width="80"  align="center">그림</td>
								<td align="center">상품명</td>
								<td width="150" align="right">가격</td>
								<td width="20"></td>
							</tr>
							<tr bgcolor="8B9CBF"><td height="1" colspan="5"  bgcolor="AAAAAA"></td></tr>
<?
		for ($i=0;  $i<$count;  $i++)
		{
			 $row=mysqli_fetch_array($result);
			 $price=number_format($row[price70]);
			 $d_price=number_format(round($row[price70]*(100-$row[discount70])/100, -3) );
					echo("
							<tr height='70'>
								<td width='80' align='center' valign='middle'>
									<a href='product_detail.php?no=$row[no70]'><img src='product/$row[image1]' width='60' height='60' border='0'></a>
								</td>
								<td align='left' valign='middle'>
									<a href='product_detail.php?no=$row[no70]'><font color='#4186C7'><b>$row[name70]</b></font></a><br>");
									if($row[icon_hit70]==1)	echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
									if($row[icon_new70]==1)	echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
									if($row[icon_sale70]==1) echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red'>$row[discount70]%</font>");
									
									if($row[icon_sale70]==0) echo("
								</td>
							<td width='150' align='right' valign='middle'>$price 원</td>
								<td width='20'></td>
							</tr>
							<tr><td align='center' valign='middle' colspan='5' height='1' background='images/ln1.gif'></td></tr>
						");
						else echo("
								</td>
							<td width='150' align='right' valign='middle'><strike>$price 원</strike><br><b> $d_price 원</b></td>
								<td width='20'></td>
							</tr>
							<tr><td align='center' valign='middle' colspan='5' height='1' background='images/ln1.gif'></td></tr>
						");
		 }
?>							

							<tr bgcolor="8B9CBF"><td height="3" colspan="5"></td></tr>
						</table>
					</td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="690">
				<tr>
					<td height="30" class="cmfont" align="center">
						<img src="images/i_prev.gif" align="absmiddle" border="0"> 
						<font color="#FC0504"><b>1</b></font>&nbsp;
						<a href="product_search.html?page=2"><font color="#7C7A77">[2]</font></a>&nbsp;
						<a href="product_search.html?page=3"><font color="#7C7A77">[3]</font></a>&nbsp;
						<img src="images/i_next.gif" align="absmiddle" border="0">
					</td>
				</tr>
			</table>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_bottom.php";
?>