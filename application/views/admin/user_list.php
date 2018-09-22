		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">List of Users</h1>
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
									<table id="user_list_tbl" width="100%" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;">
										<thead>
											<tr role="row">
												<th>Name</th>
												<th>Email</th>
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
		<script>
			$(function () {
				var dataset = '<?php echo json_encode($user_details);?>';
				var data_obj = JSON.parse(dataset);
				var data_arr = [];
				var final_arr = [];
				
				for(var i=0;i<data_obj.length;i++){					
					data_arr.push(data_obj[i].first_name+' '+data_obj[i].last_name);
					data_arr.push(data_obj[i].email);
					data_arr.push((data_obj[i].status == 'Y') ? 'Active' : 'Inactive');
					data_arr.push(data_obj[i].user_id);
					
					final_arr.push(data_arr);
					var data_arr = [];
				}
				
				$('#user_list_tbl').dataTable({
					data: final_arr,	
					"rowCallback": function(row, data, index){
		                if(data[2] == 'Active')
		                    $(row).find('td:eq(3)').css({'color': '#3c763d', 'font-weight': 'bold'});
		                else
		                    $(row).find('td:eq(3)').css({'color': '#a94442', 'font-weight': 'bold'});

		                $(row).find('td:eq(3) .btn-success').attr("href", BASEPATH+"admin/user-edit/"+data[3]);
		                
		                var del_path = BASEPATH+'admin/user/user_delete/'+data[3];
		                if(data[2] == 'Active'){
		                    $(row).find('td:eq(3) .btn-danger').attr("onclick", "onDeleteConfirm('"+del_path+"')");
		                }
		                else{
		                    $(row).find('td:eq(3) .btn-danger').remove();
		                }
		            },				
					columns: [
						{ title: "Name" },
						{ title: "Email" },
						{ title: "Status" },
						{ "data":null, "defaultContent":"<a href='' class='btn btn-success' title='Edit'>Edit</a>&nbsp;<a href='javscript:void(0)' class='btn btn-danger' title='Delete'>Delete</a>"}
					],
					processing: true,
					searching: true,
					paging: true,
					info: true,
					order: [],
					columnDefs: [{
						targets: [2, 3],
						orderable: false
					}]
				});
				
				$("#user_list_tbl_wrapper").find("select, input").addClass("form-control").attr("placeholder", "Name / Email");
			});
		</script>