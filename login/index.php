<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login4.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8i7u7L1pddI9rybSvW8uuZ9S9PF5LKOzp1q3u70jOtIbb2+5L5ZvYJl3In" crossorigin="anonymous">
  <meta http-equiv="1">
  </head>
  <body>

<div class="box">
  <header><h3>Selamat Datang di NazahFone <br> Silahkan Login</h3></header>
    <div class="container">
    <div class="signin-signup">
      <form action="proses-login.php" method="POST" class="sign-in-form">
        <h2 class="judul">Sign In</h2>
        <div class="input-field">
          <i class="fas fas-user"></i>
          <input type="text" placeholder="Username" name="username">
        </div>
        <div class="input-field">
          <i class="fas fas-lock"></i>
          <input type="password" placeholder="Password" name="password">
        </div>
        <input type="submit" name="login" value="login" class="btn">
        <p class="account-text">Apakah tidak memiliki akun? <a href="#" id="sign-up-btn2">Sign Up</a></p>
      </form>
      <form action="proses-registrasi.php" method="POST" class="sign-up-form">
        <h2 class="judul">Sign Up</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Username" name="username">
        </div>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="text" placeholder="Email" name="email">
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" name="password">
        </div>
        <input type="submit" value="login" class="btn">
        <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
      </form>
    </div>
    <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Sudah memiliki Account?</h3>
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Belum Memiliki Account?</h3>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
        </div>
    </div>
</div>
</div>

 
  </body>
  <script src="script.js">
 
</script>
</html>