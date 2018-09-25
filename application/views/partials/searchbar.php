<div class="col-md-3">
  <form name="frmFilter" id="frmFilter" action="">
    <div class="filterHeadMobile"><i class="fa fa-caret-down" aria-hidden="true"></i>Filter</div>
    <div class="leftBox">
      <div class="filterBox">
        <h2><i class="fa fa-caret-down" aria-hidden="true"></i>Color </h2>
        <div class="scroll-color">
          <ul class="filterItems">
            <?php
              if(!empty($colors)){
                foreach ($colors as $key => $value) {
            ?>
            <li>
              <input type="checkbox" id="<?php echo $value->name;?>" name="color[]" value="<?php echo $value->color_id;?>" />
              <label for="<?php echo $value->name;?>"> <span ></span><?php echo $value->name;?> </label>
            </li>
            <?php
                }
              }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </form>
</div>