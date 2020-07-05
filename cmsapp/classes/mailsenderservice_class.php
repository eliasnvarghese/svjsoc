<?php
/****************************************
 * @Project     : St Stephen Church
 * @Version     :  1.0.0
 * @Author by	:  Antony Joseph
 * @Created Date : 14/11/2018
 * @modified by	: 
 * @modified date: 
 ****************************************/ 
 ?>
<?php
/*
* MailSenderService
*
*/
class MailSenderService
{
	private $log;
	public function __construct()
	{
		$this->log=new Logging();
	}

	private function getBaseLink()
	{
		if($_SERVER["HTTP_HOST"]=="127.0.0.1" || $_SERVER["HTTP_HOST"]=="localhost")
			$baseLink="http://localhost/ststephenchurch";
		else
			$baseLink="http://ststephenssanjose.org/";
		return $baseLink;
	}
	
	public function sendNewsLetterMail($emaiId)
	{
		$baseLink=$this->getBaseLink();
		$unsubscribe=$baseLink."/contact.php";		
		
		//$this->log->debugLog("Email.............".$emaiId);
		$subject = "News Letter from St. Stephen's Jacobite Syriac Orthodox Church, Sanjose, California";

		include("mails/templates/newslettermail.php");
		return $this->sendMail($emaiId,$subject,$message,"News Letter");	
	}		
	
	public function sendReceiptMail($uId,$rectId,$emaiId,$Name)
	{
		$baseLink=$this->getBaseLink();
		$unsubscribe=$baseLink."/contact.php";		
		
		//$this->log->debugLog("Email.............".$emaiId);
		$subject = "Receipt from St. Stephen's Jacobite Syriac Orthodox Church, Sanjose, California";
		//$message = file_get_contents("receipt_pdf.php?uid=".$uId."&rectid=".$rectId);
		//include("receipt_pdf.php?uid=".$uId."&rectid=".$rectId);
		//$message = eval(file_get_contents("receipt_pdf.php?uid=".$uId."&rectid=".$rectId));
		$_GET['uid']=$uId;
		$_GET['rectid']=$rectId;
		ob_start();

		include("receiptmail_pdf.php");

		$message = ob_get_contents();
		 $attach_pdf_multipart = chunk_split( base64_encode( $message ) );
		//echo $message;
		//exit();
		$msg='';
		 $msg .= "Content-Type: application/octet-stream; name=\"attachment.pdf\"\r\n";
        $msg .= "Content-Transfer-Encoding: base64\r\n";
        $msg .= "Content-Disposition: attachment\r\n";
        $msg .= $attach_pdf_multipart . "\r\n";

        $msg .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
        $msg .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $msg .= "<p>This is text message from shohag</p>\r\n\r\n";  
		return $this->sendMailWithMultiPart($emaiId,$subject,$msg,"Receipt");	
	}	
	
	private function sendMailWithMultiPart($toaddress,$subject,$message,$activity="")
	{
		$mailsent=false;
		
$headers = "From: St Stephens San Jose CA <info@ststephenssanjose.org>" . PHP_EOL;
$headers .= "Reply-To: info@ststephenssanjose.org" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
//$headers .= "Content-type: text/html; charset=iso-8859-1" . PHP_EOL;
//$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
 $random_hash = md5(date('r', time())); 
       
        //add boundary string and mime type specification 
        $headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"". PHP_EOL;       

		/* $headers = '' .
			'From: StStephens<mail@ststephenssanjose.org>' . "\r\n" .
				'Reply-To: noreply@ststephenssanjose.org' . "\r\n" .
				'Content-type: text/html; charset=iso-8859-1' . "\r\n"; */
		try{
			if($_SERVER["HTTP_HOST"]=="127.0.0.1" || $_SERVER["HTTP_HOST"]=="localhost")
				$this->writeMail($toaddress,$subject,$message,$activity);
			else{
				if(mail($toaddress, $subject, $message, $headers))
					$mailsent=true;
				//$this->log->debugLog("Email send success".$emaiId);
			}
		}
		catch(Exception $e)	{
			//$this->log->userLog("Exception while sending mail to User.".$toaddress);
		}
		return $mailsent;
	}	
	private function sendMail($toaddress,$subject,$message,$activity="")
	{
		$mailsent=false;
		
$headers = "From: St Stephens San Jose CA <info@ststephenssanjose.org>" . PHP_EOL;
$headers .= "Reply-To: info@ststephenssanjose.org" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-type: text/html; charset=iso-8859-1" . PHP_EOL;
//$headers .= "Content-Transfer-Encoding: quoted-printable" . PHP_EOL;
		/* $headers = '' .
			'From: StStephens<mail@ststephenssanjose.org>' . "\r\n" .
				'Reply-To: noreply@ststephenssanjose.org' . "\r\n" .
				'Content-type: text/html; charset=iso-8859-1' . "\r\n"; */
		try{
			if($_SERVER["HTTP_HOST"]=="127.0.0.1" || $_SERVER["HTTP_HOST"]=="localhost")
				$this->writeMail($toaddress,$subject,$message,$activity);
			else{
				if(mail($toaddress, $subject, $message, $headers))
					$mailsent=true;
				//$this->log->debugLog("Email send success".$emaiId);
			}
		}
		catch(Exception $e)	{
			//$this->log->userLog("Exception while sending mail to User.".$toaddress);
		}
		return $mailsent;
	}

	private function writeMail($to,$subject,$message,$source)
	{
		$this->log->debugLog("\\\\\\\\\\\\\\\\\\\write mail to User.".$to.$subject.$message);
		$mailfile="../mails/mailfiles/".$to."_mail_".$source.".html";
		$fp = fopen($mailfile, 'w') or exit("Can't open $mailfile!");
		fwrite($fp,"\r\nMail To : ".$to);
		fwrite($fp,"\r\nMail Subject : ".$subject);
		fwrite($fp,"\r\nMail Message : ".$message);
		fwrite($fp,"End of Mail ******************************\n");
	}
}
?>
