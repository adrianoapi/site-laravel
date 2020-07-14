@extends('site3.master.layout')

@section('content')

<div class="form-inner-cont">
  <h3>Login now</h3>
  <form action="#" method="post" class="signin-form">
    <div class="form-input">
      <span class="fa fa-envelope-o" aria-hidden="true"></span> <input type="email" name="email"
        placeholder="Username" required />
    </div>
    <div class="form-input">
      <span class="fa fa-key" aria-hidden="true"></span> <input type="password" name="password" placeholder="Password"
        required />
    </div>
    <div class="login-remember d-grid">
      <label class="check-remaind">
        <input type="checkbox">
        <span class="checkmark"></span>
        <p class="remember">Remember me</p>
      </label>
      <button class="btn theme-button">Login</button>
    </div>
    <div class="new-signup">
      <a href="#reload" class="signuplink">Forgot password?</a>
    </div>
  </form>
  <div class="social-icons">
    <div class="social-login" style="display:none;">
      <a href="#facebook">
        <div class="facebook">
          <span class="fa fa-facebook" aria-hidden="true"></span>

        </div>
      </a>
      <a href="#google">
        <div class="google">
          <span class="fa fa-google-plus" aria-hidden="true"></span>
        </div>
      </a>
    </div>
  </div>
  <p class="signup">Don’t have an account? <a href="#signup.html" class="signuplink">Sign up</a></p>
</div>

@endsection