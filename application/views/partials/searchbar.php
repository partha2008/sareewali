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
      <div class="filterBox">

        <h2><i class="fa fa-caret-down" aria-hidden="true"></i>Select Price range</h2>

        <div class="price-range-block">
          <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
          <div style="margin:30px auto">
            <input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" />
            <input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field" />
          </div>
        </div>

      </div>
    </div>
  </form>
</div>