<?php
/****************************************
 * @Project     : St Stephen Church 
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
putenv("TZ=Asia/Calcutta");
date_default_timezone_set('Asia/Calcutta');

function dateDisplayFormat($dt,$format){
	if($dt=='0000-00-00 00:00:00'){
		return "";
	}
	$date = strtotime($dt);
    return date($format, $date);
}
function isValidDateRange($fromdate,$todate){
	$date1 = strtotime(convertFromUserDateToYmd($fromdate));
	$date2 = strtotime(convertFromUserDateToYmd($todate));
	$diff= $date2-$date1;
	if($diff>=0)
		return true;
	return false;
}
function moneyDisplayFormat($money,$decimals=2){
	$money=number_format($money,$decimals,'.','');
    return $money;
}
function convertXXXXXFromDmyToYmd($ddmmyyyy){
	$yyyymmdd=implode("/", array_reverse(explode("/", $ddmmyyyy)));
	return $yyyymmdd;
}
function convertFromUserDateToYmd($user_date){
	$mysql_date = date('Y-m-d H:i:s', strtotime($user_date));
	return $mysql_date;
}


function addMonthWithDate($date,$month){

    $date = strtotime("+".$month." month", strtotime($date));
    return  date("Y-m-d", $date);
}
function addYearWithDate($date,$year){

    $date = strtotime("+".$year." year", strtotime($date));
    return  date("Y-m-d", $date);
}
function addDaysWithDate($date,$days){

    $date = strtotime("+".$days." days", strtotime($date));
    return  date("Y-m-d", $date);
}
function getFirstSentense($text,$len=0){
	$firstSent=$text;
	if(strlen($text)>$len ){
		if($len>0){
			$firstSent=substr($text,0,$len)." ...";
		}
		else{
			$array = explode('.',$text,2);
			$firstSent = $array[0];
		}
	}
	return $firstSent;
}
function readCookieByValue($cookieName,$instName,$value)
{
	if (isset($_COOKIE[$cookieName])) {
		foreach ($_COOKIE[$cookieName] as $name => $val) {
			$name = htmlspecialchars($name);
			$val = htmlspecialchars($val);	
			if($name==$instName ."-". $value){
				return true;
			}
		}
	}
	return false;
}
function curl_get($url) {
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 30);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	$return = curl_exec($curl);
	curl_close($curl);
	return $return;
}
function getNewsContent($content,$reqLen,$isUnicode){
			$newsStr=(strlen( $content)>$reqLen)? substr($content,0,$reqLen)."......":$content;
			if($isUnicode)
				$pos = strripos($newsStr, "&");
			else
				$pos = strripos($newsStr, " ");
			if ($pos>0) {
				$newsStr=substr($content,0,$pos).".....";
			}
			return $newsStr;
	}
function makeParagraph($paragraph,$style="",$classname="",$stdLen=300){
	$more=true;
	$newpara="";
	while($more=true)
	{
		if(strlen(trim($paragraph)) <= 0)
			break;
		if(strlen($paragraph) > $stdLen){
			$lastPos = stripos($paragraph, ". ", $stdLen);
			if($lastPos>0){ 
				$lastPos++;
				$firstpart=substr($paragraph,0,$lastPos);
				$newpara.= "<p ".((trim($classname)!="") ? "class='$classname'":"")." ".((trim($style)!="") ? "style='$style'":"").">".$firstpart."</p>";
				$paragraph=substr($paragraph,$lastPos);
			}
			else{
				$newpara.= "<p ".((trim($classname)!="") ? "class='$classname'":"")." ".((trim($style)!="") ? "style='$style'":"").">".$paragraph."</p>";
				break;
			}
		}
		else{
			$newpara.= "<p ".((trim($classname)!="") ? "class='$classname'":"")." ".((trim($style)!="") ? "style='$style'":"").">".$paragraph."</p>";
			break;
		}
	}
	return $newpara;
}
// function conversion of date from m-d-Y to  Y-m-d
function getDbDate($date)
{
	$date = str_replace('/', '-', $date);
	return date('Y-m-d', strtotime($date));
}

function getDateInDisplayFormat($date)
{

	$dates=explode("-",substr($date,0,10));
	$dt = mktime(0, 0, 0, $dates[1] , $dates[2], $dates[0]);
	$newdate=date("m-d-Y",$dt);
	return $newdate;
}

function getDateTimeInDisplayFormat($date)
{
	$dates=explode("-",substr($date,0,10));
	$times=substr($date,10);
	$dt = mktime(0, 0, 0, $dates[1] , $dates[2], $dates[0]);
	$newdate=date("m-d-Y",$dt);
	return $newdate." ".$times;
}

//function to add quotes in strings
function quote($str)
{
	$newstr = str_replace("'","''",$str);
	$newstr = stripslashes($newstr);
	return "'".$newstr."'";
}

//function for e-mail validation
function isValidEmail($email)
{
	return @eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}


function selectboxArrayFill(&$array, $selboxname, $selval, $funcname)
{
  $choiceStr="";
  $choiceStr=$choiceStr. '<SELECT name="'. $selboxname.'" id="'. $selboxname.'" onChange="'.$funcname.';";>';
  reset($array);
  while(list($key, $value)= each($array))
  {
    if(trim($key)=="")$key=$value;
    if(trim($value)=="")$value=$key;
    $sel="";
    if(trim($value)==trim($selval))
    $sel="SELECTED";
    $choiceStr=$choiceStr. "\n <OPTION ".$sel." value='".urlencode($value)."'>".$value."</OPTION>";
  }
  $choiceStr=$choiceStr. "\n</SELECT>\n";
  return $choiceStr;
}

function encrypt($string, $key)
{
	$result = '';
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	}
	return base64_encode($result);
}



function decrypt($string, $key)
{
	$result = '';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++)
	{
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	}
	return $result;
}

function getDobMonthNew($dt)
{
	if($dt!=NULL)
		list($year, $mon, $dd) = explode("-", $dt);

	for($i=1;$i<=12;$i++)
	{
		$sele="";
		if($dt!=NULL)
			$sele= ($mon==$i) ? " selected " : "" ;

		if($i<10)
			echo "<option ".$sele." value='0".$i."'>0".$i."</option>";
		else
			echo "<option ".$sele." value='".$i."'>".$i."</option>";
	}
}

function getDobMonth()
{

	for($i=1;$i<=12;$i++)
	{
		if($i<10)
			echo "<option value='0".$i."'>0".$i."</option>";
		else
			echo "<option value='".$i."'>".$i."</option>";
	}
}

function getDobDayNew($dt)
{
	if($dt!=NULL)
		list($year, $mon, $dd) = explode("-", $dt);

	for($j=1;$j<=31;$j++)
	{
		$sele="";
		if($dt!=NULL)
			$sele= ($dd==$j) ? " selected " : "" ;

		if($j<10)
			echo "<option ".$sele." value='0".$j."'>0".$j."</option>";
		else
			echo "<option ".$sele." value='".$j."'>".$j."</option>";
	}
}
function getDobDate()
{
	for($j=1;$j<=31;$j++)
	{
		if($j<10)
			echo "<option value='0".$j."'>0".$j."</option>";
		else
			echo "<option value='".$j."'>".$j."</option>";
	}
}

function getDobYearNew($dt)
{
	if($dt!=NULL)
		list($year, $mon, $dd) = explode("-", $dt);

	for($k=date('Y');$k>date('Y')-130;$k--)
	{
		$sele="";
		if($dt!=NULL)
		{
		$sele= ($year==$k) ? " selected " : "" ;
		if($k<10)
			echo "<option ".$sele." value='0".$k."'>0".$k."</option>";
		else
			echo "<option ".$sele." value='".$k."'>".$k."</option>";

}
}
}
function getDobYear()
{
	for($k=date('Y');$k>date('Y')-130;$k--)
	{

			echo "<option value='".$k."'>".$k."</option>";
	}
}
function getLanguage()
{
	echo "<option value='EN' selected='selected' >English(US)</option>";
}

function getConfiguration()
{
	$myfile = "bricksconfig.ini";
	$file = fopen($myfile, "r") or exit("Unable to open file!");
	$line = '';
	$ini_array=array();
	while(!feof($file)) {
		$line = fgets($file);
		$keyvalue=explode("=",$line);
		$ini_array[$keyvalue[0]]=$keyvalue[1];
		//echo "Key : ".$keyvalue[0]. " Value : ".$keyvalue[1]."<br>";
	}
	fclose($file);

	
	return $ini_array;
}

// To get the number of days between two dates
function dateDiff($start, $end)
{
	$start_ts = strtotime($start);
	$end_ts = strtotime($end);
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}

function resultToArray($result)
{
		$fieldcount=mysqli_num_fields($result);
		$resultData=array();
		$fields=array();
		while ($fieldinfo=mysqli_fetch_field($result))
		{
			$fields[]=$fieldinfo->name;
		}
		$i=0;
		while ($row = mysqli_fetch_array ($result))
		{
			$rowV=array();
			for($i=0;$i<$fieldcount;$i++)
			{
				$rowV[$fields[$i]]=$row[$i];
			}
			$resultData[]=$rowV;
		}
		mysqli_free_result($result);
		return $resultData;
}

function getCategoryListCombo($categoryListArray)
{
	$comboOptions="";
	foreach($categoryListArray as $categoryObj)
	{
	   $comboOptions=$comboOptions . " <option value=". $categoryObj->getCategoryId().">". $categoryObj->getCategoryName()."</option>";
	}  
	return $comboOptions;
}

function timeDiff($start_time, $end_time, $std_format = false)
{       
	$total_time = $end_time - $start_time;
	$days       = floor($total_time /86400);        
	$hours      = floor($total_time /3600);     
	$minutes    = intval(($total_time/60) % 60);        
	$seconds    = intval($total_time % 60);     
	$results = "";
	if($std_format == false)
	{
	  if($days > 0) $results .= $days . (($days > 1)?" days ":" day ");     
	  if($hours > 0) $results .= $hours . (($hours > 1)?" hours ":" hour ");        
	  if($minutes > 0) $results .= $minutes . (($minutes > 1)?" minutes ":" minute ");
	  if($seconds > 0) $results .= $seconds . (($seconds > 1)?" seconds ":" second ");
	}
	else
	{
	  if($days > 0) $results = $days . (($days > 1)?" days ":" day ");
	  $results = sprintf("%s%02d:%02d:%02d",$results,$hours,$minutes,$seconds);
	}
	return $results;
}

function timeElapsed($dttm, $std_format = false)
{       
	$start_time = $dttm;
	$end_time= date("Y-m-d H:i:s");
	$seconds = strtotime($end_time) - strtotime($start_time);

	$days    = floor($seconds / 86400);
	$hours   = floor(($seconds - ($days * 86400)) / 3600);
	$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
	$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
	$results = "";
	if($std_format == false)
	{
	  if($days > 0) 
		return $days . " Days ";     
	  if($hours > 0) 
		return  $hours . " Hrs ";        
	  if($minutes > 0) 
		return $minutes . " Min. ";
	  if($seconds > 0) 
		return $seconds . " Sec. ";
	}
	else
	{
	  if($days > 0) $results = $days . (($days > 1)?" days ":" day ");
	  $results = sprintf("%s%02d:%02d:%02d",$results,$hours,$minutes,$seconds);
	}
	return $results;
}
function getElapsedFromSeconds($seconds, $std_format = false)
{
	$days    = floor($seconds / 86400);
	$hours   = floor(($seconds - ($days * 86400)) / 3600);
	$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
	$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
	$results = "";
	if($std_format == false)
	{
	  if($days > 0) 
		return $days . " Days ";     
	  if($hours > 0) 
		return  $hours . " Hrs ";        
	  if($minutes > 0) 
		return $minutes . " Min. ";
	  if($seconds > 0) 
		return $seconds . " Sec. ";
	}
	else
	{
	  if($days > 0) $results = $days . (($days > 1)?" days ":" day ");
	  $results = sprintf("%s%02d:%02d:%02d",$results,$hours,$minutes,$seconds);
	}
	return $results;
}


	function sendNotificMailToAdmin($subject,$message)
	{
		$headers = '' .
		'From: info@nuestrotech.com' . "\r\n" .
			'Reply-To: info@nuestrotech.com' . "\r\n" .
			'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$toaddress="antjosep@gmail.com,josephansal@gmail.com";
		try{
			mail($toaddress, $subject, $message, $headers);
		}
		catch(Exception $e)	{
		}
	}
	function imageResize($newwidth,$target_path,$fileType,$newImageFile){
		$stat=false;
		list($width, $height) = getimagesize($target_path);
		$ratio=$width/$height;
		$newheight = $newwidth/$ratio; 
			// VARS FOR CALL BACK
		$thumb = imagecreatetruecolor($newwidth, $newheight);
		if($fileType == 'image/pjpeg' || $fileType == 'image/jpeg')
			$source = imagecreatefromjpeg($target_path);
		else if($fileType == 'image/x-png' || $fileType == 'image/png')	
			$source = imagecreatefrompng($target_path);
		else if($fileType == 'image/gif')	
			$source = imagecreatefromgif($target_path);
		if(!$source){
			$source = imagecreatefrompng($target_path);
		}

	// RESIZE WITH PROPORTION LIKE PHOTOSHOP HOLDING SHIFT
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	// MAKE NEW FILES
		if($fileType == 'image/pjpeg' || $fileType == 'image/jpeg')	
			$stat=@imagejpeg($thumb, $newImageFile, 100);
		else if($fileType == 'image/x-png' || $fileType == 'image/png')	
			$stat=@imagejpeg($thumb, $newImageFile, 100);
		else if($fileType == 'image/gif')	
			$stat=@imagegif($thumb, $newImageFile, 100);
		
		unlink($target_path);
		return $stat;
	}

	function getNewImageFileType($fileType){
		
		if($fileType == 'image/pjpeg' || $fileType == 'image/jpeg')	{
			return ".jpg";
		}	
		else if($fileType == 'image/x-png' || $fileType == 'image/png')	{
			return ".png";
		}
		else if($fileType == 'image/gif')	{
			return ".gif";
		}
		return ".".$fileType;
	}
	function getElapsedSeconds($start_time)
{       
	$end_time= date("Y-m-d H:i:s");
	$seconds = strtotime($end_time) - strtotime($start_time);
	return $seconds;
}
function getElapsed($seconds, $std_format = false)
{
	$days    = floor($seconds / 86400);
	$hours   = floor(($seconds - ($days * 86400)) / 3600);
	$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
	$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
	$results = "";
	if($std_format == false)
	{
	  if($days > 0) 
		return $days . " Days ";     
	  if($hours > 0) 
		return  $hours . " Hrs ";        
	  if($minutes > 0) 
		return $minutes . " Min. ";
	  if($seconds > 0) 
		return $seconds . " Sec. ";
	}
	else
	{
	  if($days > 0) $results = $days . (($days > 1)?" days ":" day ");
	  $results = sprintf("%s%02d:%02d:%02d",$results,$hours,$minutes,$seconds);
	}
	return $results;
}
function showAdvertisement($ctg,$subctg,$pos,$w,$h,$style=""){
	$advtService=new AdvertisementService();
	$results=$advtService->getAdvertisements($ctg,$pos);
	while($rowAdvt=mysqli_fetch_array($results)){
	?>	
	<a href="javascript: void(0);" onclick="trackAdvertisements('<?php echo $rowAdvt["advturl"]; ?>','<?php echo $rowAdvt["advtid"]; ?>');"  id="<?php echo $rowAdvt["ctg"]."_".$rowAdvt["position"]."_".$rowAdvt["advtid"]; ?>" >
	<img src="<?php echo $rowAdvt["imagepath"]; ?>" alt="" width="<?php echo $w;?>" height="<?php echo $h;?>" style="<?php echo $style; ?>"/></a>
	<?php
	
	}

}
function getListOfCountryOrState($type){
		try{
			$listStr="";
			if($type=="world")
				$listStr="Afghanistan,Albania,Algeria,and,Herzegovina,and,Principe,Andorra,Angola,Antigua,and,Barbuda,Argentina,Armenia,Australia,Austria,Azerbaijan,Bahamas,Bahrain,Bangladesh,Barbados,Belarus,Belgium,Belize,Benin,Bhutan,Bolivia,Bosnia,Botswana,Brazil,Brunei,Bulgaria,Burkina,Burma,(Myanmar),Burundi,Cambodia,Cameroon,Canada,Cape,Verde,Central,African,Chad,Chile,China,Colombia,Comoros,Congo,Congo,Costa,Rica,Croatia,Cuba,Cyprus,Czech,Republic,Denmark,Djibouti,Dominica,Dominican,Rep.,East,Timor,Ecuador,Egypt,El,Salvador,Emirates,Equatorial,Guinea,Eritrea,Estonia,Ethiopia,Federation,Fiji,Finland,France,Gabon,Gambia,Georgia,Germany,Ghana,Greece,Grenada,Guatemala,Guinea,Guinea-Bissau,Guyana,Haiti,Honduras,Hungary,Iceland,India,Indonesia,Iran,Iraq,Ireland,Israel,Italy,Ivory,Coast,Jamaica,Japan,Jordan,Kazakhstan,Kenya,Kiribati,Korea,(north),Korea,(south),Kuwait,Kyrgyzstan,Laos,Latvia,Lebanon,Lesotho,Liberia,Libya,Liechtenstein,Lithuania,Luxembourg,Macedonia,Madagascar,Malawi,Malaysia,Maldives,Mali,Malta,Marshall,Islands,Mauritania,Mauritius,Mexico,Micronesia,Moldova,Monaco,Mongolia,Montenegro,Morocco,Mozambique,Namibia,Nauru,Nepal,Netherlands,New,Zealand,Nicaragua,Niger,Nigeria,Norway,Oman,Pakistan,Palau,Panama,Papua,New,Guinea,Paraguay,Peru,Philippines,Poland,Portugal,Qatar,Republic,Romania,Russian,Rwanda,Samoa,San,Marino,Sao,Tome,Saudi,Arabia,Senegal,Serbia,Seychelles,Sierra,Leone,Singapore,Slovakia,Slovenia,Solomon,Islands,Somalia,South,Africa,Spain,Sri,Lanka,St.,Kitts,&,Nevis,St.,Lucia,St.,Vincent,&,Sudan,Suriname,Swaziland,Sweden,Switzerland,Syria,Tajikistan,Tanzania,Thailand,the,Grenadines,Togo,Tonga,Trinidad,&,Tobago,Tunisia,Turkey,Turkmenistan,Tuvalu,Uganda,Ukraine,United,Arab,United,Kingdom,United,States,Uruguay,Uzbekistan,Vanuatu,Vatican,City,Venezuela,Vietnam,Yemen,Zambia,Zimbabwe";
			else if($type=="state")
				$listStr="Uttar Pradesh,Maharashtra,Bihar,West,Bengal,Andhra Pradesh,Madhya Pradesh,Tamil,Nadu,Rajasthan,Karnataka,Gujarat,Odisha,Kerala,Jharkhand,Assam,Punjab,Chhattisgarh,Haryana,Jammu and Kashmir,Uttarakhand,Himachal Pradesh,Tripura,Meghalaya,Manipur,Nagaland,Goa,Arunachal Pradesh,Mizoram,Sikkim";
			else if($type=="district")
				$listStr="Kozhikode,Kasaragod,Idukki,Ernakulam,Cannanore,Mallapuram,Palghat,Pathanamthitta,Quilon,Trichur,Wayanad,Trivandrum,Kottayam,Alapuzzha";
			return explode(",",$listStr);
		}
		catch(Exception $e){
			throw new Exception("errrrrr..".$e->getMessage());
		}
	}
	function showMessage($MESSAGEID)
	{
		if(isset($_SESSION[$MESSAGEID]))
		{
			$style="color:#16A5E7;";
			if($_SESSION[$MESSAGEID]!=null){
				$mesg=$_SESSION[$MESSAGEID];
				$_SESSION[$MESSAGEID]=null;
				if(strpos($mesg,"||") !== false){
					$newmesg=explode("||",$mesg);
					if($newmesg[0]=="ERROR")
						$style="color:#FF1233;";
					$mesg=$newmesg[1];
				}
				return "<div class='top_message' style='".$style."'>".$mesg."</div>";
				
			}
			unset($_SESSION[$MESSAGEID]);
		}
		return "";
	}
	function getAge($dttm,$ageonly=true)
	{    
		if(trim($dttm)==""||trim($dttm)=="0000-00-00 00:00:00"){
			return "";
		}
		$start_time = date("Y-m-d",strtotime($dttm));
		$end_time= date("Y-m-d");
		$seconds = strtotime($end_time) - strtotime($start_time);
		if($seconds>0){
			$days    = floor($seconds / 86400);
			$yr="";
			$mn="";
			if($days > 0) {
				$yr=floor($days/365);   
				$rem=($days % 365);
				if($rem > 0)
					$mn=floor($rem/30); 
			}
			if($ageonly)
				$retValue=$yr; 
			else
				$retValue=$yr." Years ".$mn. " Months"; 
			return $retValue; 
		} 
		return "0 Years";
	}
	function getDaysDifferecnce($dttm)
	{    
		if(trim($dttm)==""||trim($dttm)=="0000-00-00 00:00:00"){
			return "";
		}
		$start_time = date("Y-m-d",strtotime($dttm));
		$end_time= date("Y-m-d");
		$seconds = strtotime($end_time) - strtotime($start_time);
		if($seconds>0){
			$days    = floor($seconds / 86400);
			return $days; 
		} 
		else if($seconds<0){
			$days    = floor(($seconds*-1) / 86400);
			return $days; 
		} 	
		return "0";
	}
	function makeDirectory($target_path){
		$folders=explode("/",$target_path);
		$path="";
		for($i=0;$i<sizeof($folders);$i++){
			if(trim($folders[$i])!=""){
				if($path!="")
					$path.="/";
				$path.=$folders[$i];
				if (!file_exists($path)) {
					mkdir($path, 0777);
				}
			}
		}
	}
	function getMonthText($month){
		$month=intval($month);
		$monthArray=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
		if(array_key_exists($month,$monthArray))
			return $monthArray[$month];
		return "";
	}
	function getVideoNameFromYouTubeURL($url)
	{
		$videoarray=explode("v=",$url);
		if(sizeof($videoarray)>1)
		{
			$videoarray2=explode("&",$videoarray[1]);
			if(sizeof($videoarray2)>0)
				return $videoarray2[0];
		}
		else
		{
			$videoarray=explode("v/",$url);
			if(sizeof($videoarray)>1)
			{
				$videoarray2=explode("&",$videoarray[1]);
				if(sizeof($videoarray2)>0)
					return $videoarray2[0];
			}
		}
		return "";
	}

	function getFileType($fileType){
		$array=array(
		"text/plain"=>"Text File",
		"application/pdf"=>"PDF File",
		"application/vnd.openxmlformats-officedocument.wordprocessingml.document"=>"Document File",
		"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"=>"Excel File",
		"image/pjpeg"=>"Image File(Jpeg)",
		"image/jpeg"=>"Image File(Jpeg)",
		"image/gif"=>"Image File(Gif)",
		"image/x-png"=>"Image File(Png)",
		"image/png"=>"Image File(Png)",
		"application/pdf"=>"PDF File",
		"application/doc"=>"Document File",
		"application/docx"=>"Document File"
		);
	
		if (array_key_exists($fileType,$array)){
			return $array[$fileType];
		}
		return $fileType;
	}
	function makeAddress($addressArray){
		$address="";
		foreach ($addressArray as $value) {
			if(trim($value) != ""){
				if($address!="")
					$address.=", ";
				$address.=trim($value);
			}
		}
		return $address;
	}
	function convert_number_to_words($no) {
		$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
		if($no == 0)
			return ' ';
		else {
			$novalue='';
			$highno=$no;
			$remainno=0;
			$value=100;
			$value1=1000;       
			while($no>=100)    {
				if(($value <= $no) &&($no  < $value1))    {
					$novalue=$words["$value"];
					$highno = (int)($no/$value);
					$remainno = $no % $value;
					break;
				}
				$value= $value1;
				$value1 = $value * 100;
			}       
			if(array_key_exists("$highno",$words))
			  return $words["$highno"]." ".$novalue." ".convert_number_to_words($remainno);
			else {
			 $unit=$highno%10;
			 $ten =(int)($highno/10)*10;            
			 return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".convert_number_to_words($remainno);
		   }
		}
	}
?>