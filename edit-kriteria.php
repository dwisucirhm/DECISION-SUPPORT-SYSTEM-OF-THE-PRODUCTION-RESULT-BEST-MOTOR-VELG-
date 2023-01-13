<!-- Include Template Header -->
<?php include "template/header.php" ?>

<?php 
    $id = $_GET['id'];
    $kriteria = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kriteria WHERE id_kriteria = '$id'"));
?>

<!-- Konten -->
<section id="konten" class="mt-3">
    <div class="container">
        <div class="card px-4 pt-2 pb-5">
            <h4 class="card-title text-center">Edit Kriteria</h4>
            <div class="d-flex justify-content-end">
                <a href="matriks-kriteria.php" class="btn btn-sm btn-secondary ">Kembali</a>  
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <form action="crud/update.php?id=<?= $id ?>" method="post">
                        <div class="row mb-3">
                            <label for="kode" class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" id="kode" value="<?= $kriteria['kode']?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kriteria" class="col-sm-3 col-form-label">Kiteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kriteria" name="kriteria" value="<?= $kriteria['kriteria'] ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="atribbutt" class="col-sm-3 col-form-label">Atribut</label>
                            <div class="col-sm-9">
                                <select class="form-select" aria-label="Default select example" name="atribut">
                                    <option value="Benefit" selected>Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="bobot" class="col-sm-3 col-form-label">Bobot</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="bobot" value="<?= $kriteria['bobot'] ?>" name="bobot">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" name="matriks-kriteria">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include Template Footer -->
<?php include "template/footer.php" ?>