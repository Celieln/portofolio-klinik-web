<?php
$activePage = 'janji.php';
$pageTitle  = 'Buat Janji';
require_once __DIR__ . '/includes/config.php';
$pageDesc = 'Buat janji konsultasi dokter di Medika Klinik secara online.';
$pilihId = isset($_GET['dokter']) ? (int) $_GET['dokter'] : 0;
$pilihNama = '';
foreach ($daftarDokter as $m) { if ((int)$m['id'] === $pilihId) { $pilihNama = $m['nama']; break; } }
include __DIR__ . '/includes/header.php';
?>
    <section class="page-head"><div class="container">
      <h1>Buat Janji Konsultasi</h1>
      <p>Isi data pasien untuk menjadwalkan konsultasi dokter.</p>
    </div></section>

    <section class="section"><div class="container daftar-layout">
      <div class="panel-form" data-aos="fade-up">
        <h2 class="form-title">Formulir Janji Temu</h2>
        <form id="form-janji" class="form">
          <label class="field"><span>Nama Pasien *</span><input type="text" id="nama" placeholder="Nama Anda" required></label>
          <label class="field"><span>No. HP / WhatsApp *</span><input type="text" id="telepon" placeholder="08xxxxxxxxxx" required></label>
          <div class="grid-2-form">
            <label class="field"><span>Tanggal *</span><input type="date" id="tanggal" required></label>
            <label class="field"><span>Jam</span><select id="jam"><option>09:00</option><option>10:00</option><option>11:00</option><option>13:00</option><option>14:00</option><option>15:00</option><option>16:00</option></select></label>
          </div>
          <label class="field"><span>Pilih Dokter *</span>
            <select id="pilih-dokter" required>
              <option value="">-- Pilih dokter --</option>
              <?php foreach ($daftarDokter as $m): ?><option value="<?= (int)$m['id'] ?>" <?= (int)$m['id'] === $pilihId ? 'selected' : '' ?>><?= e($m['nama']) ?> — <?= rupiah($m['harga']) ?></option><?php endforeach; ?>
            </select>
          </label>
          <label class="field"><span>Keluhan</span><textarea id="keluhan" rows="3" placeholder="Jelaskan keluhan Anda..."></textarea></label>
          <button type="submit" class="btn"><i class="fa-solid fa-calendar-check"></i> Kirim Janji Temu</button>
        </form>
      </div>
      <aside class="panel-info" data-aos="fade-left">
        <h3>Kenapa Memilih Medika Care</h3>
        <ul>
          <li><i class="fa-solid fa-check"></i> Dokter berlisensi resmi</li>
          <li><i class="fa-solid fa-check"></i> Pemeriksaan cepat &amp; akurat</li>
          <li><i class="fa-solid fa-check"></i> Apotek onsite</li>
          <li><i class="fa-solid fa-check"></i> Terima berbagai asuransi</li>
        </ul>
        <div class="cta-lingkup"><i class="fa-solid fa-circle-info"></i> Konfirmasi janji maksimal 2 jam.</div>
      </aside>
    </div></section>

    <div class="modal" id="modal-sukses">
      <div class="modal-kotak">
        <div class="modal-ikon"><i class="fa-solid fa-check"></i></div>
        <h2>Janji Temu Berhasil</h2>
        <p>Terima kasih <b id="nama-pasien">-</b>!</p>
        <div class="modal-kode">No. Antrian<b id="kode-janji">-</b></div>
        <button class="btn lebar" id="tutup-modal">Kembali ke Beranda</button>
      </div>
    </div>
<?php include __DIR__ . '/includes/footer.php'; ?>