<?php
/****************************************
 * @Project     : MarryBayKerala
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 18/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
class Logging{

  private $fp = null;
  private $debug = false;

  public function debugLog($message){
   	if(isset($_SESSION["edp__configuration"]))
		$ini_config=$_SESSION["edp__configuration"];
	else
		$ini_config=$this->getConfiguration();

	$debug=$ini_config["debug"];
 	 	if (isset($_SESSION['StStephenChurch_AdminUserData']))
		{
			$curUser = unserialize($_SESSION['StStephenChurch_AdminUserData']);
			if($curUser!=null)
				$userId=$curUser->getUserId();
			else
				$userId="";
		}
		else
			$userId="guest";
      if (!$this->fp)
      	$this->lopen();
      $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      $time = date('Y-m-d H:i:s');
      $ip=$_SERVER['REMOTE_ADDR'];
	  if(trim($debug) == "true")
		  fwrite($this->fp, "DebugLog  | $time | $userId | $ip | $script_name | $message\n");
    }


  public function lwrite($message){
	  if($GLOBALS['DEBUG']==true)
	  {
		if (!$this->fp)
			$this->lopen();
		$script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
		$time = date('Y-m-d H:i:s');
		fwrite($this->fp, "Debug | $time ($script_name) $message\n");
	  }
  }
    public function simpleLog($message){
		if (!$this->fp)
			$this->lopen();
		fwrite($this->fp, " ".$message."\n");
  }

  public function userLog($message){
		$userId="guest";
	  try
	  {
 	  	if (isset($_SESSION['StStephenChurch_AdminUserData']))
		{
			$curUser = unserialize($_SESSION['StStephenChurch_AdminUserData']);
			if($curUser!=NULL)
				$userId=$curUser->getUserId();
		}
	  }catch (Exception $e)
	  {  
	  }

      if (!$this->fp)
      	$this->lopen();
      $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      $time = date('Y-m-d H:i:s');
      $ip=$_SERVER['REMOTE_ADDR'];
      fwrite($this->fp, "UserLog | $time | $userId | $ip | $script_name | $message\n");
    }

  public function errorLog($message){
 	 	if (isset($_SESSION['StStephenChurch_AdminUserData']))
		{
			$curUser = unserialize($_SESSION['StStephenChurch_AdminUserData']);
			$userId=$curUser->getUserId();
		}
		else
			$userId="guest";
      if (!$this->fp)
      	$this->lopen();
      $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      $time = date('Y-m-d H:i:s');
      $ip=$_SERVER['REMOTE_ADDR'];
      fwrite($this->fp, "ErrorLog | $time | $userId | $ip | $script_name | $message\n");
    }

  public function adminLog($message){
 	 	if (isset($_SESSION['edp_AdminUser']))
		{
			$curUser = $_SESSION['edp_AdminUser'];
			$adminuserid=$curUser->getAdminUserId();

		}
		else
			$adminuserid="NULL";
      if (!$this->fp) $this->lopen();
      $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      $time = date('Y-m-d H:i:s');
      $ip=$_SERVER['REMOTE_ADDR'];
      fwrite($this->fp, "AdminLog | $time | $adminuserid | $ip | $script_name | $message\n");
    }

  private function lopen(){
  	if(isset($_SESSION["edp__configuration"]))
		$ini_config=$_SESSION["edp__configuration"];
	else
		$ini_config=$this->getConfiguration();

	$logfilePath=$ini_config["logfilepath"];
	$log_file=trim($logfilePath)."/logfile_txt";

    $today = date('Y-m-d');
    $this->fp = fopen($log_file . '_' . $today, 'a') or exit("Can't open $lfile!");
  }

 	public function getConfiguration()
	  {
		$myfile = "config.ini";
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

}
?>