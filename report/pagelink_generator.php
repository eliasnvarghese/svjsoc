<style type="text/css">

#pagin{	
	margin-top:5px;
}
.page-numbers{
	color: #FFFFFF;
	font-size: 16px;
	background-color: #D33C54;	
	padding:5px;
	margin:2px;
}
.page-inactive{
	color: #FFFFFF;
	font-size: 16px;
	background-color: #2190D7;
	padding:5px;
	margin:2px;
}
</style>
<span id="pagin" >
<nav class='pagination'><ol >
<?php
$thisPage=basename($_SERVER['PHP_SELF']);
$report_filename=$thisPage;
$newParams="";
//echo $_SERVER["QUERY_STRING"]."<br>";

$qryString=explode("&",$_SERVER["QUERY_STRING"]);

foreach($qryString as $params){
	$keyvalue=explode("=",$params);
	if(array_key_exists(1,$keyvalue)){
		$key=$keyvalue[0];
		$value=$keyvalue[1];
		if($key!="page" && $key!="prev" && $key!="next" && $key!=""){
			$newParams.="&".$key."=".$value;
		}
	}
}

/*
$VARS= ($_POST) ? $_POST : $_REQUEST;
foreach($VARS as $key=>$value){
//echo "key=".$key." value= ".$value."<br>";
	if($key!="page" && $key!="prev" && $key!="next")
		$newParams.="&".urldecode($key)."=".$value;
//echo "[params=".$newParams."]<br>";
}
*/


//echo "array<br>";
//print_r($VARS);
//exit();
if( $pageno >$MAXPAGENOS)
	echo("<a   style='text-decoration:none;' href=\"".$report_filename."?".$newParams."&prev=".($startn-1)."\">&lt;&lt;</a>");
if( $pageno >1 )
	echo("<a class='page-inactive'  href=\"".$report_filename."?".$newParams."&page=".($pageno-1)."\">&lt;</a>");
$numberOfpages =floor($RESULTDATACOUNT/$NOOFLINES);
if($RESULTDATACOUNT % $NOOFLINES > 0)
	$numberOfpages++;
$cntr=0;
for($x=$startn ; $x<= $numberOfpages ; $x++)
{
	if($x==$pageno)
		echo("<span class='page-numbers current'>".$x."</span>");
	else
	{
		if($cntr>=$MAXPAGENOS)
			break;
		echo("<a class='page-inactive' href=\"".$report_filename."?".$newParams."&page=".$x."\">".$x."</a>");
	}
	$cntr++;
}
if($RESULTDATACOUNT/$NOOFLINES > $pageno )
	echo("<a class='page-inactive'  href=\"".$report_filename."?".$newParams."&page=".($pageno+1)."\">&gt;</a>");
if($x<$numberOfpages)
	echo("<a class='page-inactive' href=\"".$report_filename."?".$newParams."&next=".($x)."\">&gt;&gt;</a>");
echo "</ol></nav></span>";	
?>
<script>
	document.getElementById('top_pagination').innerHTML=document.getElementById('pagin').innerHTML;
</script>			 