<div class="col-md-3">

  <form name="frmFilter" id="frmFilter" action="">

    <div class="filterHeadMobile"><i class="fa fa-caret-down" aria-hidden="true"></i>Filter</div>

    <div class="leftBox">

      <?php

        if(!empty($ent_attr)){

          foreach ($ent_attr as $key => $value) {

      ?>

        <div class="filterBox">

          <h2><i class="fa fa-caret-down" aria-hidden="true"></i><?php echo $value->name;?> </h2>

          <div class="scroll-color">

            <ul class="filterItems">

              <?php

                if(!empty($value->ent_data)){

                  foreach ($value->ent_data as $k => $v) {

              ?>

              <li>

                <input class="filter_color" type="checkbox" id="<?php echo $v->{$value->name.'_id'}.'_'.$value->name;?>" name="<?php echo $value->name;?>" value="<?php echo $v->{$value->name.'_id'};?>" onclick="search_by_attr(0);" />

                <label for="<?php echo $v->{$value->name.'_id'}.'_'.$value->name;?>"><span></span><?php echo $v->name;?></label>

              </li>

              <?php

                  }

                }

              ?>

            </ul>

          </div>

        </div>

      <?php

          }

        }

      ?>



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