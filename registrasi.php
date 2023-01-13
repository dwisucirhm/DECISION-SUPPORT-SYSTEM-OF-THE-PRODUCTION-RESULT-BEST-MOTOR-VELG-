<?php
    session_start();
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

        <title>SPK Produksi Velg | Registrasi</title>
    </head>
    <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm" style="background-color: #ADFF2F;">
        <div class="container">
            <a class="navbar-brand" href="#">SPK Produksi Velg</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="login.php">Login</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted small text-center my-0">Welcome to</p>
                    <h3 class="card-title text-center pt-0">SPK Produksi Vleg</h3>
                    <?php
                        if(isset($_SESSION['registrasi'])) {
                            echo "<div class='alert alert-danger text-center' role='alert'>". $_SESSION['registrasi'] ."</div>";
                            unset($_SESSION['registrasi']);
                        }
                    ?>
                    <form method="post" action="crud/insert.php">
                        <div class="mb-3">
                            <label for="nama" class="form-label small">Nama Lengkap</label>
                            <input name="nama" type="text" class="form-control" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label small">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label small">Username</label>
                            <input name="username" type="text" class="form-control" id="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label small">Password</label>
                            <input name="password" type="text" class="form-control" id="password" required>
                        </div>
                        
                        <button type="submit" class="btn container-fluid" name="registrasi" style="background-color: #ADFF2F;">Registrasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Include Template Footer -->
<?php include "template/footer.php"; ?>