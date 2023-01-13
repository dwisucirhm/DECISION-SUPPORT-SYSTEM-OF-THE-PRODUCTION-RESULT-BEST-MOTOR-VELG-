<!-- Include Template Header -->
<?php include "template/header.php" ?>

<?php 
    $sql = mysqli_query($koneksi, "SELECT * FROM kriteria");
?>

<!-- Konten -->
<section id="konten" class="mt-3">
    <div class="container">
        <div class="card px-4 pt-2">
            <h4 class="card-title text-center">Matriks Kriteria</h4>
            
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Kode</th>
                        <th scope="col">Kriteria</th>
                        <th scope="col">Atribut</th>
                        <th scope="col">Bobot</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($kriteria = mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                        <th scope="row"><?= $kriteria['kode'] ?></th>
                        <td><?= $kriteria['kriteria'] ?></td>
                        <td><?= $kriteria['atribut'] ?></td>
                        <td><?= $kriteria['bobot'] ?></td>
                        <td>
                            <a href="edit-kriteria.php?id=<?= $kriteria['id_kriteria'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Include Template Footer -->
<?php include "template/footer.php" ?>