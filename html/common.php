<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	ini_set("display_errors",1);

	$page_line =5;
	$page_block=5;

	$db=mysqli_connect("localhost","shop70","1234","shop70");
	if(!$db) exit("DB연결에러");
	
	$admin_id = "admin";
	$admin_pw="1234"; 
	
	$a_idname=array("전체","이름","ID");
	$n_idname=count($a_idname);
	
	$a_menu=array("분류선택","모자","후드","겉옷","바지","윗도리","반소매");
	$n_menu=count($a_menu);

	$a_status=array("상품상태","판매중","판매중지","품절");
	$n_status=count($a_status);

	$a_icon=array("아이콘","New","Hit","Sale");
	$n_icon=count($a_icon);

	$a_text1=array("","제품이름","제품번호");   // for문의 $i는 1부터 시작
	$n_text1=count($a_text1);

	$baesongbi = 2500;
    $max_baesongbi = 100000;
	
	$a_state=array("전체","주문신청","주문확인","입금확인", "배송중", "주문완료", "주문취소");
	$n_state=count($a_state);
	
	$a_text2=array("","주문번호","고객명","제품명");   // for문의 $i는 1부터 시작
	$n_text2=count($a_text2);

	date_default_timezone_set('Asia/Seoul');
?>