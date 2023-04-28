<?php $this->extend('layout/V_Template') ?>
<?php $this->section('content') ?>

<div class="container mt-4">
  <div class="table-responsive">
    <div class="table-wrapper overflow-hidden">
      <div class="table-title">
        <div class="row">
          <div class="col-sm-5">
            <h2>Data <b>Mahasiswa</b></h2>
          </div>
          <div class="col-sm-7 text-end">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#importFile">
              <i class='bx bx-import'></i>
              <span>Import File</span>
            </button>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportFile">
              <i class='bx bx-export'></i>
              <span>Export File</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="table-scroll" style="height: 80vh; overflow-x:hidden; overflow-y:scroll;">
      <table class="table table-dark table-hover">
        <thead class="thead-sticky">
          <tr>
            <th scope="col"">No</th>
            <th scope=" col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Nilai UTS</th>
            <th scope="col">Nilai UAS</th>
            <th scope="col">Nilai Final</th>
          </tr>
        </thead>
        <tbody class="table-light">
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

  <div class="modal fade" id="importFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload File</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('mahasiswa/import'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3 text-center">
              <label for="file_excel" class="form-label">File Excel</label>
              <input class="form-control" type="file" id="file_excel" name="file_excel">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exportFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Export File</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="d-flex my-3 justify-content-center">
          <button type="button" class="btn btn-primary me-2">
            <a href="<?= base_url('mahasiswa/export/pdf') ?>" class="text-white text-decoration-none"><span>PDF</span></a>
          </button>

          <button type="button" class="btn btn-primary">
            <a href="<?= base_url('mahasiswa/export/excel') ?>" class="text-white text-decoration-none"><span>Excel</span></a>
          </button>
        </div>

      </div>
    </div>
  </div>

</div>


<?php $this->endSection() ?>