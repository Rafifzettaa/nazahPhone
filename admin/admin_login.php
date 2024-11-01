<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .custom-container {
            position: relative;
        }

        .custom-image {
            max-height: 200px;
            width: auto;
            border-radius: 1rem;
            display: block;
            margin: 0 auto; 
        }

        .custom-form {
            background: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: blur(30px);
            padding: 20px;
            border-radius: 0 1rem 1rem 0;
            margin-top: 50px; 
        }
    </style>
</head>

<body style="background-image: linear-gradient(#4682b4, #00b2ff);">
    <?php
    if (isset($_GET['pesan']) && in_array($_GET['pesan'], ['gagal', 'logout', 'belum_login'])):
    ?>
        <div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="d-flex">
                <div class="toast-body">
                    Login Gagal. Username dan Password Salah
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php
    endif;

    ?>

    <div class="container">
        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-6 col-lg-7 align-items-center">  
                        <div class="card" style="border-radius: 1rem;">
                            <div class="col-md-6 col-lg-5 text-center">
                                <img src="assets/NP.png" class="img-fluid custom-image" />
                            </div>
                            <div class="card-body p-4 p-lg-5 text-black custom-form">
                                <form action="proses_admin_login.php" method="POST">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Log In Admin</span>
                                    </div>

                                    <br><br>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">Username</label>
                                        <input type="text" class="form-control form-control-lg" name="username" required>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Password</label>
                                        <input type="password" class="form-control form-control-lg" name="password" required>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Login</button>
                                    </div>
                                    <br>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>