<?php
if(isset($_POST['submit']))
{
	$conn = mysqli_connect("localhost","root","password","chat");
	define('DOCROOT', realpath(dirname(__FILE__)) . '/');
	require(DOCROOT ."fpdf.php");
	$stm = "select * from sourcecodereq;";
	$res = mysqli_query($conn,$stm);
	
    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial", "B", 16);
	if(mysqli_num_rows($res) > 0)
	{	
		$pdf->Cell(0,10,"Download Requests Report",0,1,C);
        $pdf->SetFont("Arial", "", 12);
		$pdf->Cell(10,10,"ID: ",1,0);
		$pdf->Cell(30,10,"NAME: ",1,0);
		$pdf->Cell(50,10,"EMAIL: ",1,0);
		$pdf->Cell(35,10,"PHONE NO: ",1,0);
		$pdf->Cell(30,10,"PROFESSION: ",1,0);
		//$pdf->Cell(20,10,"REASON: ",1,0);
		$pdf->Cell(30,10,"STATUS: ",1,1);
		while($row = mysqli_fetch_assoc($res))
        {
			$pdf->Cell(10,10,$row['id'],1,0);
			$pdf->Cell(30,10,$row['name'],1,0);
			$pdf->Cell(50,10,$row['email'],1,0);
			$pdf->Cell(35,10,$row['contactNumber'],1,0);
			$pdf->Cell(30,10,$row['profession'],1,0);
			//$pdf->MultiCell(20,50,$row['reason'],1,0);
            if($row['accepted'] == 1)
            {
                $pdf->Cell(30,10,"Accepted",1,1);
            }
            else if($row['denied'] == 1)
            {
                $pdf->Cell(30,10,"Denied",1,1);
            }
            else
            {
                $pdf->Cell(30,10,"Pending",1,1);
            }
        }
	}
	else
	{
        $pdf->Cell(0,10,"No data to generate reports.",0,1,C);
	}
	ob_end_clean();
	$pdf->output();
}
?>