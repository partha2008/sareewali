    <?php  
        include '../conf/conn.php';
        require('../barcode.php');
        require('../fpdf/fpdf.php');
        
        function shorter($text, $chars_limit)
        {
            // Check if length is larger than the character limit
            if (strlen($text) > $chars_limit)
            {
                // If so, cut the string at the character limit
                $new_text = substr($text, 0, $chars_limit);
                // Trim off white space
                $new_text = trim($new_text);
                // Add at end of text ...
                return $new_text . "...";
            }
            // If not just return the text as is
            else
            {
                return $text;
            }
        }
        
        /*echo "<pre>";
        print_r($_POST);
        die();*/
        
        $order_id = $_POST['order_id'];
        $qnty_arr = $_POST['qnty'];
        $awb_no = $_POST['awb_no'];
        
        $res = mysqli_query($link, "SELECT orders.orderid, orders.sfn, orders.sln, orders.seml, orders.sadd1, orders.sadd2, orders.sadd3, orders.scit, orders.ssta, orders.scon, orders.spin, orders.sno, orders.bd_invoice, payments.mode, payments.addedon FROM orders INNER JOIN payments ON orders.pay_id=payments.id WHERE orders.id=".$order_id);
        $arr1 = mysqli_fetch_assoc($res);
        
        $shipping_price = 0;
        $filename = $arr1['bd_invoice']."_".time();
        $order_num = $arr1['orderid'];
        $logo_image = $path.'img/MyCrafts.png';
        $payment_mode = $arr1['mode'];
        $order_date = date("d-m-Y", strtotime($arr1['addedon']));
        $gst_regd_no = '19BBPPK4190Q1ZO';
        
        $cnt = 0;
        $sub_total = 0;
        
        if(!empty($qnty_arr)){
            foreach($qnty_arr as $qnty){
                if($qnty != 0){
                    $product_id_arr = explode("_", $qnty);
                    $product_qnty = $product_id_arr[0];
                    $product_id = $product_id_arr[1];
                    
                    mysqli_query($link, "INSERT INTO `invoice`(`invoice_name`,`order_id`,`product_id`,`quantity`,`awb_no`,`courier_name`,`medium`,`actual_weight`,`charged_weight`,`no_of_pkg`,`pkg_no`,`date`) VALUES ('".$filename."','" . $order_id . "', '".$product_id."', '".$product_qnty."', '".$awb_no."','".$_POST['courier_name']."','".$_POST['medium']."','".$_POST['actual_weight']."','".$_POST['charged_weight']."','".$_POST['no_of_pkg']."','".$_POST['pkg_no']."','".time()."')");
                    
                    $rs1 = mysqli_query($link, "SELECT order_summery.pri, products.nm, products.cd, products.tax_per FROM order_summery INNER JOIN products ON order_summery.pid=products.id WHERE products.id=".$product_id);
                    $arr2 = mysqli_fetch_assoc($rs1);
                    
                    $tax = ($arr2['tax_per']*$arr2['pri'])/100;
            
                    $product_data[$cnt][] = $cnt+1;
                    $product_data[$cnt][] = shorter($arr2['nm'], 25);
                    $product_data[$cnt][] = $arr2['cd'];
                    $product_data[$cnt][] = $product_qnty;
                    $product_data[$cnt][] = number_format(round($tax, 2), 2);
                    $product_data[$cnt][] = number_format(round($arr2['pri']*$product_qnty, 2), 2);
                    
                    $sub_total += round($arr2['pri']*$product_qnty, 2);
                    
                    $cnt++;
                }
            }
        }
        
        if($cnt == 0){
            die();
        }
        
        class PDF extends FPDF
        {            
            public $gst_regd_no;
            public $logo_image;
            public $awb_no;
            
            public function setData($gst_regd_no, $logo_image, $awb_no){               
                $this->gst_regd_no = $gst_regd_no;
                $this->logo_image = $logo_image;
                $this->awb_no = $awb_no;
            }            
            
            // Page header
            function Header()
            {
                $this->Rect(5, 5, 200, 288, 'D');                
                
                $this->Image($this->logo_image,80,2,40, 40);
                
                $this->Image(getBarCodeImage($this->awb_no),150,15,40,10);
                   
                $this->Ln(20);
            }

            // Page footer
            /*function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',10);
                // Page number
                $this->Cell(0,10,$this->return_addr,1,0,'C');
            }*/
        }

        $pdf = new PDF();
        
        $pdf->setData($gst_regd_no, $logo_image, $awb_no);
        
        //$pdf->AddPage('L', 'A5');
        $pdf->AddPage();
        
        $pdf->SetFont('Arial','B',9);
                
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->SetXY($x , $y);
        
        if($payment_mode == "COD"){
            $col2 = "COD AMOUNT - ".number_format(round(($sub_total+$shipping_price), 2), 2);
        }else{
            $col2 = "PREPAID AMOUNT - ".number_format(round(($sub_total+$shipping_price), 2), 2);
        }
        
        $pdf->MultiCell(75, 5, $col2, 0);
        
        // only for COD
        if(isset($collectable_amount)){
            $pdf->SetFont('Arial','B',9);
            $pdf->SetXY($x + 135, $y);        
            $pdf->MultiCell(50, 5, 'Docket No. - '.$awb_no, 0);
        }            
        $pdf->Ln(5);            
        
        $pdf->SetFont('Arial','',8);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->SetXY($x, $y);
        $cell = "Goods Code ".$_POST['medium']."\nDECL CARGO VALUE - ".number_format(round(($sub_total+$shipping_price), 2), 2)."\nACTUAL WEIGHT - ".$_POST['actual_weight']." kg\nCHARGED  WEIGHT - ".$_POST['charged_weight']." kg\nSHIPPER CODE - 43235501\nRECEIVER CODE - 99999";
        $pdf->MultiCell(75, 5, $cell, 0);
        
        $pdf->SetXY($x + 135, $y);
        
        if($payment_mode == "COD"){
            $cols = "Order No - ".$order_num."\nDate - ".$order_date."\nCOD IN FAVOUR OF MYCRAFTS";
        }else{
            $cols = "Order No - ".$order_num."\nDate - ".$order_date."\nPREPAID IN FAVOUR OF MYCRAFTS";
        }
        $pdf->MultiCell(75, 5, $cols, 0);
        
        $pdf->Ln(20);  
        
        $pdf->SetFont('Arial','B',10);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->SetXY($x, $y);
        $cell="Delivery To,";
        $pdf->MultiCell(75, 5, $cell, 0);
        
        $pdf->Ln(2);  
        
        $pdf->SetFont('Arial','B',10);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x, $y);
        $cell="Receiver Name - ".$arr1['sfn']." ".$arr1['sln'];
        $pdf->MultiCell(75, 5, $cell, 0);
        
        $pdf->Ln(2);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x, $y);
        $cell = "Address - ".$arr1['sadd1'];
        if($arr1['sadd2']){
            $cell .= " ".$arr1['sadd2'];
        }
        if($arr1['sadd3']){
            $cell .= " ".$arr1['sadd3'];
        }
        $pdf->MultiCell(200, 5, $cell, 0);
        
        $pdf->Ln(1);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x+16, $y);
        $cell="State - ".$arr1['ssta'].", City - ".$arr1['scit'].", Pin - ".$arr1['spin'];
        $pdf->MultiCell(200, 5, $cell, 0);
        
        $pdf->Ln(1);        
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x+16, $y);
        $cell="Mobile - ".$arr1['sno'].", Email - ".$arr1['seml'];
        $pdf->MultiCell(200, 5, $cell, 0);
        
        $pdf->Ln(2);
        
        $pdf->SetFont('Arial','B',8);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x, $y);
        $cell="NO OF PKGS - ".$_POST['no_of_pkg'];
        $pdf->MultiCell(75, 5, $cell, 0);
        
        $pdf->SetXY($x + 100, $y);
        
        $cols = "FROM PKG NO - ".$_POST['pkg_no'];
        $pdf->MultiCell(75, 5, $cols, 0);
        
        $pdf->Ln(5);
        
        // Add table
        $header = array('Sr. No.', 'Description', 'Product Code', 'Quantity', 'Tax', 'Total');
        
        // Colors, line width and bold font
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(224);
        $pdf->SetDrawColor(224,224,224);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','B', 8);
        
        // Header
        $w = array(15, 50, 40, 20, 25, 35);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);        
        $pdf->Ln();
        
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFont('');
        
        // Data
        foreach($product_data as $row)
        {
            foreach($row as $key => $col)
                if($key==2)
                    $pdf->Cell($w[$key],7, shorter($col, 25),1,0,'C',false);
                else
                    $pdf->Cell($w[$key],7,$col,1,0,'C',false);
            $pdf->Ln();
        }
        
        $pdf->Ln(5);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->SetFont('Arial','B',9);
        
        if($payment_mode == "COD"){
            $pdf->SetXY($x + 140, $y);
            $pdf->MultiCell(75, 5,"Collectable Amount - ".number_format(round(($sub_total+$shipping_price), 2), 2));
        }else{
            $pdf->SetXY($x + 155, $y);
            $pdf->MultiCell(75, 5,"Amount - ".number_format(round(($sub_total+$shipping_price), 2), 2));
        }
        
        $pdf->Ln(10);
        
        $pdf->SetFont('Arial','B',10);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->SetXY($x, $y);
        $cell="Shipped By (If undelivered, return to): ";
        $pdf->MultiCell(75, 5, $cell, 0);
        
        $pdf->SetFont('Arial','B',10);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        
        $pdf->SetXY($x, $y);
        $cell="MyCrafts India\nGST No. - ".$gst_regd_no."\nPlot No. DC-127, Street No.- 310, Newtown, Kolkata, West Bengal 700156\nWebsite - www.mycraftsindia.com, Email - mycraftsindia@gmail.com, Mobile - 9830065910 / 8820184008";
        $pdf->MultiCell(200, 5, $cell, 0);
        
        $pdf->Ln(10);
        
        $x = $pdf->GetX();
        $y = $pdf->GetY();        
        $pdf->SetXY($x + 55, $y);            
        $pdf->MultiCell(150, 5, $pdf->Image(getBarCodeImage($awb_no),$pdf->GetX(),$pdf->GetY()), 0);
        
        $pdf->Output('../invoice/'.$filename.'.pdf', "F");
        // Invoice Ends        
        
        echo 'success';
    ?>