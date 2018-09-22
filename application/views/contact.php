        <?php echo $head; ?>
        <?php echo $header; ?>
        <style>
          #map {
            width: 100%;
            height: 400px;
            background-color: grey;
          }
        </style>
        <?php    
          $address = $admin_profile->address;      
          $address = str_ireplace('<p>','',$address);
          $address = str_ireplace('</p>','',$address); 
          $address = str_replace("\r\n", "", $address);
        ?>

        <section class="breadcrumbs">
          <div class="container">
            <?php echo $breadcrumb;?>
          </div>
        </section>

        <section class="page-container">
          <div class="container checkoutPage">
           <div class="page-content">
            <h1 class="page-title">CONTACT US</h1>
            <div class="row">
              <div class="col-md-6">
                <div class="contact-map" id="map"></div>
              </div>
              <div class="col-md-6">
                <form class="form-horizontal contact-message-block" method="post" action="<?php echo base_url('home/add_contact');?>" novalidate>
                  <h2 class="your-message">Send us your message</h2>                  
                  <fieldset id="account">
                    <?php 
                    $sess_notify = $this->session->userdata('has_error');
                    if(isset($sess_notify) & $sess_notify){
                  ?>
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $this->session->userdata('contact_notification');?>
                    </div>
                  <?php }
                    if(isset($sess_notify) & !$sess_notify){
                    ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <?php echo $this->session->userdata('contact_notification');?>
                    </div>
                  <?php
                  } 
                  $this->session->unset_userdata('has_error');
                  $this->session->unset_userdata('contact_notification');
                  ?>
                    <div class="form-group required">
                      <label class="col-md-12 control-label" for="fullname">Full Name</label>
                      <div class="col-md-12">
                        <input placeholder="Full Name" id="fullname" class="form-control" type="text" name="fullname">
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-md-12 control-label" for="phonenumber">Phone Number</label>
                      <div class="col-md-12">
                        <input placeholder="Phone Number" id="phonenumber" class="form-control" type="text" name="phonenumber">
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-md-12 control-label" for="emailaddress">Email Address</label>
                      <div class="col-md-12">
                        <input placeholder="Email Address" id="emailaddress" class="form-control" type="email" name="email">
                      </div>
                    </div>
                    <div class="form-group required">
                      <label class="col-md-12 control-label" for="emailaddress">Message</label>
                      <div class="col-md-12">
                        <textarea class="form-control contact-textarea" name="message"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-12">
                        <button type="submit" id="change-pwd-btn" class="websiteBtn">Send</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>  
      </section>
        <script>
          var geocoder;
          var map;
          var address = '<?php echo $address;?>';

          function initialize() {
              geocoder = new google.maps.Geocoder();
              var latlng = new google.maps.LatLng(-34.397, 150.644);
              var myOptions = {
                  zoom: 8,
                  center: latlng,
                  mapTypeControl: true,
                  mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                  },
                  navigationControl: true,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
              };
              map = new google.maps.Map(document.getElementById("map"), myOptions);
              if (geocoder) {
                  geocoder.geocode({
                      'address': address
                  }, function(results, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                              map.setCenter(results[0].geometry.location);
                              var infowindow = new google.maps.InfoWindow({
                                  content: '<strong style="color:#c70039;">' + address + '</strong>',
                                  size: new google.maps.Size(150, 50),
                                  maxWidth: 200
                              });
                              var marker = new google.maps.Marker({
                                  position: results[0].geometry.location,
                                  map: map,
                                  title: address
                              });
                              google.maps.event.addListener(marker, 'click', function() {
                                  infowindow.open(map, marker);
                              });
                          } else {
                              alert("No results found");
                          }
                      } else {
                          alert("Geocode was not successful for the following reason: " + status);
                      }
                  });
              }
          } 
          </script>
          <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA75sDPPB1Fb2IZuk5liKkthm877h-SyC4&callback=initialize">
            </script>
      <?php echo $footer; ?>
      <?php echo $foot; ?>

