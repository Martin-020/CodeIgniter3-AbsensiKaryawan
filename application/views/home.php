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
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Selamat Datang, <?= $this->session->userdata('nama'); ?>!</h2>

        <div class="text-center mt-3">
            <p>Waktu Saat Ini: <strong><?= date('H:i:s'); ?></strong></p>
        </div>

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

        <div class="text-center mt-4">
            <a href="<?= site_url('absensi/absen_masuk') ?>" class="btn btn-primary me-2">Absen Masuk</a>
            <a href="<?= site_url('absensi/absen_pulang') ?>" class="btn btn-primary me-2">Absen Pulang</a>
            <a href="<?= site_url('user/izin') ?>" class="btn btn-secondary">Izin</a>
            <a href="<?= site_url('user/logout') ?>" class="btn btn-secondary">logout</a>
        </div>

        <ul class="nav nav-tabs mt-2" id="karyawanTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi" type="button" role="tab">Riwayat Absensi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="izin-tab" data-bs-toggle="tab" data-bs-target="#izin" type="button" role="tab">Riwayat Izin</button>
            </li>
        </ul>

        <div class="tab-content mt-2" id="kayawanTabsContent">
            <div class="tab-pane fade show active" id="absensi" role="tabpanel">
                <div class="mt-5">
                    <h4>Riwayat Absensi</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($absensi)): ?>
                                <?php foreach ($absensi as $row): ?>
                                    <tr>
                                        <td><?= $row->tanggal; ?></td>
                                        <td><?= $row->waktu_masuk ?: '-'; ?></td>
                                        <td><?= $row->waktu_keluar ?: '-'; ?></td>
                                        <td><?= $row->status; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data absensi</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="izin" role="tabpanel">
                <div class="mt-5">
                    <h4>Riwayat Izin</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tipe Izin</th>
                                <th>Keterangan</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($izin)): ?>
                                <?php foreach ($izin as $row): ?>
                                    <tr>
                                        <td><?= $row->tanggal; ?></td>
                                        <td><?= $row->tipe_izin; ?></td>
                                        <td><?= $row->keterangan; ?></td>
                                        <td>
                                            <?php if (!empty($row->bukti)): ?>
                                                <a href="<?= base_url('uploads/' . $row->bukti); ?>" target="_blank">Lihat Bukti</a>
                                            <?php else: ?>
                                                Tidak ada bukti
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data izin</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>                   
    </div>
</body>
</html>
