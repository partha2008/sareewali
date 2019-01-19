		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Order Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        	<h4 class="panel-title">Cart Data</h4>
                        </div>
						<div class="panel-body">
							<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							  <div class="row">
								 <div class="col-sm-12">
									<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
									   <thead>
										  <tr role="row">
											 <th>&nbsp;</th>								 
											 <th>Name</th>
											 <th>Price</th>
											 <th>Discounted Price</th>
											 <th>Quantity</th>
										  </tr>
									   </thead>
									   <tbody>
									    <?php 
									    if(!empty($order_details_data)){ 
										 foreach($order_details_data AS $detail) {
											$product_image = $this->productdata->grab_product_image(array("status" => "Y", "product_id" => $detail->product_id, "is_featured" => "Y"));
										?>
										  <tr class="gradeA odd" role="row">
										  	 <td><img src="<?php echo UPLOAD_PRODUCT_PATH.$product_image[0]->name;?>"></td>
											 <td><?php echo $detail->prd_name;?></td>
											 <td><i class="fa fa-inr"></i> <?php echo $detail->prd_price;?></td>	
											 <td><i class="fa fa-inr"></i> <?php echo $detail->prd_discounted_price;?></td>	
											 <td><?php echo $detail->prd_count;?></td>
										  </tr>
										  <?php } ?>
										  <?php } ?>
										  <tr class="gradeA odd" role="row">
										  	<td colspan="4" align="right">Sub Total</td>
										  	<td><i class="fa fa-inr"></i> <?php echo $order_data->sub_total;?></td>
										  </tr>
										  <tr class="gradeA odd" role="row">
										  	<td colspan="4" align="right">Discount</td>
										  	<td><i class="fa fa-inr"></i> <?php echo $order_data->discount;?></td>
										  </tr>
										  <tr class="gradeA odd" role="row">
										  	<td colspan="4" align="right">Grand Total</td>
										  	<td><i class="fa fa-inr"></i> <?php echo $order_data->grand_total;?></td>
										  </tr>
									   </tbody>
									</table>
								 </div>
							  </div>
							</div>
							<!-- /.table-responsive -->
						</div>
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        	<h4 class="panel-title">User Data</h4>
                        </div>
						<div class="panel-body">
							<div class="dataTables_wrapper dt-bootstrap no-footer">
							  <div class="row">
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Order Id</label>
                                        <p class="form-control-static"><?php echo $order_data->orderid;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Transaction Id</label>
                                        <p class="form-control-static"><?php echo $order_data->transaction_id;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <p class="form-control-static"><?php echo $order_data->first_name.' '.$order_data->last_name;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p class="form-control-static"><?php echo $order_data->email;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <p class="form-control-static"><?php echo $order_data->phone;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Address1</label>
                                        <p class="form-control-static"><?php echo $order_data->address1;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Address2</label>
                                        <p class="form-control-static"><?php echo ($order_data->address2) ? $order_data->address2 : '-';?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>City</label>
                                        <p class="form-control-static"><?php echo $order_data->city;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Post Code</label>
                                        <p class="form-control-static"><?php echo $order_data->post_code;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <p class="form-control-static"><?php echo $this->defaultdata->grabCountryData(array("country_id" => $order_data->country_id))[0]->name;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>State</label>
                                        <p class="form-control-static"><?php echo $this->defaultdata->grabStateData(array("state_id" => $order_data->state_id))[0]->name;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Payment Type</label>
                                        <p class="form-control-static"><?php echo $order_data->payment_type;?></p>
                                    </div>
								 </div>
								 <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Order Date</label>
                                        <p class="form-control-static"><?php echo date("d-m-Y", $order_data->date_added);?></p>
                                    </div>
								 </div>
							  </div>
							</div>
							<!-- /.table-responsive -->
						</div>
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        	<h4 class="panel-title">Shipping Status</h4>
                        </div>
						<div class="panel-body">
							<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							  <div class="row">
								 <div class="col-sm-12">
								 	<form role="form" action="<?php echo base_url("admin/order/update_order");?>" method="post">
									 	<div class="form-group">
	                                        <label class="control-label">Status</label>
											<select name="order_status" class="form-control">
											<?php
												foreach ($this->config->item("order_status") as $key => $value) {
											?>
												<option value="<?php echo $key;?>" <?php if($key==$order_data->order_status){echo 'selected';}?>><?php echo $value['text'];?></option>
											<?php
												}
											?>
											</select>
	                                    </div>
	                                    <input type="hidden" name="order_id" value="<?php echo $order_data->order_id;?>">
	                                    <button type="submit" class="btn btn-primary">Save Changes</button>
	                                </form>
								 </div>
							  </div>
							</div>
						</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>

		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?>
