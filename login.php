<?php
    include "functions.php";

    if(isset($_POST['login'])) {
        login($_POST);
    }
    
    if (isset($_SESSION['username'])) {
        header("Location: index.php");
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- CSS -->
        <link rel="stylesheet" href="asset/css/style.css">

        <title>Velg Motor Terbaik | Login</title>
    </head>
    <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #ADFF2F;">
        <div class="container">
            <a class="navbar-brand" href="#">Velg Motor Terbaik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="registrasi.php">Registrasi</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <!-- Login -->
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted small text-center my-0">Login to</p>
                    <h3 class="card-title text-center pt-0">Velg Motor Terbaik</h3>
                    <?php
                        if(isset($_SESSION['registrasi'])) {
                            echo "<div class='alert alert-success text-center' role='alert'>". $_SESSION['registrasi'] ."</div>";
                            unset($_SESSION['registrasi']);
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['login'])) {
                            echo "<div class='alert alert-danger text-center' role='alert'>". $_SESSION['login'] ."</div>";
                            unset($_SESSION['login']);
                        }
                    ?>
                    <form method="post" action="" class="mb-3">
                        <div class="mb-3">
                            <label for="username" class="form-label small">Username</label>
                            <input name="username" type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small">Password</label>
                            <input name="password" type="password" class="form-control" id="password" required>
                        </div>
                        
                        <button type="submit" class="btn container-fluid" name="login" style="background-color: #ADFF2F;">Login</button>
                    </form>
                    <a href="registrasi.php">Belum punya akun?</a>
                </div>
            </div>
        </div>
    </div>

<!-- Include Template Footer -->
<?php include "template/footer.php"; ?>