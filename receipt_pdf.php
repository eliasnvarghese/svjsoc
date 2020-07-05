<?php ob_start(); ?>
<?php session_start() ?>
<?php 
include("includes/usercredentials.php");
$regUserService=new RegUserService();
$userAccountObj=$regUserService->getUserAccountByUId($uId) ;

require('cmsapp/fpdf/fpdf.php');


class PDF extends FPDF {

	public function Header() {
		$logoPhoto="images/logo/logo.png";
		//$this->Cell(1.1, .5, $logoPhoto,'','', "C");
		$this->Image($logoPhoto,1.0 ,0.9, 1.4, 0.5, "png", "#");
		$this->SetY($this->getY()+0.16);
		$this->SetFont('Times','',10);
		$this->SetX(1);$this->Cell(6, .25,"",'','', "R");
		$this->SetFont('Times','',12);
		$this->SetY(.3);
		$this->Cell(6, 1.25, "St. Stephen's Syriac Orthodox Congregation",'','', "C");
		$this->SetY($this->getY()+0.2);
		
		$this->SetFont('Times','',8);    
		$this->Cell(6, 1.2, "",'','', "C");$this->SetY($this->getY()+0.16);
		$this->Cell(6, 1.2, "San Jose, California", '','', "C");$this->SetY($this->getY()+0.16);
		$this->Cell(6, 1.2, "Phone : (1-954-907-7154 1-408-475-2149)    Email: info@svsoc.org", '','', "C");
		$this->SetY($this->getY()+0.2);
		$this->SetFont('Times','BU',12); 
		$this->Cell(6, 1.7, "CASH RECEIPT", '','', "C");$this->SetY($this->getY()+0.16);
		//reset Y
		$this->SetY($this->getY()+1.10);
	}
		
	function printBox($x,$y,$w,$h){
		$this->Line($x,$y,$x+$w,$y);
		$this->Line($x+$w,$y,$x+$w,$y+$h);
		$this->Line($x+$w,$y+$h,$x,$y+$h);
		$this->Line($x,$y+$h,$x,$y);
	}
}

$rectId=(isset($_REQUEST['rectid']))? $_REQUEST['rectid'] : "";

$regUserService=new RegUserService();
$userAccountObj=$regUserService->getUserAccountByUId($uId) ;
	
$custName=$userAccountObj->getName();		
$custAddress=$userAccountObj->getFullAddress();
$custCity=$userAccountObj->getCity();
$custState=$userAccountObj->getState();
$custZip=$userAccountObj->getZipCode();

