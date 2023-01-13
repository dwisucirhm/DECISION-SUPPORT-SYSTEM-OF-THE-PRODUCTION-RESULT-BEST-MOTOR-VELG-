<!-- Include Template Header -->
<?php include "template/header.php" ?>

<?php 
    $id = $_GET['id'];
    $alternatif = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM alternatif WHERE id_alternatif = '$id'"));
?>

<!-- Konten -->
<section class="konten mt-3">
    <div class="container">
        <div class="card px-4 pt-2 pb-5">
            <h4 class="card-title text-center">Edit Altenatif</h4>
            <div class="d-flex justify-content-end">
                <a href="matriks-alternatif.php" class="btn btn-sm btn-secondary ">Kembali</a>  
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <form action="crud/update.php?id=<?= $id ?>" method="post">
                        <div class="row mb-3">
                            <label for="nama_velg" class="col-sm-3 col-form-label">Nama Velg</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_velg" name="nama_velg" value="<?= $alternatif['nama_velg'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="c1" class="col-sm-3 col-form-label">C1</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="c1" name="c1" value="<?= $alternatif['c1'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="c2" class="col-sm-3 col-form-label">C2</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="c2" name="c2" value="<?= $alternatif['c2'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="c3" class="col-sm-3 col-form-label">C3</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="c3" name="c3" value="<?= $alternatif['c3'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="c4" class="col-sm-3 col-form-label">C4</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="c4" name="c4" value="<?= $alternatif['c4'] ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" name="matriks-alternatif">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Template Footer -->
<?php include "template/footer.php" ?>