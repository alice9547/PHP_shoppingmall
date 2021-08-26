<?
	include "common.php";
	
	$cart = $_COOKIE[cart];
	$n_cart = $_COOKIE[n_cart];
	$cookie_no=$_COOKIE[cookie_no];
	$cookie_name=$_COOKIE[cookie_name];
	
	$o_name=$_REQUEST[o_name];
	$o_tel=$_REQUEST[o_tel];	
	$o_phone=$_REQUEST[o_phone];
	$o_email=$_REQUEST[o_email]; 
	$o_zip=$_REQUEST[o_zip];
	$o_juso=$_REQUEST[o_juso];


	$r_name=$_REQUEST[r_name];
	$r_tel=$_REQUEST[r_tel];	
	$r_phone=$_REQUEST[r_phone];
	$r_email=$_REQUEST[r_email]; 
	$r_zip=$_REQUEST[r_zip];
	$r_juso=$_REQUEST[r_juso];
	$memo=$_REQUEST[memo];
	
	$pay_method=$_REQUEST[pay_method];
	$card_okno=$_REQUEST[card_okno];
	$card_halbu=$_REQUEST[card_halbu];
	$card_kind=$_REQUEST[card_kind];
	
	$bank_kind=$_REQUEST[bank_kind];
	$bank_sender=$_REQUEST[bank_sender];
	
	$total=$_REQUEST[total];
	$state=$_REQUEST[state];
	////////////////////////////

	$query = "select no70 from jumun where jumunday70=curdate() order by no70 desc limit 1";
	$result=mysqli_query($db,$query); 	 
	if (!$result) exit("에러:$query");                
	$count=mysqli_num_rows($result); 
	$row0=mysqli_fetch_array($result);

	if ($count>0)      // 주문번호가 있으면
		$n_no=(int)$row0[no70]+1;
	else
	   $n_no=date("ymd")."0001";

$total=0;
$product_nums = 0;
$product_names = "";
$name="";

for ($i=1;  $i<=$n_cart;  $i++)
{
   if ($cart[$i]) // 제품정보가 있는 경우만
   {
       list($no, $num, $opts1, $opts2)=explode("^", $cart[$i]);
       
	   $query="select * from product where no70=$no";
		$result=mysqli_query($db,$query); 	 
		if (!$result) exit("에러:$query");                
		$count=mysqli_num_rows($result); 
		$row=mysqli_fetch_array($result);
	   //제품정보(제품번호, 단가, 할인여부, 할인율) 알아내기

$t_price = round($row[price70]*(100-$row[discount70])/100, -3);	//계산

		$query="insert into jumuns (jumun_no70, product_no70, num70, price70, cash70, discount70, opts_no1, opts_no2)
				values('$n_no', $row[no70], $num, $t_price, $t_price*$num, $row[discount70], $opts1, $opts2);";
		$result=mysqli_query($db,$query);
		if(!$result) exit("에러:$query");
		
		setcookie("cart[$i]",); 
	}
		
	$total=$total+ $t_price*$num;
	$product_nums++;
	
	if ($product_nums==1) $product_names=$row[name70];
}



if ($product_nums>1)      // 제품수가 2개 이상인 경우만, "외 ?" 추가
{
    $tmp = $product_nums;
    $product_names = $product_names." 외 ".$tmp;
}

if ($total < $max_baesongbi)
{
    $query="insert into jumuns (jumun_no70, product_no70, num70, price70, cash70, discount70, opts_no1, opts_no2)
				values('$n_no', 0, 1, $baesongbi, $baesongbi, 0, 0, 0);";
		$result=mysqli_query($db,$query);
		if(!$result) exit("에러:$query");
		$total= (int)$total + (int)$baesongbi;
}


if ($cookie_no)
   $cookie_no=$cookie_no;
else
   $cookie_no=0;

	setcookie("n_cart",0);

	$day=date("ymd");
	
//insert SQL문을 이용하여 jumun 테이블에 주문 전체정보 저장.
$query="insert into jumun (no70, member_no70, jumunday70, product_names70, product_nums70, 
						o_name70, o_tel70, o_phone70, o_email70, o_zip70, o_juso70, 
						r_name70, r_tel70, r_phone70, r_email70, r_zip70, r_juso70, memo70,
						pay_method70, card_okno70, card_halbu70, card_kind70, 
						bank_kind70, bank_sender70,
						total_cash70, state70)
					values('$n_no', $cookie_no,'$day', '$product_names', $product_nums,
					'$o_name', '$o_tel','$o_phone','$o_email','$o_zip','$o_juso',
					'$r_name','$r_tel','$r_phone','$r_email','$r_zip','$r_juso',
					'$memo', $pay_method, '$n_no', $card_halbu, $card_kind, $bank_kind, 
					'$bank_sender', $total, 1);";
		$result=mysqli_query($db,$query);
		if(!$result) exit("에러:$query");

	echo("<script>location.href='order_ok.php'</script>");

?>