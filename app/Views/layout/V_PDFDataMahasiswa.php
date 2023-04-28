<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF</title>

  <!-- File Css -->
  <link rel=" stylesheet" href="styles/style_pdf.css">
</head>

<body>
  <div class="container">
    <div class="kop-surat">
      <div class="img-kop-surat">
        <img src="assets/Logo_POLBAN.png" alt="" width="100" height="110" >
      </div>
      <div class="title-kop-surat">
        <h1 class="kampus">POLITEKNIK NEGERI BANDUNG</h1>
        <h2 class="jurusan">JURUSAN TEKNIK KOMPUTER DAN INFORMATIKA</h2>
        <p class="alamat">Jl. Gegerkalong Hilir, Ciwaruga, Kec. Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559</p>
      </div>
    </div>

    <div class="garis-horizontal"></div>

    <div class="body-surat">
      <div class="judul-surat">
        <h1>DATA NILAI MAHASISWA</h1>
      </div>

      <div class="isi-surat">
        <table>
          <thead>
            <tr>
              <th scope="col"">No</th>
              <th scope=" col">NIM</th>
              <th scope="col">Nama</th>
              <th scope="col">Nilai UTS</th>
              <th scope="col">Nilai UAS</th>
              <th scope="col">Nilai Final</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($mahasiswa as $mhs) : ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $mhs['NIM']; ?></td>
                <td><?= $mhs['Nama']; ?></td>
                <td><?= $mhs['Nilai_UTS']; ?></td>
                <td><?= $mhs['Nilai_UAS']; ?></td>
                <td><?= ($mhs['Nilai_UTS'] * 0.45) + ($mhs['Nilai_UAS'] * 0.55); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>



  </div>
  <!-- <div class="container">
    <div class="kop">
      <div class="row">
        <div class="col-1">
          <img src="assets/Logo_POLBAN.png" width="100" height="100">
        </div>
        <div class="col-11">
          <h1 class="text-center">POLITEKNIK NEGERI BANDUNG</h1>
          <h2 class="text-center">JURUSAN TEKNIK KOMPUTER DAN INFORMATIKA</h2>
          <p class="text-center">Jl. Gegerkalong Hilir, Ciwaruga, Kec. Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559</p>
        </div>
      </div>
    </div>
  </div>
  <hr>
  
  </div> -->

</body>

</html>