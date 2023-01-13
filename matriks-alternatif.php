<!-- Include Template Header -->
<?php include "template/header.php" ?>

<?php 
    $sql = mysqli_query($koneksi, "SELECT * FROM alternatif");
?>

<!-- Konten -->
<section id="konten" class="mt-3">
    <div class="container">
        <div class="card px-4 py-2">
            <h4 class="card-title text-center">Matriks Alternatif</h4>
            <div class="d-flex justify-content-end">
                <a href="tambah-alternatif.php" class="btn btn-sm btn-success">Tambah Alternatif</a>  
            </div>

            
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nama Alternatif</th>
                        <th scope="col">C1</th>
                        <th scope="col">C2</th>
                        <th scope="col">C3</th>
                        <th scope="col">C4</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($alternatif = mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                        <th scope="row"><?= $alternatif['nama_velg'] ?></th>
                        <td><?= $alternatif['c1'] ?></td>
                        <td><?= $alternatif['c2'] ?></td>
                        <td><?= $alternatif['c3'] ?></td>
                        <td><?= $alternatif['c4'] ?></td>
                        <td>
                            <a href="edit-alternatif.php?id=<?= $alternatif['id_alternatif'] ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="crud/delete.php?page=matriks-alternatif&id=<?= $alternatif['id_alternatif'] ?>" onclick="return confirm('Hapus yang satu ini?')" class="btn btn-sm btn-danger">Hapus</a>
                        </td>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-center">
                <a href="index.php" class="btn btn-sm" style="background-color: #ADFF2F;">Lihat Analisa TOPSIS</a>
            </div>
        </div>
    </div>
</section>

<!-- Include Template Footer -->
<?php include "template/footer.php" ?>