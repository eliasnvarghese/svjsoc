
			  <div class="main_no">
			  <?php
			  	if( $pageno >$MAXPAGENOS)
				?>
					<a   style='text-decoration:none;' href="javascript:execute_prev(<?php echo $startn-1; ?>)"><div class="main_no_20_20" >&lt;&lt;</div></a>&nbsp;
					<?php
			  	if( $pageno >1 )
				?>
			  		<a  href="javascript:execute_page(<?php echo $pageno-1;?>)"> <div class="main_no_20_20">&lt;</div></a>&nbsp;
			  	<?php
				$numberOfpages =floor(sizeof($resultData)/$NOOFLINES);
			  	if(sizeof($resultData) % $NOOFLINES > 0)
			  		$numberOfpages++;
			  	$cntr=0;
			  	for($x=$startn ; $x<= $numberOfpages ; $x++)
			  	{
			  		if($x==$pageno){
					?>
			  			<div class="main_no_20_20"><font  style='color:red;'><?php echo $x; ?></font></div>&nbsp;
			  		<?php
					}
					else
			  		{
			  			if($cntr>=$MAXPAGENOS)
			  				break;
						?>
						<a  href="javascript:execute_page(<?php echo $x;?>)"><div class="main_no_20_20"><?php echo $x;?></div></a>&nbsp;
						<?php
			  		}
			  		$cntr++;
			  	}
			  	if(sizeof($resultData)/$NOOFLINES > $pageno )
				?>
			  	<a  href="javascript:execute_page(<?php echo $pageno+1; ?>)"><div  class="main_no_20_20">&gt;</div></a>
					<?php
			  	if($x<$numberOfpages)
					?>
				
			  	<a  href="javascript:execute_next(<?php echo $x; ?>)"><div class="main_no_20_20">&gt;&gt;</div></a>
			  	</div>
			  	
