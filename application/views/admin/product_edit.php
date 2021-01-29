<?php echo $head;?>



<div id="wrapper">



<?php echo $header;?>



<div id="page-wrapper" style="min-height: 325px;">

<div class="row">

<div class="col-lg-12">

<h1 class="page-header">Update Product</h1>

</div>

<!-- /.col-lg-12 -->

</div>

<!-- /.row -->

<div class="row">

<div class="col-lg-12">

<?php 

$sess_notify = $this->session->userdata('has_error');

if(isset($sess_notify) & $sess_notify){

?>

<div class="alert alert-danger alert-dismissable">

<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<?php echo $this->session->userdata('productedit_notification');?>

</div>

<?php } 

$this->session->unset_userdata('has_error');

$this->session->unset_userdata('productedit_notification');

$this->session->unset_userdata('prd_dic_chk');

?>

<div class="panel panel-default">

<div class="panel-body">

<div class="row">

<div class="col-lg-12">

<form action="<?php echo base_url('admin/product/edit_product');?>" method="POST" role="form" enctype="multipart/form-data">

<div class="form-group">

<label class="control-label">Entity <span style="color:#a94442;">*</span></label>

<select name="entity_id[]" class="form-control" multiple="multiple" id="multi_select">

<?php if(count($cat_list) > 0){ ?>

<?php foreach($cat_list AS $list) {?>

<option value="<?php echo $list->entity_id;?>" 

<?php

if(isset($product_details)){

if(in_array($list->entity_id, $entity_id)){

echo 'selected';

}

}

?>

>

<?php echo $list->name;?>

</option>

<?php } ?>

<?php } ?>

</select>

</div>

<div class="form-group">

<label class="control-label">Name <span style="color:#a94442;">*</span></label>

<input class="form-control" type="text" name="name" placeholder="Enter Product Name" value="<?php echo $product_details->name;?>">

</div>

<div class="form-group">

<label class="control-label">Description <span style="color:#a94442;">*</span></label>

<textarea id="term" name="description" class="form-control" placeholder="Enter Description"><?php echo $product_details->description;?></textarea>

</div>

<div class="form-group">

<label class="control-label">Notes <span style="color:#a94442;">*</span></label>

<textarea id="prd_notes" name="note" class="form-control" placeholder="Enter Description"><?php echo (isset($product_details->note) && $product_details->note) ? $product_details->note : '';?></textarea>

</div>

<div class="form-group">

<label class="control-label">Label Price <span style="color:#a94442;">*</span></label>

<input id="label_price" class="form-control" type="text" name="price" value="<?php echo (isset($product_details->price) && $product_details->price) ? $product_details->price : '';?>">

</div>

<div class="form-inline">

<div class="checkbox">

<label><input <?php if(isset($product_details->prd_dic_chk) && ($product_details->prd_dic_chk == "Y")){echo 'checked';}?> type="checkbox" id="prd_dic_chk" name="prd_dic_chk"> Discount</label>

</div>

<div class="form-group">

<select class="form-control" id="prd_dis_mode" name="prd_dis_mode">

<option value="flat" <?php if(isset($product_details->prd_dis_mode) && ($product_details->prd_dis_mode == 'flat')){echo 'selected';};?>>Flat</option>

<option value="per" <?php if(isset($product_details->prd_dis_mode) && ($product_details->prd_dis_mode == 'per')){echo 'selected';};?>>Percentage</option>

</select>

</div>

<div class="form-group">

<input type="text" class="form-control" placeholder="Enter Amount" id="prd_dis_amt" name="prd_dis_amt" value="<?php if(isset($product_details->prd_dis_amt)){echo $product_details->prd_dis_amt;}?>">

</div>

<button type="button" class="btn btn-primary" id="prd_dis_btn">Submit</button>										  

<div class="form-group">

<input name="discounted_price" value="<?php if(isset($product_details->discounted_price)){echo $product_details->discounted_price;}?>" id="prd_dis_price" type="text" class="form-control" placeholder="Discounted Price" readonly>

</div>

</div>
<div class="form-check form-check-inline" style="margin-top: 10px;">
  <input class="form-check-input" type="radio" name="mode_qnty" id="inlineRadio1" value="1" <?php if($product_details->mode_qnty == "1"){echo "checked";}?> onclick="change_qnty_mode('1')">
  <label class="form-check-label" for="inlineRadio1">Quantity without Size</label>

  <input class="form-check-input" type="radio" name="mode_qnty" id="inlineRadio2" value="2" <?php if($product_details->mode_qnty == "2"){echo "checked";}?> onclick="change_qnty_mode('2')">
  <label class="form-check-label" for="inlineRadio2">Quantity over Size</label>
