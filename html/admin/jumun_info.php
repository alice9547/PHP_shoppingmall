<?
	include "../common.php";
	$no=$_REQUEST[no];
	
	$query="select * from jumun where no70='$no';";
	$result=mysqli_query($db,$query); 
	if (!$result) exit("에러:$query");
	$count=mysqli_num_rows($result); 
	$row=mysqli_fetch_array($result);
	
?>
<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>
<?
	$state=$a_state[$row[state70]];
?>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문번호</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE">&nbsp;<font size="3"><b><?=$row[no70];?> (<font color="blue"><?=$state;?></font>)</b></font></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문일</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[jumunday70];?></td>
	</tr>
</table>
<br>
<?
	$tel1=trim(substr($row[o_tel70],0,2));
	$tel2=trim(substr($row[o_tel70],2,3));
	$tel3=trim(substr($row[o_tel70],5,5));
	$o_tel=$tel1."-".$tel2."-".$tel3;
	
	$tel1=trim(substr($row[r_tel70],0,2));
	$tel2=trim(substr($row[r_tel70],2,3));
	$tel3=trim(substr($row[r_tel70],5,5));
	$r_tel=$tel1."-".$tel2."-".$tel3;
	
	$phone1=trim(substr($row[o_phone70],0,3));
	$phone2=trim(substr($row[o_phone70],3,4));
	$phone3=trim(substr($row[o_phone70],7,4));
	$o_phone=$phone1."-".$phone2."-".$phone3;
	
	$phone1=trim(substr($row[r_phone70],0,3));
	$phone2=trim(substr($row[r_phone70],3,4));
	$phone3=trim(substr($row[r_phone70],7,4));
	$r_phone=$phone1."-".$phone2."-".$phone3;
?>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[o_name70];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$o_tel;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[o_email70];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$o_phone;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?=$row[o_zip70]?>) <?=$row[o_juso70]?></td>
	</tr>
	</tr>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[r_name70]?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$r_tel;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[r_email70];?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$r_phone;?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?=$row[r_zip70]?>) <?=$row[r_juso70]?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">메모</font></td>
        <td width="300" height="50" bgcolor="#EEEEEE" colspan="3"><?=$row[memo70]?></td>
	</tr>
</table>
<br>
<?
	if($row[pay_method70]==1)
	{
		$pay="무통장";
		$halbu="-";
		$card="-";
		
		if($row[bank_kind70]==0)
			$bank="국민은행 : 123-456-7891";
		if($row[bank_kind70]==1)
			$bank="신한은행 : 110-456-000891";
	}
	else
	{ 
		$pay="카드";
		
		if($row[card_halbu70]==0)
			$halbu="일시불";
		if($row[card_halbu70]==3)
			$halbu="3개월 할부";
		if($row[card_halbu70]==6)
			$halbu="6개월 할부";
		if($row[card_halbu70]==9)
			$halbu="9개월 할부";
		if($row[card_halbu70]==12)
			$halbu="12개월 할부";
		$card="개인";
	}
?>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">지불종류</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$pay;?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드승인번호 </font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[card_okno70]?>&nbsp</td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드 할부</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$halbu;?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">카드종류</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$card?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">무통장</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$bank;?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">입금자이름</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?=$row[bank_sender70]?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC"> 
    <td width="340" height="20" align="center"><font color="#142712">상품명</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">수량</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">단가</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">금액</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">할인</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션1</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션2</font></td>
	</tr>
<?
	$query="select product.name70 as n1, opts1.name70 as n2, opts2.name70 as n3, jumuns.price70, jumuns.cash70, jumuns.num70, jumuns.discount70
		from jumuns, product, opts as opts1, opts as opts2 
		where jumuns.product_no70=product.no70
			and jumuns.opts_no1=opts1.no70
			and jumuns.opts_no2=opts2.no70
			and jumuns.jumun_no70='$no';";
	
	$result=mysqli_query($db,$query);
	if (!$result) exit("에러:$query");
	$count=mysqli_num_rows($result); 
	
	for($i=0; $i<$count; $i++)
	{
		$row1=mysqli_fetch_array($result);
		$price = number_format($row1[price70]);
		$cash = number_format($row1[cash70]);
		
		echo("<tr bgcolor='#EEEEEE' height='20'>	
				<td width='340' height='20' align='left'>$row1[n1]</td>	
				<td width='50' height='20' align='center'>$row1[num70]</td>	
				<td width='70' height='20' align='right'>$price</td>	
				<td width='70' height='20' align='right'>$cash</td>	
				<td width='50' height='20' align='center'>$row1[discount70] %</td>	
				<td width='60' height='20' align='center'>$row1[n2]</td>	
				<td width='60' height='20' align='center'>$row1[n3]</td>	
			</tr>"			
			);
	}
	
	if($row[total_cash70]<$max_baesongbi)
	{
		$v_baesongbi = number_format($baesongbi);
		
		echo("<tr bgcolor='#EEEEEE' height='20'>	
				<td width='340' height='20' align='left'>배송비</td>	
				<td width='50' height='20' align='center'>&nbsp;</td>	
				<td width='70' height='20' align='right'>$v_baesongbi</td>		
				<td width='50' height='20' align='right'>$v_baesongbi</td>	
				<td width='60' height='20' align='center'>&nbsp;</td>	
				<td width='60' height='20' align='center'>&nbsp;</td>	
				<td width='60' height='20' align='center'>&nbsp;</td>	
			</tr>");
	}
?>	

</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
	  <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">총금액</font></td>
		<td width="700" height="20" bgcolor="#EEEEEE" align="right"><font color="#142712" size="3"><b><?=$row[total_cash70];?></b></font> 원&nbsp;&nbsp</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="button" value="이 전 화 면" onClick="javascript:history.back();">&nbsp
			<input type="button" value="프린트" onClick="javascript:print();">
		</td>
	</tr>
</table>

</center>

<br>
</body>
</html>
