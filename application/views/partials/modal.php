<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade logpopup in" id="loginModal">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog modal-md vertical-align-center"> 
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button" onclick="$('#loginModal').hide();">×</button>
        </div>
        <div class="modal-body">
          <div class="">
            <div id="loginform" class="loginLeft"></div>
            <!-- loginLeft Box End -->           

            <div class="loginRight">
              <h3>Sign in with</h3>
              <div class="scl-logn">
                <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" data-onlogin="checkLoginState();" data-scope="public_profile,email"></div>
                <a href="javascript:void(0);" class="gpl" id="google-login-button">Sign in with Google</a> 
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>