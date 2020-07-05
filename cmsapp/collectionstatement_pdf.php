<?php 
ob_start();
session_start(); 
$sessionid=session_id();
if(!isset($_SESSION['StStephenChurch_AdminUserData'])){
	header("Location:login.php");
	exit();
}
function __autoload($className){
	$className=strtolower($className);
	require_once "./classes/{$className}_class.php";
}
require_once("includes/utility.php"); 
$log=new Logging();

require('fpdf/fpdf.php');


class PDF extends FPDF {
	private $colPosArray=array();
	private $colWidthArray=array();
	private $colNameArray=array(); 
	public $fromDate;
	public $toDate;
	public $headerStarted=0;
		

	
	function Header() {
		$this->colPosArray[0]=0.5;	$this->colWidthArray[0]=0.5;	$this->colNameArray[0]="Rect No";
		$this->colPosArray[1]=1.0; 	$this->colWidthArray[1]=0.6;	$this->colNameArray[1]="Rect Date";
		$this->colPosArray[2]=1.6;	$this->colWidthArray[2]=0.5;	$this->colNameArray[2]="Reg No";
		$this->colPosArray[3]=2.1;	$this->colWidthArray[3]=1.5;	$this->colNameArray[3]="Name";
		$this->colPosArray[4]=3.6;	$this->colWidthArray[4]=1.5;	$this->colNameArray[4]="Category";
		$this->colPosArray[5]=5.1;	$this->colWidthArray[5]=2.7;	$this->colNameArray[5]="Narration";
		$this->colPosArray[6]=7.8;	$this->colWidthArray[6]=0.4;	$this->colNameArray[6]="Rect.Amount";
		
		//$this->Cell(1.1, .5, $logoPhoto,'','', "C");
		//$this->Image($logoPhoto,1.1 ,0.5, 1.5, 0.5, "png", "#");
		$this->SetY($this->getY()+0.16);
		
		$this->SetFont('Times','',12);
		$this->SetY(.3);
		$this->Cell(0, .25, "St. Stephen's Syriac Orthodox Congregation",'','', "C");
		$this->SetY($this->getY()+0.2);
		
		$this->SetFont('Times','',8);    
		$this->Cell(0, .2, "",'','', "C");$this->SetY($this->getY()+0.16);
		$this->Cell(0, .2, "San Jose, California", '','', "C");$this->SetY($this->getY()+0.16);
		$this->Cell(0, .2, "Phone : (1-954-907-7154 1-408-475-2149)    Email: info@svsoc.org", '','', "C");
		$this->SetY($this->getY()+0.2);
		//$this->printTableHeader();
		$this->headerStarted=1;
	
		$this->SetFont('Times','',12); 
		//$this->SetFillColor(245,245, 245);
		$this->SetFont('Times','B',12);
		//Cell(float w[,float h[,string txt[,mixed border[,
		//int ln[,string align[,boolean fill[,mixed link]]]]]]])
		$this->Cell(0, .25, "Income Statement for the period From ".$this->fromDate." to ".$this->toDate,0, 2, "C");
		$this->SetFont('Times','B',8);
		$this->setY($this->getY()+0.1);
		$this->SetX($this->colPosArray[0]);$this->Cell($this->colWidthArray[0],0.2, $this->colNameArray[0],'TB','', "L");
		$this->SetX($this->colPosArray[1]);$this->Cell($this->colWidthArray[1],0.2, $this->colNameArray[1],'TB','', "L");
		$this->SetX($this->colPosArray[2]);$this->Cell($this->colWidthArray[2],0.2, $this->colNameArray[2],'TB','', "L");
		$this->SetX($this->colPosArray[3]);$this->Cell($this->colWidthArray[3],0.2, $this->colNameArray[3],'TB','', "L");
		$this->SetX($this->colPosArray[4]);$this->Cell($this->colWidthArray[4],0.2, $this->colNameArray[4],'TB','', "L");
		$this->SetX($this->colPosArray[5]);$this->Cell($this->colWidthArray[5],0.2, $this->colNameArray[5],'TB','', "L");
		$this->SetX($this->colPosArray[6]);$this->Cell($this->colWidthArray[6],0.2, $this->colNameArray[6],'TB','', "R");
		$this->setY($this->getY()+0.2); 		
		if( $this->PageNo()>1)
			$this->setY($this->getY()+0.1); 		
	}
	public function getColPosArray(){
		return $this->colPosArray;
	}	
	public function getColWidthArray(){
		return $this->colWidthArray;
	}	

}
$searchString=(isset($_REQUEST['searchString']))? $_REQUEST['searchString']:"";
$fromDate=(isset($_REQUEST['fromDate']))? convertFromUserDateToYmd($_REQUEST['fromDate']) : "";
$toDate=(isset($_REQUEST['toDate']))? convertFromUserDateToYmd($_REQUEST['toDate']) : "";

