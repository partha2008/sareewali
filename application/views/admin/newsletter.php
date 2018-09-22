		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Newsletters</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        
						<div class="panel-body">
							<div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							  <div class="row">
								 <div class="col-sm-6">&nbsp;</div>
								 <div class="col-sm-6">
									<form action="<?php echo base_url('admin/newsletter');?>" method="GET" role="form">
										<div id="dataTables-example_filter" class="dataTables_filter">
											<label>Search by:<input name="email" type="search" class="form-control input-sm" placeholder="Title" aria-controls="dataTables-example" id="user-search" value="<?php if(isset($search_key)){echo $search_key;}?>"></label>
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
								 </div>
							  </div>
							  <div class="row">
								 <div class="col-sm-12">
									<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
									   <thead>
										  <tr role="row">
											 <th>Email</th>							 
											 <th>Status</th>
											 <th>Actions</th>
										  </tr>
									   </thead>
									   <tbody>
									    <?php if(!empty($news)){ ?>
										<?php foreach($news AS $detail) {?>
										  <tr class="gradeA odd" role="row">
											 <td><?php echo $detail->email;?></td>	
											 <td class="center"><?php echo ($detail->status == 'Y' ? '<strong class="text-success">Active</strong>' : '<strong class="text-danger">Inactive</strong>');?></td>
											 <td class="center">
												<a href="#" class="btn btn-success" title="Send Newsletter">Send Newsletter</a>&nbsp;
												<?php
													if($detail->status == 'Y'){
												?>	
												<a href="<?php echo base_url('admin/user/newsletter_edit/'.$detail->newsletter_id.'/N');?>" class="btn btn-primary" title="Send Newsletter">Inactive</a>		
												<?php
												}else{
												?>
												<a href="<?php echo base_url('admin/user/newsletter_edit/'.$detail->newsletter_id.'/Y');?>" class="btn btn-primary" title="Send Newsletter">Active</a>	
												<?php
												}
												?>
											</td>
										  </tr>
										  <?php } ?>
										  <?php }else{ ?>
										  <tr class="gradeA odd" role="row"><td colspan="3" style="text-align:center;">No records found</td></tr>
										  <?php } ?>
									   </tbody>
									</table>
								 </div>
							  </div>
							 <div class="pagination" style="float:right;">            
								<?php echo $pagination ?>            
							</div>
							</div>
							<!-- /.table-responsive -->
							</div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>

		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?>
