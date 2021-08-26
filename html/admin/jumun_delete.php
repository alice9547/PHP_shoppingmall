<?
	include "../common.php";

	$no=$_REQUEST[no];

	$query="delete from jumun where no70='$no';";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러주문: $query");

	$query="delete from jumuns where jumun_no70='$no';";
	$result=mysqli_query($db,$query);
	if(!$result) exit("에러주문s: $query");
	
	echo("<script>location.href='jumun.php'</script>");

?>