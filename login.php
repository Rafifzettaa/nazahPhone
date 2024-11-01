<!DOCTYPE html>
<html lang="en">
<?php
session_start();





?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login || Nazahphone</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery-3.7.1.js"></script>
</head>




<body>
  <div class="container">
    <div class="box col-12">


      <div class="container1">


        <div class="signin-signup">

          <form action="auth/proses-login.php" method="POST" class="sign-in-form">
            <?php
            if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
              if ($_GET['pesan'] == "gagal") { ?>
                <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                  <div class="d-flex">
                    <div class="toast-body">
                      Login Gagal. Username Dan Password Salah
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                </div>
            <?php } elseif ($_GET['pesan'] == "logout") {?>
                <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                <div class="d-flex">
                  <div class="toast-body">
                    Login Gagal. Username Dan Password Salah
                  </div>
                  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>
             <?php  } elseif ($_GET['pesan'] == "belum_login") {?>
                <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                <div class="d-flex">
                  <div class="toast-body">
                    Login Gagal. Username Dan Password Salah
                  </div>
                  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
              </div>
            <?php   }
            }
            if (isset($_GET['status'])) {
              if ($_GET['status'] == "berhasil_daftar") {
                echo "<div class='alert alert-info text-center'>
            <p>Registrasi Berhasil Silahkan Login</p></div>";
              } elseif ($_GET['status'] == "sudah_terdaftar") {
                echo "<div class='alert alert-info text-center'>
            <p>Username Atau Email sudah terdaftar</p></div>";
              }
            }
            ?>
            <h2 class="judul">Log In</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username">
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password">
            </div>
            <input type="submit" value="login" class="btn" name="login" style="  background: #00B2FF;">
            <p class="account-text">Apakah tidak memiliki akun? <a href="#" id="sign-up-btn2">Sign Up</a></p>
          </form>
          <form action="auth/proses-registrasi.php" method="post" class="sign-up-form">
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
            <input type="submit" value="Sign Up" name="registrasi" class="btn" style="background: #00B2FF;">
            <p class="account-text">Sudah memiliki Akun? <a href="#" id="sign-in-btn2">Sign in</a></p>
          </form>
        </div>
        <div class="panels-container">
          <div class="panel left-panel">
            <div class="content">
              <h3>Sudah memiliki Account?</h3>
              <button class="btn" id="sign-in-btn" style="background: #00B2FF;">Sign In</button>
            </div>
          </div>
          <div class="panel right-panel">
            <div class="content">
              <h3>Belum Memiliki Account?</h3>
              <button class="btn" id="sign-up-btn" style="  background: #00B2FF;">Sign Up</button>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script>
  var toastElList = [].slice.call(document.querySelectorAll('.toast'))
  var toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl, { autohide: false })
  });
  toastList.forEach(toast => toast.show());
</script>

  <script src="script.js"></script>
</body>


</html>