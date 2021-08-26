 <?
	include  "../common.php";
	$no=$_REQUEST[no];

	$uid=$_REQUEST[uid]; 
	$pwd=$_REQUEST[pwd];
	$name=$_REQUEST[name];
	$birthday1=$_REQUEST[birthday1];
	$birthday2=$_REQUEST[birthday2];
	$birthday3=$_REQUEST[birthday3];
	$sm=$_REQUEST[sm];
	$tel1=$_REQUEST[tel1];
	$tel2=$_REQUEST[tel2];
	$tel3=$_REQUEST[tel3];
	$phone1=$_REQUEST[phone1];
	$phone2=$_REQUEST[phone2];
	$phone3=$_REQUEST[phone3];
	$email=$_REQUEST[email]; 
	$zip=$_REQUEST[zip];
	$juso=$_REQUEST[juso];
	$gubun=$_REQUEST[gubun];
	
	$tel = sprintf("%-2s%-3s%-4s", $tel1, $tel2, $tel3);
	$phone = sprintf("%-3s%-4s%-4s", $phone1, $phone2, $phone3);
	$birthday = sprintf("%04s-%02s-%02s", $birthday1, $birthday2, $birthday3);
  
    $query="update member set pwd70='$pwd', name70='$name', tel70='$tel', sm70=$sm, phone70='$phone',
				birthday70='$birthday', zip70='$zip', juso70='$juso', email70='$email', gubun70=$gubun
				where no70=$no;";
	

	$result=mysqli_query($db,$query);
	if(!$result) exit("에러:$query");

	echo("<script>location.href='member.php'</script>");
?>