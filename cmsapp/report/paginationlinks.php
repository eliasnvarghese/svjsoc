
			  <div class="main_no">
			  <?php
			  	if( $pageno >$MAXPAGENOS)
					echo("<a   style='text-decoration:none;' href=\"".$report_filename."?prev=".($startn-1)."\"><div class=\"main_no_20_20\">&lt;&lt;</div></a>&nbsp;");
			  	if( $pageno >1 )
			  		echo("<a  href=\"".$report_filename."?page=".($pageno-1)."\"><div class=\"main_no_20_20\">&lt;</div></a>&nbsp;");
			  	$numberOfpages =floor(sizeof($resultData)/$NOOFLINES);
			  	if(sizeof($resultData) % $NOOFLINES > 0)
			  		$numberOfpages++;
			  	$cntr=0;
			  	for($x=$startn ; $x<= $numberOfpages ; $x++)
			  	{
			  		if($x==$pageno)
			  			echo("<div class=\"main_no_20_20\"><font  style='color:red;'>".$x."</font></div>&nbsp;");
			  		else
			  		{
			  			if($cntr>=$MAXPAGENOS)
			  				break;
			  			echo("<a  href=\"".$report_filename."?page=".$x."\"><div class=\"main_no_20_20\">".$x."</div></a>&nbsp;");
			  		}
			  		$cntr++;
			  	}
			  	if(sizeof($resultData)/$NOOFLINES > $pageno )
			  		echo("<a  href=\"".$report_filename."?page=".($pageno+1)."\"><div  class=\"main_no_20_20\">&gt;</div></a>");
			  	if($x<$numberOfpages)
			  		echo("<a  href=\"".$report_filename."?next=".($x)."\"><div class=\"main_no_20_20\">&gt;&gt;</div></a>");
			  	echo "</div>";
			  	
				 
?>