</div>

<div class="form-group" id="size_wth_qnty" style="<?php if($product_details->mode_qnty == "2"){echo 'display: none;';}?>">

<label class="control-label">Quantity <span style="color:#a94442;">*</span></label>

<input class="form-control" type="number" name="quantity" min="1" value="<?php echo (isset($product_details->quantity) && $product_details->quantity) ? $product_details->quantity : '';?>">

</div>



<div class="form-group" style="<?php if($product_details->mode_qnty == "1"){echo 'display: none;';}?>" id="size_over_qnty">

	<label class="control-label">Size <span style="color:#a94442;">*</span></label>

	<div class="row">

		<div class="col-lg-12">

			<button id="add_size_btn" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button>

		</div>

	</div>

	<div class="panel-body">

		<span id="sizeelm" style="display: none;">

			<div class="row mb-10">

				<div class="col-lg-4">

					<input type="text" class="form-control" name="size[]" placeholder="Size in cm">

				</div>

				<div class="col-lg-4">

					<input type="text" class="form-control" name="qnty[]" placeholder="Quantity">

				</div>

				

				<div class="col-lg-4">

					<button type="button" class="btn btn-danger btn-circle">

						<i class="fa fa-times"></i> 

					</button> 

				</div>

			</div>

		</span>

		<span id="container_size">
			<?php
				if(!empty($sizes)){
					foreach ($sizes as $key => $value) {
			?>
			<div class="row mb-10">
				<div class="col-lg-4">
					<input type="text" class="form-control" name="size[]" placeholder="Size in cm" value="<?php echo $value->size;?>">
				</div>
				<div class="col-lg-4">
					<input type="text" class="form-control" name="qnty[]" placeholder="Quantity" value="<?php echo $value->quantity;?>">
				</div>	
				<div class="col-lg-4">
					<button type="button" class="btn btn-danger btn-circle btn-remove" key="<?php echo $value->product_size_id;?>" mode="edit">
						<i class="fa fa-times"></i> 
					</button> 
				</div>
			</div>
			<?php
					}
				}
			?>
		</span>

	</div>

</div>

<div class="form-group">

<label class="control-label">SKU <span style="color:#a94442;">*</span></label>

<input class="form-control" type="text" name="sku" value="<?php echo (isset($product_details->sku) && $product_details->sku) ? $product_details->sku : '';?>" readonly>

</div>

<div class="form-group">

<label class="control-label">Tag</label>

<select name="tag[]" class="form-control" multiple="multiple">

<option value="1" <?php if(isset($tags_sess) && !empty($tags_sess)){if(in_array("1", $tags_sess)){echo 'selected';}}elseif($this->defaultdata->in_assoc("tag_id", "1", $tags)){echo 'selected';}?> >Best Selling</option>

<option value="2" <?php if(isset($tags_sess) && !empty($tags_sess)){if(in_array("2", $tags_sess)){echo 'selected';}}elseif($this->defaultdata->in_assoc("tag_id", "2", $tags)){echo 'selected';}?> >Most Popular</option>

</select>

</div>

<div class="form-group">

<fieldset class="col-md-12 scheduler-border">    	

<legend class="scheduler-border">Search Items</legend>

<span id="attr_plc"></span>



</fieldset>	

</div>

<div class="form-group">

<label class="control-label">Content <span style="color:#a94442;">*</span></label>

<input placeholder="Fill up with comma seperated value. Ex: Saree, Blouse" class="form-control" type="text" name="content" value="<?php echo (isset($product_details->content) && $product_details->content) ? $product_details->content : '';?>">

</div>

<div class="form-group">

<label class="control-label">Out of Stock</label>

<label class="radio-inline">

<input type="radio" name="out_of_stock" value="Y" <?php if(isset($product_details->out_of_stock)){if($product_details->out_of_stock == 'Y'){echo 'checked';}}else{echo 'checked';}?> >Yes

</label>

<label class="radio-inline">

<input type="radio" name="out_of_stock" value="N" <?php if(isset($product_details->out_of_stock)){if($product_details->out_of_stock == 'N'){echo 'checked';}}else{echo 'checked';}?> >No

</label>

</div>

<div class="form-group">

<label class="control-label">Attribute <span style="color:#a94442;">*</span></label>

<div class="row">

<div class="col-lg-12">

<button id="add_attr_btn" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button>

</div>

</div>



<div class="panel-body">

<span id="attrelm" class="hidden">

<div class="row mb-10">

<div class="col-lg-3">

<input type="text" class="form-control" name="attrname[]" placeholder="Name">

