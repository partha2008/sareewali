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

			$invoice = "Invoice No. - ".$this->invoice_name."\nInvoice Date - ".date("d-m-Y", $this->invoice_date)."\nGST - ".$this->gst_no;

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
	$pdf->invoice_name = $invoice_name;
	$pdf->invoice_date = $invoice_date;

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

	$state = $this->defaultdata->grabStateData(array("state_id" => $order_data->state_id));
	$country = $this->defaultdata->grabStateData(array("country_id" => $order_data->country_id));

	if($order_data->address2){
		$delivery_to = "DELIVERY TO:<br><br>Mr./Mrs. ".$order_data->first_name." ".$order_data->last_name."<br><br>".$order_data->address1."<br>".$order_data->address2."<br>".$order_data->city.", ".$state[0]->name.", ".$country[0]->name."<br>Pin: ".$order_data->post_code."<br>Contact: ".$order_data->phone;
	}else{
		$delivery_to = "DELIVERY TO:<br><br>Mr./Mrs. ".$order_data->first_name." ".$order_data->last_name."<br><br>".$order_data->address1."<br>".$order_data->city.", ".$state[0]->name.", ".$country[0]->name."<br>Pin: ".$order_data->post_code."<br>Contact: ".$order_data->phone;
	}

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

	$pdf->write1DBarcode($order_data->orderid, 'C39', $pdf->getX()+20, '', '', 18, 0.4, $style, 'N');

	$pdf->Ln(70);

	$pdf->SetFont('helvetica', '', 11);

	$cart_data_html = '<table cellspacing="0" cellpadding="1" border="1">';
	$cart_data_html .= '<thead>';
	$cart_data_html .= '<tr><th align="center">Sl. No.</th><th align="center">Name</th><th align="center">Price</th><th align="center">Quantity</th><th align="center">Amount</th></tr>';
	$cart_data_html .= '</thead>';
	$cart_data_html .= '<tbody>';

	if(!empty($order_details_data)){
		foreach ($order_details_data as $key => $value) {
			if((int)$value->prd_discounted_price > 0){
              	$price = $value->prd_discounted_price;              	
            }else{
              	$price = $value->prd_price;
            }
            $total_price = $price*$value->prd_count;

			$cart_data_html .= '<tr><td align="center">'.($key+1).'</td><td align="center">'.$value->prd_name.'</td><td align="center">Rs. '.number_format($price, 2).'</td><td align="center">'.$value->prd_count.'</td><td align="center">Rs. '.number_format($total_price, 2).'</td></tr>';
		}
	}	
	$cart_data_html .= '</tbody>';
	$cart_data_html .= '</table>';

	$pdf->writeHTML($cart_data_html, true, false, false, false, 'C');

	$pdf->SetFont('helvetica', 'B', 12);

	$cart_data_html = '<table cellspacing="0" cellpadding="1" border="0">';
	$cart_data_html .= '<tbody>';
	$cart_data_html .= '<tr><td colspan="3">&nbsp;</td><td align="center">Sub Total</td><td align="center">Rs. '.$order_data->sub_total.'</td></tr>';	
	$cart_data_html .= '<tr><td colspan="3">&nbsp;</td><td align="center">Discount</td><td align="center">Rs. '.$order_data->discount.'</td></tr>';
	$cart_data_html .= '<tr><td colspan="3">&nbsp;</td><td align="center">Grand Total</td><td align="center">Rs. '.$order_data->grand_total.'</td></tr>';
	$cart_data_html .= '</tbody>';
	$cart_data_html .= '</table>';

	$pdf->writeHTML($cart_data_html, true, false, false, false, 'C');

	//Close and output PDF document
	$pdf->Output($_SERVER['DOCUMENT_ROOT'].UPLOAD_RELATIVE_INVOICE_PATH.$invoice_name, 'F');
?>