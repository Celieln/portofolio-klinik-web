<?php
$activePage = 'dokter.php';
$pageTitle  = 'Dokter';
require_once __DIR__ . '/includes/config.php';
$pageDesc = 'Temukan dokter spesialis Medika Care untuk kebutuhan kesehatan Anda.';
include __DIR__ . '/includes/header.php';
?>
    <section class="page-head"><div class="container">
      <h1>Jelajahi Dokter</h1>
      <p>Pilih dokter spesialis sesuai kebutuhan Anda.</p>
    </div></section>

    <section class="section"><div class="container">
      <div class="toolbar">
        <div class="filter-kategori" id="filter-kategori" data-aktif="Semua">
          <?php foreach ($kategoriDokter as $k): ?><button class="btn-filter<?= $k === 'Semua' ? ' aktif' : '' ?>" data-kategori="<?= e($k) ?>"><?= e($k) ?></button><?php endforeach; ?>
        </div>
        <input type="text" class="cari" id="cari-dokter" placeholder="Cari nama dokter...">
      </div>
      <p class="jumlah-produk" id="jumlah-produk"></p>
      <div class="menu-grid" id="menu-grid"></div>
    </div></section>
<?php include __DIR__ . '/includes/footer.php'; ?>