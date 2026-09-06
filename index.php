<?php
$activePage = 'index.php';
$pageTitle  = 'Beranda';
require_once __DIR__ . '/includes/config.php';
$pageDesc = $namaKlinik . ' - ' . strtolower($tagline) . '. Konsultasi dokter umum, anak, kandungan, gigi, dan mata.';
include __DIR__ . '/includes/header.php';
?>

    <div class="brand-strip"><div class="container marquee">
      <span>Dokter Profesional</span><i class="fa-solid fa-star"></i><span>Alat Modern</span><i class="fa-solid fa-star"></i><span>Apotek Onsite</span><i class="fa-solid fa-star"></i><span>Antrean Online</span><i class="fa-solid fa-star"></i><span>Dokter Profesional</span><i class="fa-solid fa-star"></i><span>Alat Modern</span><i class="fa-solid fa-star"></i><span>Apotek Onsite</span><i class="fa-solid fa-star"></i><span>Antrean Online</span><i class="fa-solid fa-star"></i>
    </div></div>

    <section class="hero">
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="container hero-dalam">
        <div class="hero-teks">
          <span class="hero-badge" data-aos="fade-up">Selamat Datang</span>
          <h1 data-aos="fade-up" data-aos-delay="80">Kesehatan Anda <span class="grad">Prioritas Kami</span></h1>
          <p data-aos="fade-up" data-aos-delay="160">Klinik dengan dokter profesional, peralatan modern, dan pelayanan ramah. Konsultasikan kesehatan Anda tanpa ribet.</p>
          <div class="hero-aksi" data-aos="fade-up" data-aos-delay="240">
            <a href="dokter.php" class="btn hvr-sweep-to-right"><i class="fa-solid fa-user-doctor"></i> Lihat Dokter</a>
            <a href="janji.php" class="btn btn-ghost hvr-sweep-to-right"><i class="fa-solid fa-calendar-check"></i> Buat Janji</a>
          </div>
          <div class="hero-stat" data-aos="fade-up" data-aos-delay="320">
            <div><b>10+</b><span>Dokter</span></div>
            <div><b>30k+</b><span>Pasien</span></div>
            <div><b>4.9<i class="fa-solid fa-star"></i></b><span>Rating</span></div>
          </div>
        </div>
        <div class="hero-visual" data-aos="fade-left" data-aos-delay="200">
          <div class="hero-card utama">
            <span class="promo-label">Paket Sehat</span>
            <h3>Medical Check-up Hemat</h3>
            <p>Mulai dari</p>
            <div class="harga-hero">Rp <em>250.000</em></div>
            <a href="janji.php" class="btn btn-kecil btn-putih hvr-sweep-to-right">Buat Janji</a>
          </div>
          <div class="hero-badge-card"><i class="fa-solid fa-stethoscope"></i><div><b>Dokter Terpercaya</b><span>Profesional &amp; ramah</span></div></div>
          <div class="hero-mini-card"><i class="fa-solid fa-truck-medical"></i><div><b>Ambulans 24/7</b><span>Jaringan lengkap</span></div></div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="judul-section" data-aos="fade-up">
          <div><span class="eyebrow">Spesialis</span><h2>Dokter Andalan</h2></div>
          <a href="dokter.php" class="link-semua">Lihat Semua <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="menu-grid" id="menu-grid">
          <?php foreach (array_slice($daftarDokter, 0, 6) as $i => $m): ?>
          <div data-aos="fade-up" data-aos-delay="<?= ($i % 3) * 60 ?>"><?= kartu_dokter($m) ?></div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="promo-band">
      <div class="container promo-band-dalam" data-aos="fade-up">
        <div><span class="eyebrow light">Promo</span><h2>Konsultasi <em>dokter umum gratis</em> setiap Senin</h2><p>Syarat &amp; ketentuan berlaku.</p></div>
        <a href="janji.php" class="btn btn-putih hvr-sweep-to-right">Klaim Promo</a>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="judul-section" data-aos="fade-up"><div><span class="eyebrow">Layanan</span><h2>Layanan Kami</h2></div></div>
        <div class="kategori-grid">
          <?php $ik = ['fa-user-doctor','fa-baby','fa-tooth','fa-eye','fa-lungs','fa-heart-pulse']; $gk = ['gk-1','gk-2','gk-3','gk-4','gk-5','gk-6']; $no=0; foreach (['Konsultasi Umum','Kesehatan Anak','Gigi','Mata','Paru','Jantung'] as $k): ?>
          <a href="dokter.php" class="kategori-card <?= $gk[$no] ?>" data-aos="fade-up" data-aos-delay="<?= $no*60 ?>"><i class="fa-solid <?= $ik[$no] ?>"></i><h3><?= $k ?></h3><span>Lihat →</span></a>
          <?php $no++; endforeach; ?>
        </div>
      </div>
    </section>

    <section class="section tentang-ringkas">
      <div class="container tentang-grid" data-aos="fade-up">
        <div class="ttg-visual"><div class="ttg-gambar"><i class="fa-solid fa-staff-snake"></i></div><div class="ttg-badge">10+ Thn</div></div>
        <div class="ttg-teks">
          <span class="eyebrow">Tentang Kami</span>
          <h2>Peduli, profesional, dan terpercaya</h2>
          <p>Medika Care berdiri sejak 2014 melayani masyarakat dengan standar medis tinggi. Dilengkapi alat diagnostik modern dan apotek onsite.</p>
          <ul>
            <li><i class="fa-solid fa-check"></i> Dokter berlisensi resmi</li>
            <li><i class="fa-solid fa-check"></i> Laboratorium &amp; radiologi</li>
            <li><i class="fa-solid fa-check"></i> Asuransi diterima</li>
          </ul>
          <a href="dokter.php" class="btn hvr-sweep-to-right">Cari Dokter</a>
        </div>
      </div>
    </section>

<?php include __DIR__ . '/includes/footer.php'; ?>