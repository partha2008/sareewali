<form id="frmSignups" name="frmSignups" class="form-horizontal" novalidate>
  <div class="signUpPopupBox">
    <h2>Registration</h2>
    <h3>Sign up with <span><?php echo $general_settings->sitename;?></span></h3>
    <span class="error"></span> 
    <span class="success"></span>
    <div class="inputHolder firstName">
      <input type="text" class="form-control" name="first_name" placeholder="First Name">
    </div>
    <div class="inputHolder lastName">
      <input type="text" class="form-control" name="last_name" placeholder="Last Name">
    </div>
    <div class="inputHolder inputEmail">
      <input type="email" class="form-control" name="email" placeholder="E-mail Address">
    </div>
    <div class="inputHolder inputPassword">
      <input type="password" class="form-control" placeholder="Password" name="password">
    </div>
    <div class="inputHolder inputPassword">
      <input type="password" class="form-control" placeholder="Password Confirmation" name="confirm_password">
    </div>
    <div class="inputHolder inputPassword">
      <input type="text" class="form-control" placeholder="Mobile No" name="phone">
    </div>
    <div class="">
      <button class="btn btn-custom" value="Submit" type="submit"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</button>
    </div>
    <div class="forgotPasswordBox">
      <p><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back To Login <a class="showLoginPupup" href="javascript:void(0)" onclick="openModal('login');">Click here</a></p>
    </div>
  </div>
  <!-- Sign Up Box End -->
</form>