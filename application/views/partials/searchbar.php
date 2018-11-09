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
                  <input class="filter_color" type="checkbox" id="<?php echo $value->name;?>" name="color[]" value="<?php echo $value->color_id;?>" onclick="search_by_attr(0);" />
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
        <h2><i class="fa fa-caret-down" aria-hidden="true"></i>Fabric </h2>
        <div class="scroll-fabric">
          <ul class="filterItems">
            <?php
              $fabrics = $this->config->item("fabric");
              foreach ($fabrics as $key => $value) {               
            ?>
            <li>
              <input class="filter_fabric" type="checkbox" id="<?php echo $value;?>" name="fabric[]" value="<?php echo $key;?>"  onclick="search_by_attr(0);" />
              <label for="<?php echo $value;?>"> <span ></span><?php echo $value;?> </label>
            </li>
            <?php
              }
            ?>
          </ul>
        </div>
      </div>

      <div class="filterBox">
        <h2><i class="fa fa-caret-down" aria-hidden="true"></i>Occassion </h2>
        <div class="scroll-occassion">
          <ul class="filterItems">
            <?php
              $occassions = $this->config->item("occassion");
              foreach ($occassions as $key => $value) {               
            ?>
            <li>
              <input class="filter_occassion" type="checkbox" id="<?php echo $value;?>" name="occassion[]" value="<?php echo $key;?>"  onclick="search_by_attr(0);" />
              <label for="<?php echo $value;?>"> <span ></span><?php echo $value;?> </label>
            </li>
            <?php
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
            <input type="number" min=0 max="20000" oninput="validity.valid||(value='20000');" id="max_price" class="price-range-field" />
          </div>
        </div>
      </div>

    </div>
  </form>
</div>