</div>

<div class="col-lg-3">

<input type="text" class="form-control" name="attrval[]" placeholder="Value">

</div>

<div class="col-lg-3">

<select name="attrunit[]" class="form-control">

<?php

if(!empty($unit)){

echo '<option value="">None</option>';

foreach ($unit as $key => $value) {

?>

<option value="<?php echo $key;?>"><?php echo $value;?></option>

<?php

}

}

?>

</select>

</div>

<div class="col-lg-3">

<button type="button" class="btn btn-danger btn-circle">

<i class="fa fa-times"></i> 

</button> 

</div>

</div>

</span>

<span id="container">

<?php

if(!empty($attr_list)){

foreach($attr_list AS $list){

?>

<div class="row mb-10">

<div class="col-lg-3">

<input type="text" class="form-control" name="attrname[]" value="<?php echo $list->name;?>" placeholder="Name" disabled>

</div>

<div class="col-lg-3">

<input type="text" class="form-control" name="attrval[]" value="<?php echo $list->value;?>" placeholder="Value" disabled>

</div>

<div class="col-lg-3">

<select name="attrunit[]" class="form-control" disabled>

<?php

if(!empty($unit)){

echo '<option value="">None</option>';

foreach ($unit as $key => $value) {

?>

<option value="<?php echo $key;?>" <?php if($key==$list->unit){echo 'selected';}?>><?php echo $value;?></option>

<?php

}

}

?>

</select>

</div>

<div class="col-lg-3">

<button type="button" key="<?php echo $list->product_attribute_id;?>" mode="edit" class="btn btn-danger btn-circle btn-remove">

<i class="fa fa-times"></i> 

</button> 

</div>

</div>

<?php

}

}

?>

</span>

</div>

</div>

<div class="form-group">

<label class="control-label">Upload Images <span style="color:#a94442;">*</span></label>	

<?php

$this->load->view('admin/partials/upload');

?>										    

</div>

<div class="form-group">

<label class="control-label">Status</label>

<label class="radio-inline">

<input type="radio" name="status" value="Y" <?php if(isset($product_details->status)){if($product_details->status == 'Y'){echo 'checked';}}else{echo 'checked';}?> >Active

</label>

<label class="radio-inline">

<input type="radio" name="status" value="N" <?php if(isset($product_details->status)){if($product_details->status == 'N'){echo 'checked';}}else{echo 'checked';}?> >Inactive

</label>

</div>

<div class="form-group">

	<fieldset class="col-md-12 scheduler-border">    	

		<legend class="scheduler-border">For SEO</legend>

		<div class="form-group">

			<label class="control-label">Title</label>

			<input class="form-control" type="text" name="title" placeholder="Enter Title" value="<?php echo (isset($product_details->title) && $product_details->title) ? $product_details->title : '';?>">

		</div>
		<div class="form-group">

			<label class="control-label">Meta Description</label>

			<textarea class="form-control" name="meta_desc" placeholder="Enter Meta Description"><?php echo (isset($product_details->meta_desc) && $product_details->meta_desc) ? $product_details->meta_desc : '';?></textarea>

		</div>
		<div class="form-group">

			<label class="control-label">Meta Keywords</label>

			<textarea class="form-control" name="meta_key" placeholder="Enter Meta Keywords"><?php echo (isset($product_details->meta_key) && $product_details->meta_key) ? $product_details->meta_key : '';?></textarea>

		</div>	

	</fieldset>	

</div>

<input type="hidden" name="slug" value="<?php echo $product_details->slug;?>">

<input type="hidden" name="old_name" value="<?php echo $product_details->name;?>">

<input type="hidden" name="product_id" value="<?php echo $product_details->product_id;?>" id="product_id">

<input type="hidden" id="upload_image" name="upload_image" value="">

<button id="edit_product" type="submit" class="btn btn-primary">Save Changes</button>

</form>

</div>

<!-- /.col-lg-6 (nested) -->									

</div>

<!-- /.row (nested) -->

</div>

<!-- /.panel-body -->

</div>

<!-- /.panel -->

</div>

<!-- /.col-lg-12 -->

</div>

<!-- /.row -->

</div>

<!-- /.page-wrapper -->

</div>

<!-- /#wrapper -->



<?php echo $footer; ?>

<script type="text/javascript">

$(function(){

var product_id = '<?php echo $product_details->product_id;?>';

var selected = $("#multi_select").val();

populateEntityAttr(selected, 'edit', product_id);



$("#multi_select").change(function(e){

var selected = $(e.target).val();

populateEntityAttr(selected, 'edit', product_id); 

});

})

</script>