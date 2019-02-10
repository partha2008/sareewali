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

			$this->Line(10, $this->y+20, $this->w - 10, $this->y+20);
		}

		// Page footer
		public function Footer() {
			$this->Line(10, $this->y-5, $this->w - 10, $this->y-5);
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

	$delivery_to = "DELIVERY TO:<br><br>Mr. Partha Chowdhury";

	$pdf->writeHTMLCell(80, '', $pdf->getX(), $pdf->getY()+10, $delivery_to, 0, 0, 0, true, 'J', true);

	$style = array(
		'position' => '',
		'align' => 'C',
		'stretch' => false,
		'fitwidth' => true,
		'cellfitalign' => '',
		'border' => true,
		'hpadding' => 'auto',
		'vpadding' => 'auto',
		'fgcolor' => array(0,0,0),
		'bgcolor' => false, //array(255,255,255),
		'text' => true,
		'font' => 'helvetica',
		'fontsize' => 8,
		'stretchtext' => 4
	);

	$pdf->write1DBarcode('CODE 39', 'C39', $pdf->getX()+20, '', '', 18, 0.4, $style, 'N');

	$pdf->Ln(10);

	$pdf->SetFont('helvetica', 'B', 10);

	$cart_data_html = '<table cellspacing="0" cellpadding="1" border="1">';
	$cart_data_html .= '<thead>';
	$cart_data_html .= '<tr><th align="center">Sl. No.</th><th align="center">Name</th><th align="center">Price</th><th align="center">Quantity</th><th align="center">Amount</th></tr>';
	$cart_data_html .= '</thead>';
	$cart_data_html .= '<tbody>';

	if(!empty($order_details_data)){
		$sub_total = 0;
		foreach ($order_details_data as $key => $value) {
			if((int)$value->prd_discounted_price > 0){
              	$price = $value->prd_discounted_price;
              	$total_price = $value->prd_discounted_price*$value->prd_count;
            }else{
              	$price = $value->prd_price;
              	$total_price = $value->prd_price*$value->prd_count;
            }
            $sub_total = $sub_total+$total_price;

			$cart_data_html .= '<tr><td align="center">'.($key+1).'</td><td align="center">'.$value->prd_name.'</td><td align="center">'.$price.'</td><td align="center">'.$value->prd_count.'</td><td align="center">'.$total_price.'</td></tr>';
		}

		$cart_data_html .= '<tr><td colspan="5">&nbsp;</td></tr>';

		$cart_data_html .= '<tr><td colspan="3">&nbsp;</td><td align="center">Sub Total</td><td align="center">'.$sub_total.'</td></tr>';	
		$cart_data_html .= '<tr><td colspan="3">&nbsp;</td><td align="center">Discount</td><td align="center">'.$sub_total.'</td></tr>';
		$cart_data_html .= '<tr><td colspan="3">&nbsp;</td><td align="center">Grand Total</td><td align="center">'.$sub_total.'</td></tr>';		
	}	

	$cart_data_html .= '</tbody>';
	$cart_data_html .= '</table>';

	$pdf->writeHTML($cart_data_html, true, false, false, false, 'C');

	//Close and output PDF document
	$pdf->Output('example_003.pdf', 'I');
?>