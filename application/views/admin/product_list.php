		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">List of Products</h1>
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
										<div class="col-sm-12">
											<table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTable" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
												<thead>
													<tr role="row">
														<th>Slug</th>
														<th>Name</th>
														<th>SKU</th>
														<th>Quantity</th>
														<th>Price (<i class="fa fa-inr"></i>)</th>	
														<th>Status</th>	
														<th>Actions</th>
													</tr>
												</thead>
											</table>
										</div>
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