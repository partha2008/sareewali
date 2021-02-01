  <form id="frmLogin" name="frmLogin" class="form-horizontal" novalidate>

    <div class="loginPopupBox">

      <h2>LOGIN</h2>

      <h3>Login with your <span><?php echo $general_settings->sitename;?></span> account</h3>

      <span class="error"></span> 
      <span class="success"></span>

      <div class="inputHolder inputEmail">
        <input type="email" class="form-control" name="email" placeholder="E-mail Address">
      </div>

      <div class="inputHolder inputPassword">

        <input type="password" class="form-control" placeholder="Password" name="password">

      </div>

      <div class="">

        <button class="btn btn-custom" value="Submit" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN</button>

      </div>

      <div class="forgotPasswordBox">

        <p>Forgot password? <a class="showForgotPassPopup" href="javascript:void(0)" onclick="openModal('forget');">Click here</a></p>

        <p>New to Sareewali <a class="showSignUpPopup" href="javascript:void(0)" onclick="openModal('register');">SIGNUP</a></p>
      </div>

    </div>
  </form>