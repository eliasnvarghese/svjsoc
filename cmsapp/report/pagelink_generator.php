<ul class="pagination pagination-sm inline pull-right">
<?php
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
	echo("<li><a   style='text-decoration:none;' href=\"".$report_filename."?".$newParams."&prev=".($startn-1)."\">&lt;&lt;</a></li>");
if( $pageno >1 )
	echo("<li><a  href=\"".$report_filename."?".$newParams."&page=".($pageno-1)."\">&lt;</a></li>");
$numberOfpages =floor($RESULTDATACOUNT/$NOOFLINES);
if($RESULTDATACOUNT % $NOOFLINES > 0)
	$numberOfpages++;
$cntr=0;
for($x=$startn ; $x<= $numberOfpages ; $x++)
{
	if($x==$pageno)
		echo("<li class='active'><a>".$x."</a></li>");
	else
	{
		if($cntr>=$MAXPAGENOS)
			break;
		echo("<li><a  href=\"".$report_filename."?".$newParams."&page=".$x."\">".$x."</a></li>");
	}
	$cntr++;
}
if($RESULTDATACOUNT/$NOOFLINES > $pageno)
	echo("<li><a  href=\"".$report_filename."?".$newParams."&page=".($pageno+1)."\">&gt;</a></li>");
if($x<$numberOfpages)
	echo("<li><a  href=\"".$report_filename."?".$newParams."&next=".($x)."\">&gt;&gt;</a></li>");
echo "</ul>";	
?>
<script>
	document.getElementById('top_pagination').innerHTML=document.getElementById('pagin').innerHTML;
</script>			 