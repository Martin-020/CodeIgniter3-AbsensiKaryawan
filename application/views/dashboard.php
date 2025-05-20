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
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Dashboard Admin</h2>
        <a href="<?= site_url('user/logout') ?>" class="btn btn-secondary">Logout</a>

        <ul class="nav nav-tabs mt-4" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="karyawan-tab" data-bs-toggle="tab" data-bs-target="#karyawan" type="button" role="tab">Data Karyawan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="jadwal-tab" data-bs-toggle="tab" data-bs-target="#jadwal" type="button" role="tab">Jadwal</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi" type="button" role="tab">Riwayat Absensi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="izin-tab" data-bs-toggle="tab" data-bs-target="#izin" type="button" role="tab">List Izin</button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="adminTabsContent">
            <div class="tab-pane fade show active" id="karyawan" role="tabpanel">
                <h4>Data Karyawan</h4>
                <form action="<?= site_url('admin/buat_karyawan') ?>" method="post" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="col-md-2">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="col-md-3">
                            <label for="tlp" class="form-label">Nomer Telepon</label>
                            <input type="tlp" class="form-control" id="tlp" name="tlp" required>
                        </div>
                        <div class="col-md-4">
                            <label for="alamat" class="form-label">Alamat Rumah</label>
                            <input type="alamat" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="col-md-5">
                            <label for="jabatan" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-md-2">
                            <p></p>
                            <button type="submit" style=":800px" class="btn btn-primary mt-3">Buat Jadwal</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($karyawan as $row): ?>
                            <tr>
                                <td><?= $row->nama; ?></td>
                                <td><?= $row->jabatan; ?></td>
                                <td><?= $row->tlp; ?></td>
                                <td><?= $row->alamat; ?></td>
                                <td> <a href="<?= site_url('admin/delete_karyawan/' .  $row->id_karyawan); ?>" class="btn btn-secondary">Hapus</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="jadwal" role="tabpanel">
                <h4>Jadwal</h4>
                <form action="<?= site_url('admin/buat_jadwal') ?>" method="post" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>
                        <div class="col-md-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="col-md-2">
                            <label for="jam_masuk" class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                        </div>
                        <div class="col-md-2">
                            <label for="jam_keluar" class="form-label">Jam Keluar</label>
                            <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" required>
                        </div>
                        <div class="col-md-2">
                            <p></p>
                            <button type="submit" class="btn btn-primary mt-3">Buat Jadwal</button>
                        </div>
                    </div>
                </form>

                <h4>Daftar Jadwal</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Tanggal</th>
                            <th>Jabatan</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jadwal as $row): ?>
                            <tr>
                                <td><?= $row->id_jadwal; ?></td>
                                <td><?= $row->tanggal; ?></td>
                                <td><?= $row->jabatan; ?></td>
                                <td><?= $row->jam_masuk; ?></td>
                                <td><?= $row->jam_keluar; ?></td>
                                <td><a  href="<?= site_url('admin/delete_jadwal/' . $row->id_jadwal); ?>" class="btn btn-secondary">Hapus</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
 
            <div class="tab-pane fade" id="absensi" role="tabpanel">
                <h4>Riwayat Absensi</h4>
                <input type="text" class="form-control mb-3" placeholder="Cari karyawan..." id="searchAbsensi">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>jabatan</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($absensi as $row): ?>
                            <tr>
                                <td><?= $row->tanggal; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= $row->waktu_masuk ?: '-'; ?></td>
                                <td><?= $row->waktu_keluar ?: '-'; ?></td>
                                <td><?= $row->status; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="izin" role="tabpanel">
                <h4>Riwayat Izin Karyawan</h4>
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
</body>
</html>
