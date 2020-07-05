<div class='pagination'><ul>
<?php
$newParams="";
//echo $_SERVER["QUERY_STRING"]."<br>";
$qryString=explode("&",$_SERVER["QUERY_STRING"]);
$VARS= ($_POST) ? $_POST : $_GET;
foreach($VARS as $key=>$value){

//echo "key=".$key." value= ".$value."<br>";
	if($key!="page" && $key!="prev" && $key!="next")
		$newParams.="&".$key."=".$value;
//echo "[params=".$newParams."]<br>";
}
//echo "array<br>";
//print_r($VARS);
//exit();

if( $pageno >1 )
	echo("<li><a  href=\"".$report_filename."?".$newParams."&page=".($pageno-1)."\">Newer ".$NOOFLINES."</a>&nbsp;</li>");
$numberOfpages =floor($RESULTDATACOUNT/$NOOFLINES);
if($RESULTDATACOUNT % $NOOFLINES > 0)
	$numberOfpages++;
$cntr=0;
for($x=$startn ; $x<= $numberOfpages ; $x++)
{
	if($x==$pageno){
		$startLine=($x*$NOOFLINES)-$NOOFLINES;
		if($RESULTDATACOUNT<($x*$NOOFLINES))
			$endLine=$RESULTDATACOUNT;
		else
			$endLine=($x*$NOOFLINES);
		echo("<li class='active'><a>".$startLine."-".$endLine."</a></li>&nbsp;");
		}
	else
	{
		if($cntr>=$MAXPAGENOS)
			break;
		echo("<li><a  href=\"".$report_filename."?".$newParams."&page=".$x."\">".$x."</a>&nbsp;</li>");
	}
	$cntr++;
}
if($RESULTDATACOUNT/$NOOFLINES > $pageno )
	echo("<li><a  href=\"".$report_filename."?".$newParams."&page=".($pageno+1)."\">Older ".$NOOFLINES."</a></li>");
echo "</div>";				 
?>