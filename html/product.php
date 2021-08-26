<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "main_top.php";
	include "common.php";
	
	$menu=$_REQUEST[menu];
	$sort=$_REQUEST[sorts];
	
	$query="select * from product where menu70=$menu and status70=1";
	$result=mysqli_query($db,$query); 	 
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result);  
	$row=mysqli_fetch_array($result);
	

?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

      <!-- 하위 상품목록 -->

			<!-- form2 시작 -->
			<form name="form2" method="post" action="product.php">
			<input type="hidden" name="menu" value="<?=$menu;?>">

			<table border="0" cellpadding="0" cellspacing="5" width="959" class="cmfont" bgcolor="#efefef">
				<tr>
					<td bgcolor="white" align="center">
						<table border="0" cellpadding="0" cellspacing="0" width="954" class="cmfont">
							<tr>
								<td align="center" valign="middle">
									<table border="0" cellpadding="0" cellspacing="0" width="930" height="40" class="cmfont">
										<tr>
											<td width="500" class="cmfont">
												<font color="#C83762" class="cmfont"><b><?=$a_menu[$menu];?> &nbsp</b></font>&nbsp
											</td>
											<td align="right" width="274">
												<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cmfont">
													<tr>
														<td align="right"><font color="EF3F25"><b><?=$count;?></b></font> 개의 상품.&nbsp;&nbsp;&nbsp</td>
														<td width="100">
															<select name="sorts" size="1" class="cmfont" onChange="form2.submit()">
<?																
																if ($sort=="up") 
																	echo("<option value='new'>신상품순 정렬</option>
																			<option value='up' selected>고가격순 정렬</option>
																			<option value='down'>저가격순 정렬</option>
																			<option value='name'>상품명 정렬</option>");
																
																elseif ($sort=="down") 
																	echo("<option value='new'>신상품순 정렬</option>
																			<option value='up' >고가격순 정렬</option>
																			<option value='down' selected>저가격순 정렬</option>
																			<option value='name'>상품명 정렬</option>");
																elseif ($sort=="name") 
																	echo("<option value='new'>신상품순 정렬</option>
																			<option value='up'>고가격순 정렬</option>
																			<option value='down'>저가격순 정렬</option>
																			<option value='name' selected>상품명 정렬</option>");
																else
																	echo("<option value='new' selected>신상품순 정렬</option>
																			<option value='up' >고가격순 정렬</option>
																			<option value='down'>저가격순 정렬</option>
																			<option value='name'>상품명 정렬</option>");	
?>																
															</select>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			</form>
			<!-- form2 -->

			<table border="0" cellpadding="0" cellspacing="0">
				<!--- 1 번째 줄 -->
				<tr>
<?
				if ($sort=="up")            // 고가격순
				   $query="select * from product where menu70=$menu and status70=1 order by price70 desc";
				elseif ($sort=="down")  // 저가격순
				   $query="select * from product where menu70=$menu and status70=1 order by price70";
				elseif ($sort=="name")  // 이름순
				   $query="select * from product where menu70=$menu and status70=1 order by name70";
				else                              // 신상품순
				   $query="select * from product where menu70=$menu and status70=1 order by no70 desc";

				$result=mysqli_query($db,$query); 	 
				if (!$result) exit("에러:$query");                
				$count=mysqli_num_rows($result);           // 출력할 제품 개수
				
				$num_col=5; $num_row=2;                // column수, row수
				$page_line=$num_col*$num_row;       // 1페이지에 출력할 제품수
				$icount=0;
				
				$page=$_REQUEST[page];
				if(!$page) $page=1;
				$pages=ceil($count/$page_line);
				$first=1;
				if($count>0) $first=$page_line*($page-1);
				$page_last=$count - $first;
				if($page_last>$page_line) $page_last=$page_line;

				if($count>0) mysqli_data_seek($result,$first);
				

						
				echo("<table border='0' cellpadding='0' cellspacing='0'>");
				for ($ir=0;  $ir<$num_row;  $ir++)
				{
					 echo("<tr>");
					 for ($ic=0;  $ic<$num_col;  $ic++)
					 {
						  if ($icount <= $page_last-1 )
						 {
							 $row=mysqli_fetch_array($result);
							 $price=number_format($row[price70]);
							 $d_price=number_format(round($row[price70]*(100-$row[discount70])/100, -3) );
						echo("
							<td width='180' height='205' align='center' valign='top'>
							 <table border='0' cellpadding='0' cellspacing='0' width='140' class='cmfont'>
								<tr> 
									<td align='center'> 
										<a href='product_detail.php?no=$row[no70]'><img src='product/$row[image1]' width='120' height='140' border='0'></a>
									</td>
								</tr>
								<tr><td height='5'></td></tr>
								<tr> 
									<td height='20' align='center'>
										<a href='product_detail.php?no=$row[no70]'><font color='444444'>$row[name70]</font></a>&nbsp; ");
									
								if($row[icon_hit70]==1)	echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'>");
								if($row[icon_new70]==1)	echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'>");
								if($row[icon_sale70]==1) echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> <font color='red'>$row[discount70]%</font>");
								
								if($row[icon_sale70]==0) 
								{	
									echo("</td></tr>
								<tr><td height='20' align='center'><b> $price 원</b></td></tr>
							</table>
								</td>");
								}
								else 
								{
									echo("
									</td>
								</tr>
								<tr><td height='20' align='center'><strike>$price 원</strike><br><b> $d_price 원</b></td></tr>
							</table>
							</td>");
								}
						 }
						 else
							  echo("<tr><td></td></tr>");
						 $icount++;
					  }
					  echo("</tr>");
					
				}
				echo("</table>");

	echo("<table border='0' cellpadding='0' cellspacing='0' width='800'>
		<tr>
		<td height='30' align='center'>");

	$blocks = ceil($pages/$page_block);
	$block = ceil($page/$page_block);
	$page_s = $page_block * ($block-1);
	$page_e = $page_block * $block;
	if($blocks <= $block) $page_e = $pages;

	if($block>1)
	{
		$tmp=$page_s;
		echo("<a href='product.php?menu=$menu&page=$tmp&text1=$text1'>
				<img src='images/i_prev.gif' align='absmiddle' border='0'>
				</a> &nbsp");
	}

	for($i=$page_s+1; $i<=$page_e; $i++)
	{
		If ($page==$i)
			echo("&nbsp;<font ed'> <b>$i</b> </font> &nbsp;");
	else
		echo ("&nbsp;<a href='product.php?menu=$menu&page=$i&text1=$text1'> [$i] </a> &nbsp;");
	}

	If ($block < $blocks)
	{
		$tmp=$page_e+1;
		echo("<a href='product.php?menu=$menu&page=$tmp&text1=$text1'>
				<img src='images/i_next.gif' align='absmiddle' border='0'>
			</a>");
	}
	echo("	</td>
		</tr>
	</table>");

	include "main_bottom.php";
?>