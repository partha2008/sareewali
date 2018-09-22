		<?php echo $head;?>
		
		<div id="wrapper">

			<?php echo $header;?>
            <?php
                function get_element_from_arr($arr, $elm){
                    if(!empty($arr)){
                        foreach ($arr as $value) {
                            if($value->sort_order == $elm){
                                return $value->image_path;
                            }
                        }
                    }
                }
            ?>

			<div id="page-wrapper" style="min-height: 374px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ads Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
                        if(!empty($ads_section)){
                            foreach ($ads_section as $value) {
                    ?>
                    <form method="post" action="<?php echo base_url('admin/user/update_ads');?>" enctype="multipart/form-data">
                        <div class="panel panel-default"> 
                            <div class="panel-heading">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="section" <?php if($value->status == 'Y'){echo 'checked';}?>><?php echo $value->label;?>
                                    </label>
                                </div>
                            </div>                       
    						<div class="panel-body">
                                <?php 
                                for($i=0;$i<$value->no_of_field;$i++){
                                ?>          
                                    <div class="form-group">
                                        <label class="control-label">Image<?php echo $i+1;?></label>
                                        <input class="form-control" type="file" name="<?php echo $i;?>">
                                        <?php
                                            $img = get_element_from_arr($value->ads, ($i+1));
                                            if($img){
                                        ?>
                                            <img src="<?php echo UPLOAD_ADS_PATH.$img;?>" width="100px">
                                        <?php
                                            }
                                        ?>
                                    </div> 
                                <?php
                                    }
                                ?>
                                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
                                <input type="hidden" name="ads_section_id" value="<?php echo $value->ads_section_id;?>">
                                <input type="hidden" name="width" value="<?php echo $value->width;?>">
                                <input type="hidden" name="height" value="<?php echo $value->height;?>">
                            </div>
                        </div>
                    </form>
                    <?php
                            }
                        }
                    ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>

		</div>
		<!-- /#wrapper -->
		
		<?php echo $footer; ?>
