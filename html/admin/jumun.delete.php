<?
	include "../common.php";

	$no=$_REQUEST[no];

	$query="delete from jumun70 where no70=$no;";
	$result=mysql_query($query);
	if(!$result) exit("에러주문: $query");

	$query="delete from jumuns70 where jumun_no70=$no;";
	$result=mysql_query($query);
	if(!$result) exit("에러주문s: $query");
	echo("<script>location.href='jumun.php'</script>");

?>