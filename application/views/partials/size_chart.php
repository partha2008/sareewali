<div class="modal fade" id="size_chart_tbl" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Size Chart</h4>
          <div class="modal-radio">
            <p>Garment measurement shown may have tolerance of 0.5 inch to 1 inch.</p>
            <label class="radio-inline"><input value="cm" type="radio" name="optradio" checked onclick="changeSize(this.value);">Size in cm</label>
            <label class="radio-inline"><input value="inch" type="radio" name="optradio" onclick="changeSize(this.value);">Size in inches</label>
          </div>
        </div>
        <div class="modal-body">
          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Size</th>
                    <th scope="col">Bust</th>
                    <th scope="col">Waist</th>
                    <th scope="col">Hip</th>
                  </tr>
                </thead>

                <tbody id="size_in_cm"><tr><td data-th="Size">Size-32</td><td data-th="Bust">81.28</td><td data-th="Waist">66.04</td><td data-th="Hip">91.44</td></tr><tr><td data-th="Size">Size-34</td><td data-th="Bust">86.36</td><td data-th="Waist">71.12</td><td data-th="Hip">96.52</td></tr><tr><td data-th="Size">Size-36</td><td data-th="Bust">91.44</td><td data-th="Waist">76.2</td><td data-th="Hip">101.6</td></tr><tr><td data-th="Size">Size-38</td><td data-th="Bust">96.52</td><td data-th="Waist">81.28</td><td data-th="Hip">106.68</td></tr><tr><td data-th="Size">Size-40</td><td data-th="Bust">101.6</td><td data-th="Waist">86.36</td><td data-th="Hip">111.76</td></tr><tr><td data-th="Size">Size-42</td><td data-th="Bust">106.68</td><td data-th="Waist">91.44</td><td data-th="Hip">116.84</td></tr><tr><td data-th="Size">Size-44</td><td data-th="Bust">111.76</td><td data-th="Waist">96.52</td><td data-th="Hip">121.92</td></tr><tr><td data-th="Size">Size-46</td><td data-th="Bust">116.84</td><td data-th="Waist">101.6</td><td data-th="Hip">127</td></tr><tr><td data-th="Size">Size-48</td><td data-th="Bust">121.92</td><td data-th="Waist">106.68</td><td data-th="Hip">132.08</td></tr><tr><td data-th="Size">Size-50</td><td data-th="Bust">127</td><td data-th="Waist">111.76</td><td data-th="Hip">137.16</td></tr><tr><td data-th="Size">Size-52</td><td data-th="Bust">132.08</td><td data-th="Waist">116.84</td><td data-th="Hip">142.24</td></tr><tr><td data-th="Size">Size-54</td><td data-th="Bust">137.16</td><td data-th="Waist">121.92</td><td data-th="Hip">147.32</td></tr><tr><td data-th="Size">Size-56</td><td data-th="Bust">142.24</td><td data-th="Waist">127</td><td data-th="Hip">152.4</td></tr></tbody>

                <tbody id="size_in_inch" style="display: none;"><tr><td data-th="Size">Size-32</td><td data-th="Bust">32</td><td data-th="Waist">26</td><td data-th="Hip">36</td></tr><tr><td data-th="Size">Size-34</td><td data-th="Bust">34</td><td data-th="Waist">28</td><td data-th="Hip">38</td></tr><tr><td data-th="Size">Size-36</td><td data-th="Bust">36</td><td data-th="Waist">30</td><td data-th="Hip">40</td></tr><tr><td data-th="Size">Size-38</td><td data-th="Bust">38</td><td data-th="Waist">32</td><td data-th="Hip">42</td></tr><tr><td data-th="Size">Size-40</td><td data-th="Bust">40</td><td data-th="Waist">34</td><td data-th="Hip">44</td></tr><tr><td data-th="Size">Size-42</td><td data-th="Bust">42</td><td data-th="Waist">36</td><td data-th="Hip">46</td></tr><tr><td data-th="Size">Size-44</td><td data-th="Bust">44</td><td data-th="Waist">38</td><td data-th="Hip">48</td></tr><tr><td data-th="Size">Size-46</td><td data-th="Bust">46</td><td data-th="Waist">40</td><td data-th="Hip">50</td></tr><tr><td data-th="Size">Size-48</td><td data-th="Bust">48</td><td data-th="Waist">42</td><td data-th="Hip">52</td></tr><tr><td data-th="Size">Size-50</td><td data-th="Bust">50</td><td data-th="Waist">44</td><td data-th="Hip">54</td></tr><tr><td data-th="Size">Size-52</td><td data-th="Bust">52</td><td data-th="Waist">46</td><td data-th="Hip">56</td></tr><tr><td data-th="Size">Size-54</td><td data-th="Bust">54</td><td data-th="Waist">48</td><td data-th="Hip">58</td></tr><tr><td data-th="Size">Size-56</td><td data-th="Bust">56</td><td data-th="Waist">50</td><td data-th="Hip">60</td></tr></tbody>
              </table>
            </div>            
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <script type="text/javascript">
    function changeSize(val){
      if(val == "cm"){
        $("#size_in_cm").show();
        $("#size_in_inch").hide();
      }else{
        $("#size_in_inch").show();
        $("#size_in_cm").hide();
      }
    }
  </script>