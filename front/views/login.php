<?php include 'header.php';?>

<div class="login-page">
  <div class="form">
    <form class="login-form" id="login_form">
      <!-- <input type="text" placeholder="email"/> -->
      <input type='email' class='form-control' id='email' name='email' placeholder='Enter email'>
      <!-- <input type="password" placeholder="password"/> -->
      <input type='password' class='form-control' id='password' name='password' placeholder='Password'>
      <button type="submit">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>

<?php include 'footer.php';?>