$paymentServiceObj = new PaymentService();	
$cashRectObj=$paymentServiceObj->getReceipt($uId,$rectId);
if($cashRectObj!=null){
	//$pdf=new PDF("P","in","Letter"); 
	$pdf = new PDF('P','in',array(8.0,8));	
	$pdf->SetLeftMargin(1);
	//$pdf->SetTopMargin(1);
	$pdf->AddPage();
/* row1 */
	$pdf->SetFont('Times','B',8);
	//$pdf->SetFillColor(223,223, 223);
	$pdf->Cell(4.0,0.2, "Member:",'LT','', "L");
	$pdf->SetX(3.5);$pdf->Cell(3.5,0.2,"Information",'LTR','', "L");
	$pdf->SetY($pdf->getY()+0.2);
/* row1.1 */
	$pdf->SetFont('Times','',8);  
	$pdf->Cell(4.0,0.3,"$custName " ,'LT','', "L");
	$pdf->SetX(3.5);$pdf->Cell(1.5,0.3,"Receipt Number  ",'LT','', "L");
	$pdf->SetFont('Times','B',8);
	$pdf->SetX(5.0);$pdf->Cell(2,0.3,$rectId,'LTR','', "L");
	$pdf->SetY($pdf->getY()+0.3);
/* row1.2 */
	$pdf->SetFont('Times','',8); 
	$pdf->Cell(4.0,0.3, "$custAddress",'L','', "L");
	$pdf->SetX(3.5);$pdf->Cell(1.5,0.3,"Receipt Date : ",'LT','', "L");
	$pdf->SetFont('Times','B',8);
	$pdf->SetX(5.0);$pdf->Cell(2,0.3,dateDisplayFormat($cashRectObj->getRectdate(),"m-d-Y"),'LTR','', "L");
	$pdf->SetY($pdf->getY()+0.3);
/* row2 */
	$pdf->SetFont('Times','',8); 
	$pdf->Cell(4.0,0.3, "$custCity $custState $custZip",'L','', "L");
	$pdf->SetX(3.5);$pdf->Cell(1.5,0.3,"Member Id",'LT','', "L");
	$pdf->SetX(5.0);$pdf->Cell(2,0.3,"$uId",'LRT','', "L");
	$pdf->SetY($pdf->getY()+0.3);
							
	/* row3 */
	$pdf->SetFont('Times','B',8);
	$pdf->Cell(5.0,0.2, "Particulars",'LTRB','', "C");
	$pdf->SetX(6.0);$pdf->Cell(1.0,0.2, "Amount",'TRB','', "L");
	$pdf->SetY($pdf->getY()+0.2);
	
/* row4 */
	$pdf->SetFont('Times','',8);
	$pdf->Cell(5.0,0.2, $cashRectObj->getCategory(),'LR','', "L");
	$pdf->SetX(6.0);$pdf->Cell(1.0,0.2, "",'R','', "R");
	$pdf->SetY($pdf->getY()+0.15);
	
	/* row5 */
	$pdf->SetFont('Times','',8);
	$pdf->Cell(5.0,0.2, $cashRectObj->getRectdetls(),'LR','', "L");
	$pdf->SetX(6.0);$pdf->Cell(1.0,0.2, "$".number_format($cashRectObj->getRectamount()),'R','', "R");
	$pdf->SetY($pdf->getY()+0.15);

	$pdf->SetFont('Times','B',8);
	$pdf->Cell(5.0,0.2, "",'BLR','', "L");
	$pdf->SetX(6.0);$pdf->Cell(1,0.2, "",'BR','', "L");
	
	$totalAmount=$cashRectObj->getRectamount();
							
	$pdf->SetY($pdf->getY()+0.2);
	$pdf->Cell(4.5,0.3, "",'L','', "L");
	$pdf->SetFont('Times','',8);
	$pdf->SetX(5.5);$pdf->Cell(0.5,0.4, "Total ",'TR','', "L");
	$pdf->SetX(6.0);$pdf->Cell(1,0.4, "$".number_format($totalAmount),'TR','', "R");
	$pdf->SetY($pdf->getY()+0.2);
	
	$pdf->SetFont('Times','',8);
	MakeRow($pdf,'6.0','0.2','0.2',"","LR",'L');
	MakeRow($pdf,'6.0','0.2','0.2',"Amount (In Words) : Dollar ".convert_number_to_words($totalAmount),"TLR",'L');
	$pdf->SetFont('Times','B',8);
	MakeRow($pdf,'6.0','0.2','0.2',"For St. Stephen's Syriac Orthodox Congregation","TLR",'R');
	MakeRow($pdf,'6.0','0.2','0.2',"","LR",'R');
	MakeRow($pdf,'6.0','0.2','0.2',"Authorised Signatory","LRB",'R');

	//$pdf->Write(0.1,"\n");  

	$pdf->Write(0.1,"\n");  
	$pdf->Output("cashrect_#".$rectId.".pdf","D");
	//$pdf->Output();
	
}
else{
	header("Location:dashboarddfsadf.php");
}
	
function MakeRow($pdf,$w,$h,$y,$text,$border,$align){
	$pdf->Cell($w,$y,$text,$border,'', $align);
	$pdf->SetY($pdf->getY()+$y);
}
?>
