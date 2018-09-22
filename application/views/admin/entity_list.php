		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Entities</h1>
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
								 <div class="col-sm-6">
									<a href="<?php echo base_url('admin/entity-add');?>" class="btn btn-primary">Add Entity</a>
									<a id="view_relation" href="javascript:void(0);" class="btn btn-primary">View Relation</a>
								 </div>
								 <div class="col-sm-6">
									<form action="<?php echo base_url('admin/entity-list');?>" method="GET" role="form">
										<div id="dataTables-example_filter" class="dataTables_filter">
											<label>Search by:<input name="name" type="search" class="form-control input-sm" placeholder="Entity Name" aria-controls="dataTables-example" id="user-search" value="<?php echo $search_key;?>"></label>
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
											 <th>Entity Name</th>						 
											 <th>Status</th>
											 <th>Actions</th>
										  </tr>
									   </thead>
									   <tbody>
									    <?php if(!empty($entity_details)){ ?>
										<?php foreach($entity_details AS $detail) {?>
										  <tr class="gradeA odd" role="row">
											 <td><?php echo $detail->name;?></td>	
											 <td class="center"><?php echo ($detail->status == 'Y' ? '<strong class="text-success">Active</strong>' : '<strong class="text-danger">Inactive</strong>');?></td>
											 <td class="center">
												<a href="<?php echo base_url('admin/entity-edit/'.$detail->slug);?>" class="btn btn-success" title="Edit">Edit</a>&nbsp;
												<?php
													if($detail->status == 'Y'){
												?>
												<a href="javascript:void(0);" onclick="onDeleteConfirm('<?php echo base_url('admin/entity/entity_update/'.$detail->slug);?>');" class="btn btn-danger" title="Delete">Delete<a>						<?php
													}
												?>						
											</td>
										  </tr>
										  <?php } ?>
										  <?php }else{ ?>
										  <tr class="gradeA odd" role="row"><td colspan="4" style="text-align:center;">No records found</td></tr>
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
