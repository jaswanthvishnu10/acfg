<?php


require('fpdf/fpdf.php');
require('fpdi/fpdi.php');
require_once('fpdi/fpdf_tpl.php');

// Original file with multiple pages 
$fullPathToFile = "harsha.pdf";

class PDF extends FPDI {

    var $_tplIdx;

    function Header() {

        global $fullPathToFile;

        if (is_null($this->_tplIdx)) {

            // THIS IS WHERE YOU GET THE NUMBER OF PAGES
            $this->numPages = $this->setSourceFile($fullPathToFile);
            $this->_tplIdx = $this->importPage(1);

        }
        $this->useTemplate($this->_tplIdx, 0, 0,200);

    }

    function Footer() {
	// Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

}

// initiate PDF
$pdf = new PDF();

// add a page
$pdf->AddPage();

if($pdf->numPages>1) {

    for($i=2;$i<=$pdf->numPages;$i++) {
        //$pdf->endPage();
        $pdf->_tplIdx = $pdf->importPage($i);
        $pdf->AddPage();
    }
}


// or Output the file as forced download
$pdf->Output("sampleUpdated.pdf", 'D');


?>
