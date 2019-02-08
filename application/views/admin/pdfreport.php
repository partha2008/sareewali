<?php
	tcpdf();

	// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {
		//Page header
		public function Header() {
			// Logo
			$image_file = K_PATH_IMAGES.'../../../uploads/logo/logo.png';
			$this->Image($image_file, 10, 5, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

			// Set font
			$this->SetFont('helvetica', '', 12);

			$this->writeHTMLCell(80, '', $this->getX()+20, $this->getY(), $this->address, 0, 0, 0, true, 'R', true);

			$this->setCellPadding(1);
			$this->SetFont('helvetica', '', 11);

			$invoice = "Invoice No. - SW10972\nInvoice Date - 12-02-2019\nGST - ".$this->gst_no;

			$this->writeHTMLCell(50, '', $this->getX()+10, $this->getY(), $invoice, 1, 0, 0, true, 'J', true);
		}

		// Page footer
		public function Footer() {
			// Position at 15 mm from bottom
			$this->SetY(-15);
			// Set font
			$this->SetFont('helvetica', 'I', 8);
			// Page number
			$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
	}

	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	$pdf->address = $admin_profile->address;
	$pdf->gst_no = $general_settings->gst_no;

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 003');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set font
	$pdf->SetFont('times', 'BI', 12);

	// add a page
	$pdf->AddPage();

	// set some text to print
	$txt = "<<<EOD
	TCPDF Example 003

	Custom page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods.
	EOD";

	// print a block of text using Write()
	$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

	// ---------------------------------------------------------

	//Close and output PDF document
	$pdf->Output('example_003.pdf', 'I');
?>