$pdf=new PDF("P","in","Letter"); 
$pdf->SetLeftMargin(.5);

$pdf->fromDate=dateDisplayFormat($fromDate,"m-d-Y");
$pdf->toDate=dateDisplayFormat($toDate,"m-d-Y");
 
$pdf->AddPage();
$pdf->SetFont('Times','',9);                 
$searchString="";
$tot_rectAmount=0;
$colPosArray=$pdf->getColPosArray();  
$colWidthArray=$pdf->getColWidthArray(); 

$paymentServiceObj = new PaymentService();													
$sumAmount=$paymentServiceObj->getReceiptListForPeriod("SUMRECT",$fromDate,$toDate);
if($sumAmount>0){
	$results=$paymentServiceObj->getReceiptListForPeriod("DATALIST",$fromDate,$toDate,0,999999999999);
	while($row=mysqli_fetch_array($results)){
		$tot_rectAmount=$tot_rectAmount+$row["rectamount"];
		$narr_arr=array();
		$narration=$row["rectdetls"];
		while(strlen($narration)>0){
			if(strlen($narration)>=50)
			{
				$narr_arr[]=substr($narration,0,50);
				$narration=substr($narration,50,strlen($narration));
			}
			else
			{
				$narr_arr[]=$narration;
				$narration="";
			}	
		}
		if(sizeof($narr_arr)<=0)
			$narr_arr[]="";												
		$pdf->setY($pdf->getY()+0.1); 
		$pdf->SetFont('Times','',8);		
		$pdf->SetX($colPosArray[0]);$pdf->Cell($colWidthArray[0],0.2, $row["rectno"],'','', "L");
		$pdf->SetFont('Times','',8);		
	 	$pdf->SetX($colPosArray[1]);$pdf->Cell($colWidthArray[1],0.2,  dateDisplayFormat($row["rectdate"],"m-d-Y"),'','', "L");
		$pdf->SetFont('Times','',8);		                       
		$pdf->SetX($colPosArray[2]);$pdf->Cell($colWidthArray[2],0.2, $row["uid"],'','', "L");
		$pdf->SetFont('Times','',8);                               
		$pdf->SetX($colPosArray[3]);$pdf->Cell($colWidthArray[4],0.2, ucwords(strtolower(trim($row["name"]))),'','', "L");
		$pdf->SetFont('Times','',8);                               
		$pdf->SetX($colPosArray[4]);$pdf->Cell($colWidthArray[4],0.2, ucwords(strtolower(trim($row["category"]))),'','', "L");
		$pdf->SetFont('Times','',8);                               
		$pdf->SetX($colPosArray[5]);$pdf->Cell($colWidthArray[5],0.2, $narr_arr[0],'','', "L");
		$pdf->SetFont('Times','',9);                               
		$pdf->SetX($colPosArray[6]);$pdf->Cell($colWidthArray[6],0.2,  moneyDisplayFormat($row["rectamount"],"0.00"),'','', "R"); 
		for($i=1;$i<sizeof($narr_arr);$i++){
			$pdf->setY($pdf->getY()+0.15); 
			$pdf->SetFont('Times','',8);                               
			$pdf->SetX($colPosArray[5]);$pdf->Cell($colWidthArray[5],0.2, $narr_arr[$i],'','', "L");
		}
		$pdf->SetY($pdf->getY()+0.1);
		$pdf->Write(0.1,"\n"); 
	} 
}
$pdf->SetX($colPosArray[0]);$pdf->Cell($colWidthArray[0],0.4, "Total",'TB','', "L");	
$pdf->SetX($colPosArray[1]);$pdf->Cell($colWidthArray[1],0.4, "",'TB','', "L");
$pdf->SetX($colPosArray[2]);$pdf->Cell($colWidthArray[2],0.4, "",'TB','', "C");
$pdf->SetX($colPosArray[3]);$pdf->Cell($colWidthArray[3],0.4, "",'TB','', "C");
$pdf->SetX($colPosArray[4]);$pdf->Cell($colWidthArray[4],0.4, "",'TB','', "C");
$pdf->SetX($colPosArray[5]);$pdf->Cell($colWidthArray[5],0.4, "",'TB','', "C");
$pdf->SetX($colPosArray[6]);$pdf->Cell($colWidthArray[6],0.4, moneyDisplayFormat($tot_rectAmount ,"0.00"),'TB','', "R");					   				   
$pdf->Write(0.1,"\n"); 
//$pdf->Output(); 
$pdf->Output("colnstatement.pdf","D");
?>								   