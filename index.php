<!-- Include Template Header -->
<?php include "template/header.php" ?>

<?php 
    // query tabel alternatif
    $sql_alternatif = mysqli_query($koneksi, "SELECT * FROM alternatif");
    $alternatif = queryAlternatifArray($sql_alternatif);

    // query tabel kriteria;
    $sql_kriteria = mysqli_query($koneksi, "SELECT * FROM kriteria");
    $kriteria = queryKriteriaArray($sql_kriteria);
    
    // Mencari Matriks Bobot
    $matriks_bobot = array();
    for ($i=1; $i < count($alternatif[0]); $i++) { 
        $temp = 0;
        for ($j=0; $j < count($alternatif); $j++) { 
            $temp += pow($alternatif[$j][$i], 2);
        }
        array_push($matriks_bobot, round(sqrt($temp),8));
    }

    // Mencari Matriks Ternormalisasi
    $matriks_ternormalisasi = array();
    for ($i=0; $i < count($alternatif); $i++) { 
        $data["nama_velg"] = $alternatif[$i]['nama_velg'];
        $data["c1"] = round(($alternatif[$i][1] / $matriks_bobot[0]), 8);
        $data["c2"] = round(($alternatif[$i][2] / $matriks_bobot[1]), 8);
        $data["c3"] = round(($alternatif[$i][3] / $matriks_bobot[2]), 8);
        $data["c4"] = round(($alternatif[$i][4] / $matriks_bobot[3]), 8);
        array_push($matriks_ternormalisasi, $data);
    }

    // Mencari Matriks Ternormalisasi Terbobot
    $matriks_ternormalisasi_terbobot = array();
    for ($i=0; $i < count($matriks_ternormalisasi); $i++) {
        $data["nama_velg"] = $matriks_ternormalisasi[$i]['nama_velg'];
        $data["c1"] = round(($matriks_ternormalisasi[$i]["c1"] * $kriteria[0]['bobot']), 8);
        $data["c2"] = round(($matriks_ternormalisasi[$i]["c2"] * $kriteria[1]['bobot']), 8);
        $data["c3"] = round(($matriks_ternormalisasi[$i]["c3"] * $kriteria[2]['bobot']), 8);
        $data["c4"] = round(($matriks_ternormalisasi[$i]["c4"] * $kriteria[3]['bobot']), 8);
        array_push($matriks_ternormalisasi_terbobot, $data);
    }

    // Mencari Solusi Ideal Positif dan Negatif
    $solusi_ideal = array();
    $c1 = array();
    $c2 = array();
    $c3 = array();
    $c4 = array();

    for ($i=0; $i < count($matriks_ternormalisasi_terbobot); $i++) { 
        array_push($c1, $matriks_ternormalisasi_terbobot[$i]['c1']);
        array_push($c2, $matriks_ternormalisasi_terbobot[$i]['c2']);
        array_push($c3, $matriks_ternormalisasi_terbobot[$i]['c3']);
        array_push($c4, $matriks_ternormalisasi_terbobot[$i]['c4']);
    }

    for ($x=0; $x < 2; $x++) { 
        $solusi['c1'] = solusiIdeal($c1, $x, $kriteria[0]['atribut']);
        $solusi['c2'] = solusiIdeal($c2, $x, $kriteria[1]['atribut']);
        $solusi['c3'] = solusiIdeal($c3, $x, $kriteria[2]['atribut']);
        $solusi['c4'] = solusiIdeal($c4, $x, $kriteria[3]['atribut']);
        array_push($solusi_ideal, $solusi);
    }

    // Mencari Jarak Antara Alternatif dengan Solusi Ideal
    $jarakAlternatifSolusi = array();
    for ($i=0; $i < count($matriks_ternormalisasi_terbobot); $i++) { 
        $data['nama_velg'] = $matriks_ternormalisasi_terbobot[$i]['nama_velg'];

        $data['d_plus'] = round(sqrt(pow($solusi_ideal[0]["c1"] - $matriks_ternormalisasi_terbobot[$i]["c1"], 2) + pow($solusi_ideal[0]["c2"] - $matriks_ternormalisasi_terbobot[$i]["c2"], 2) + pow($solusi_ideal[0]["c3"] - $matriks_ternormalisasi_terbobot[$i]["c3"], 2) + pow($solusi_ideal[0]["c4"] - $matriks_ternormalisasi_terbobot[$i]["c4"], 2)), 8);

        $data['d_min'] = round(sqrt(pow($matriks_ternormalisasi_terbobot[$i]["c1"] - $solusi_ideal[1]["c1"], 2) + pow($matriks_ternormalisasi_terbobot[$i]["c2"] - $solusi_ideal[1]["c2"], 2) + pow($matriks_ternormalisasi_terbobot[$i]["c3"] - $solusi_ideal[1]["c3"], 2) + pow($matriks_ternormalisasi_terbobot[$i]["c4"] - $solusi_ideal[1]["c4"], 2)), 8);

        array_push($jarakAlternatifSolusi, $data);
    }

    // Mencari Nilai Preferensi
    $preferensi = array();
    for ($i=0; $i < count($jarakAlternatifSolusi); $i++) { 
        $result['nama_velg'] = $jarakAlternatifSolusi[$i]['nama_velg'];
        $result['preferensi'] = round($jarakAlternatifSolusi[$i]["d_min"]/($jarakAlternatifSolusi[$i]["d_min"] + $jarakAlternatifSolusi[$i]["d_plus"]), 8);
        array_push($preferensi, $result);
    }

    // Pengurutan (rank) nilai preferensi
    $keys = array_column($preferensi, 'preferensi');
    array_multisort($keys, SORT_DESC, $preferensi);
