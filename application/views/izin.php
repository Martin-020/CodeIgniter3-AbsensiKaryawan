<!-- 
===============================================================================
  @Desc
     Program Absensi Karyawan ini dibuat menggunakan PHP dan CodeIgniter 3.
  @Author 
     Martin Hidayat Rihwan (Martin-020)
  @First created: 15/01/2025
  @Last update  : 20/05/2025
===============================================================================
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Izin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Form Izin</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger text-center mt-3">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center mt-3">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('absensi/submit_izin') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $this->session->userdata('nama'); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="tipe_izin" class="form-label">Tipe Izin</label>
                <select class="form-control" id="tipe_izin" name="tipe_izin" required>
                    <option value="">Pilih Tipe Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Cuti">Cuti</option>
                    <option value="Keperluan Lain">Keperluan Lain</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="bukti" class="form-label">Upload Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*,application/pdf">
            </div>
            <button type="submit" class="btn btn-primary w-100">Kirim</button>
        </form>
        <div class="text-center mt-3">
            <a href="<?= site_url('user/home') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>