?>

<!-- Konten -->
<section id="konten" class="mt-3">
    <div class="container">
        <div class="card px-4 pt-2 shadow-sm">
            <h4 class="text-center">Hasil Analisa TOPSIS</h4>
            <div class="card-body">
                <div class="row">

                    <!-- Matriks Ternormalisasi -->
                    <div class="col-lg-6">
                        <h5 class="card-subtitle mb-2 text-muted text-center">Matriks Ternormalisasi</h5>
                        <table class="table table-striped table-hover" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th scope="col">Alternatif</th>
                                    <th scope="col">C1</th>
                                    <th scope="col">C2</th>
                                    <th scope="col">C3</th>
                                    <th scope="col">C4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($matriks_ternormalisasi as $data) { ?>
                                
                                <tr>
                                    <th scope="row"><?= $data['nama_velg'] ?></th>
                                    <td><?= $data['c1'] ?></td>
                                    <td><?= $data['c2'] ?></td>
                                    <td><?= $data['c3'] ?></td>
                                    <td><?= $data['c4'] ?></td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Matriks Ternormalisasi Terbobot -->
                    <div class="col-lg-6">
                        <h5 class="card-subtitle mb-2 text-muted text-center">Matriks Ternormalisasi Terbobot</h5>
                        <table class="table table-striped table-hover" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th scope="col">Alternatif</th>
                                    <th scope="col">C1</th>
                                    <th scope="col">C2</th>
                                    <th scope="col">C3</th>
                                    <th scope="col">C4</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($matriks_ternormalisasi_terbobot as $data) { ?>
                                <tr>
                                    <th scope="row"><?= $data['nama_velg'] ?></th>
                                    <td><?= $data['c1'] ?></td>
                                    <td><?= $data['c2'] ?></td>
                                    <td><?= $data['c3'] ?></td>
                                    <td><?= $data['c4'] ?></td>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Solusi Ideal (+) dan (-) -->
        <div class="card px-4 pt-2 mt-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted text-center">Solusi Ideal Positif dan Negatif</h5>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" >Alternatif</th>
                                    <th scope="col">C1</th>
                                    <th scope="col">C2</th>
                                    <th scope="col">C3</th>
                                    <th scope="col">C4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">A+</th>
                                    <td><?= $solusi_ideal[0]['c1'] ?></td>
                                    <td><?= $solusi_ideal[0]['c2'] ?></td>
                                    <td><?= $solusi_ideal[0]['c3'] ?></td>
                                    <td><?= $solusi_ideal[0]['c4'] ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">A-</th>
                                    <td><?= $solusi_ideal[1]['c1'] ?></td>
                                    <td><?= $solusi_ideal[1]['c2'] ?></td>
                                    <td><?= $solusi_ideal[1]['c3'] ?></td>
                                    <td><?= $solusi_ideal[1]['c4'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jarak Antar Nilai Solusi Positif dan Negatif -->
        <div class="card px-4 pt-2 mt-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted text-center">Jarak Antara Nilai Alternatif dengan Solusi Ideal Positif dan Negatif</h5>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Alternatif</th>
                                    <th scope="col">D+</th>
                                    <th scope="col">D-</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jarakAlternatifSolusi as $data) { ?>
                                <tr>
                                    <th scope="row"><?= $data['nama_velg'] ?></th>
                                    <td><?= $data['d_plus'] ?></td>
                                    <td><?= $data['d_min'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai Preferensi -->
        <div class="card px-4 pt-2 mt-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-subtitle mb-2 text-muted text-center">Nilai Preferensi</h5>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Alternatif</th>
                                    <th scope="col">Nilai Preferensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($preferensi as $data) { ?>
                                <tr>
                                    <th scope="row"><?= $i ?></th>
                                    <td><?= $data['nama_velg'] ?></td>
                                    <td><?= $data['preferensi'] ?></td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Include Template Footer -->
<?php include "template/footer.php" ?>
